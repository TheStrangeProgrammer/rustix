<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessDeposit;
use App\Jobs\ProcessWithdraw;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use waylaidwanderer\SteamCommunity\Enum\LoginResult;
use waylaidwanderer\SteamCommunity\MobileAuth\WgTokenInvalidException;
use waylaidwanderer\SteamCommunity\SteamCommunity;
use Illuminate\Support\Facades\Trade;
use Illuminate\Support\Facades\Log;
class BotController extends Controller
{
    const inventoryDelay=30;
    public static $deposit;
    public static $bot = [];

    public function getItems()
    {
        return json_decode(Storage::disk('local')->get('depositInventory.json'))->inventory;
    }
    public static function loginDeposit(){
        $settings=config("rustix.depositInfo");
        $steam = new SteamCommunity($settings,Storage::disk('local')->path('/'));
        $loginResult = $steam->doLogin();

        while($loginResult != LoginResult::LoginOkay){
            $authCode = $steam->mobileAuth()->steamGuard()->generateSteamGuardCode();
            $steam->setTwoFactorCode($authCode);
            $loginResult = $steam->doLogin();
            Log::info($loginResult);
        }
        BotController::$deposit=$steam;
    }
    public static function loginBot($botNumber){
        $settings=config("rustix.bot".$botNumber."Info");
        $steam = new SteamCommunity($settings,Storage::disk('local')->path('/'));
        $loginResult = $steam->doLogin();

        while($loginResult != LoginResult::LoginOkay){
            $authCode = $steam->mobileAuth()->steamGuard()->generateSteamGuardCode();
            $steam->setTwoFactorCode($authCode);
            $loginResult = $steam->doLogin();
            Log::info($loginResult);
        }
        BotController::$bot[$botNumber]=$steam;
    }
    public static function confirmTradeOffer($tradeOfferId,$bot){

    }
    public static function acceptTradeOffer($tradeOfferId,$tradeOffers){
        $incomingOffer = $tradeOffers->getTradeOfferViaAPI($tradeOfferId);
        $tradeOffers->acceptTrade($incomingOffer);
        return $incomingOffer;
    }
    public static function splitTradeToken($token){
        return explode("token=",$token)[1];
    }
    public static function sendTakeTradeOffer($toSteamId,$token,$tradeOffers,$selectedItems){
        $trade = $tradeOffers->createTrade($toSteamId);
        foreach($selectedItems as $item){
            $trade->addOtherItem(config('rustix.steamAppId'), config('rustix.steamContext'), $item->id,$item->amount);
        }
        return $trade->send($token);
    }
    public static function sendGiveTradeOffer($toSteamId,$token,$tradeOffers,$selectedItems){
        $trade = $tradeOffers->createTrade($toSteamId);

        foreach($selectedItems as $item){
            $trade->addMyItem(config('rustix.steamAppId'), config('rustix.steamContext'), $item->id,$item->amount);
        }

        return $trade->send($token);
    }
    public static function depositContinue(Request $request)
    {
        $selectedItems = json_decode(session('selectedItems'));
        $price = BotController::getItemPriceFromInventory(json_decode(json_encode(session('inventory')))->inventory,$selectedItems);
        if($selectedItems!=null){
            ProcessDeposit::dispatch(Auth::user()->steamid,Auth::user()->tradeToken,session('tradeId'),session('botId'),$selectedItems,$price)->onQueue('deposit');
        }

    }
    public static function depositItems(Request $request)
    {
        $token = BotController::splitTradeToken(Auth::user()->tradeToken);
        if($token=="") return response()->json(['success' => 0,'error' => "Please set trade token in profile"]);



        $selectedItems = json_decode(json_encode($request->json()->all()));

        if(count($selectedItems)<1) response()->json(['success' => 0,'error' => "At least 1 selected Item"]);

        if(BotController::$deposit==null){
            BotController::loginDeposit();
        }
        $depositTradeOffers=BotController::$deposit->tradeOffers();
        $random = 1;
        if(count( BotController::$bot)!=3){
            BotController::loginBot($random);
        } else if(BotController::$bot[$random]==null){
            BotController::loginBot($random);
        }

        $tradeOffers = BotController::$bot[$random]->tradeOffers();
        $botToUserId=0;


        $botToUserId=BotController::sendTakeTradeOffer(Auth::user()->steamid,$token,$tradeOffers,$selectedItems);
        if($botToUserId==0) response()->json(['success' => 0,'error' => "Unexpected Error please try again"]);
        session(['selectedItems' => json_encode($selectedItems)]);
        session(['tradeId' => $botToUserId]);
        session(['botId' => $random]);
        return response()->json(['success' => 1]);


    }
    public static function getItemPriceFromInventory($inventory,$selectedItems){
        $price = 0;
        foreach($selectedItems as $item){
            foreach($inventory as $inventoryItem){
                if($item->id==$inventoryItem->id){
                    $price+=$item->amount*$inventoryItem->price;
                }

            }
        }
        return $price;
    }

    public static function withdrawItems(Request $request)
    {
        $token = BotController::splitTradeToken(Auth::user()->tradeToken);
        if($token=="") return response()->json(['success' => 0,'error' => "Please set trade token in profile"]);

        $selectedItems = json_decode(json_encode($request->json()->all()));

        $price = BotController::getItemPriceFromInventory(json_decode(Storage::disk('local')->get('depositInventory.json'))->inventory->inventory,$selectedItems);

        if(Auth::user()->balance<$price) return response()->json(['success' => 0,'error' => "Not Enough Money"]);

        if(count($selectedItems)<1) return response()->json(['success' => 0,'error' => "At least 1 selected Item"]);

        ProcessWithdraw::dispatch(Auth::user()->steamid,$token,$selectedItems,$price)->onQueue('withdraw');
        return response()->json(['success' => 1]);

    }
}

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

    public function getDeposit()
    {
        return view("layouts/withdraw",['inventory' => json_decode(Storage::disk('local')->get('depositInventory.json'))->inventory]);
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
        /*foreach ($incomingOffers as $incomingOffer) {
            if($incomingOffer->getTradeOfferId()==$tradeOfferId){
                $tradeOffers->acceptTrade($incomingOffer);
                return $incomingOffer;
            }
        }
        return null;*/
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

    public static function depositItems(Request $request)
    {
        $selectedItems = json_decode($request->input("itemList"));
        if(count($selectedItems)>0){
            //ProcessDeposit::dispatch(Auth::user()->steamid,Auth::user()->tradeToken,$selectedItems)->onQueue('deposit');
        }
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
        $userToBotId=0;
        while($userToBotId==0){
            $userToBotId=BotController::sendTakeTradeOffer(Auth::user()->steamid,Auth::user()->tradeToken,$tradeOffers,$selectedItems);
        }
        BotController::acceptTradeOffer($userToBotId,$depositTradeOffers);
        $retry = true;
        while($retry){
            try{
                $confirmations =BotController::$deposit->mobileAuth()->confirmations()->fetchConfirmations();
                foreach ($confirmations as $confirmation) {
                    if(BotController::$deposit->mobileAuth()->confirmations()->getConfirmationTradeOfferId($confirmation)==$userToBotId){
                        if(BotController::$deposit->mobileAuth()->confirmations()->acceptConfirmation($confirmation)){
                            $retry=false;
                        }
                        break;
                    }
                }
            } catch (WgTokenInvalidException $ex) {
                BotController::$deposit->mobileAuth()->refreshMobileSession();
                $retry=true;
            }
        }

/*

        $items = $tradeOffers->getItems(intval($depositToBotId));

        $botToUserId=0;
        while($botToUserId==0){
            $botToUserId = BotController::sendGiveTradeOffer($this->toSteamId,$this->token,$tradeOffers,$items);
        }
        $retry = true;
        while($retry){
            try{
                $confirmations =BotController::$bot[$random]->mobileAuth()->confirmations()->fetchConfirmations();
                foreach ($confirmations as $confirmation) {
                    if(BotController::$bot[$random]->mobileAuth()->confirmations()->getConfirmationTradeOfferId($confirmation)==$botToUserId){
                        if(BotController::$bot[$random]->mobileAuth()->confirmations()->acceptConfirmation($confirmation)){
                            $retry=false;
                        }
                        break;
                    }
                }
            } catch (WgTokenInvalidException $ex) {
                BotController::$bot[$random]->mobileAuth()->refreshMobileSession();
                $retry=true;
            }
        }*/
    }
    public static function withdrawItems(Request $request)
    {
        $selectedItems = json_decode($request->input("itemList"));
        if(count($selectedItems)>0){
            ProcessWithdraw::dispatch(Auth::user()->steamid,Auth::user()->tradeToken,$selectedItems)->onQueue('withdraw');
        }

    }
}

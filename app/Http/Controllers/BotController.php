<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessDeposit;
use App\Jobs\ProcessWithdraw;
use App\Models\Transaction;
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

        $authCode = $steam->mobileAuth()->steamGuard()->generateSteamGuardCode();
            $steam->setTwoFactorCode($authCode);
            $loginResult = $steam->doLogin();
            Log::info($loginResult);
        BotController::$deposit=$steam;
    }
    public static function loginBot($botNumber){
        $settings=config("rustix.bot".$botNumber."Info");
        $steam = new SteamCommunity($settings,Storage::disk('local')->path('/'));
        $loginResult = $steam->doLogin();

        $authCode = $steam->mobileAuth()->steamGuard()->generateSteamGuardCode();
            $steam->setTwoFactorCode($authCode);
            $loginResult = $steam->doLogin();
            Log::info($loginResult);
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
        $random = 1;

        $token = BotController::splitTradeToken(Auth::user()->tradeToken);
        if($token=="") return response()->json(['success' => 0,'error' => "Please set trade token in profile"]);

        $selectedItems = json_decode(json_encode($request->json()->all()));

        if(count($selectedItems)<1) response()->json(['success' => 0,'error' => "At least 1 selected Item"]);

        if(BotController::$deposit==null){
            BotController::loginDeposit();
        }
        $depositTradeOffers=BotController::$deposit->tradeOffers();

        if(count( BotController::$bot)!=3){
            BotController::loginBot($random);
        } else if(BotController::$bot[$random]==null){
            BotController::loginBot($random);
        }

        $tradeOffers = BotController::$bot[$random]->tradeOffers();

        $transactionId=0;
        $transactionId=BotController::sendTakeTradeOffer(Auth::user()->steamid,$token,$tradeOffers,$selectedItems);
        if($transactionId==0) response()->json(['success' => 0,'error' => "Unexpected Error please try again"]);

        $transaction = new Transaction;
        $transaction->items = $selectedItems;
        $transaction->price = $price;
        $transaction->type="userToBot";
        $transaction->bot=$random;
        $transaction->account=Auth::user()->steamid;
        $transaction->transactionId=$transactionId;
        $transaction->save();
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
        $random = 1;

        $token = BotController::splitTradeToken(Auth::user()->tradeToken);
        if($token=="") return response()->json(['success' => 0,'error' => "Please set trade token in profile"]);

        $selectedItems = json_decode(json_encode($request->json()->all()));

        $price = BotController::getItemPriceFromInventory(json_decode(Storage::disk('local')->get('depositInventory.json'))->inventory->inventory,$selectedItems);

        if(Auth::user()->balance<$price) return response()->json(['success' => 0,'error' => "Not Enough Money"]);

        if(count($selectedItems)<1) return response()->json(['success' => 0,'error' => "At least 1 selected Item"]);

        $tradeOffers = BotController::$bot[$random]->tradeOffers();

        $transactionId=0;
        $transactionId = BotController::sendTakeTradeOffer(config("rustix.depositId"),config("rustix.depositToken"),$tradeOffers,$selectedItems);
        if($transactionId==0) response()->json(['success' => 0,'error' => "Unexpected Error please try again"]);

        $transaction = new Transaction;
        $transaction->items = $selectedItems;
        $transaction->price = $price;
        $transaction->type="depositToBot";
        $transaction->bot=$random;
        $transaction->account=Auth::user()->steamid;
        $transaction->transactionId=$transactionId;
        $transaction->save();

        return response()->json(['success' => 1]);

    }
    public static function mobileAccept($account,$transactions){
        $accepted = [];
        $retry=true;
        while($retry){
            try{
                $confirmations =$account->mobileAuth()->confirmations()->fetchConfirmations();
                foreach ($confirmations as $confirmation) {
                    foreach ($transactions as $transaction) {
                        if($account->mobileAuth()->confirmations()->getConfirmationTradeOfferId($confirmation)==$transaction->transactionId){
                            if($account->mobileAuth()->confirmations()->acceptConfirmation($confirmation)){
                                array_push($accepted,$transaction);
                            }

                        }
                    }
                }
                $retry=false;
            } catch (WgTokenInvalidException $ex) {
                $account->mobileAuth()->refreshMobileSession();
                $retry=true;
            }
        }
        return $accepted;
    }

    public static function transactionDone($transactions){
        foreach ($transactions as $transaction) {
            $transaction->done=true;
            $transaction->save();
        }
    }
    public static function transactionStepToBotToUser($transactions){
        foreach ($transactions as $transaction) {
            $newTransactionId=0;
            $newTransactionId = BotController::sendGiveTradeOffer($transaction->account,$transaction->token,BotController::$bot[$transaction->bot],$transaction->items);
            if($newTransactionId=0){
                $transaction->error=true;
            }
            $newTransaction = new Transaction;
            $newTransaction->transactionId=$newTransactionId;
            $newTransaction->type="botToUser";
            $newTransaction->items=$transaction->items;
            $newTransaction->price=$transaction->price;
            $newTransaction->account=$transaction->account;
            $newTransaction->bot=$transaction->bot;
            $newTransaction->save();
            $transaction->done=true;
            $transaction->save();
        }
    }
    public static function transactionStepToBotToDeposit($transactions){
        foreach ($transactions as $transaction) {
            $newTransactionId=0;
            $newTransactionId = BotController::sendGiveTradeOffer(config("rustix.depositId"),config("rustix.depositToken"),BotController::$bot[$transaction->bot],$transaction->items);
            if($newTransactionId=0){
                $transaction->error=true;
            }
            $newTransaction = new Transaction;
            $newTransaction->transactionId=$newTransactionId;
            $newTransaction->type="botToDeposit";
            $newTransaction->items=$transaction->items;
            $newTransaction->price=$transaction->price;
            $newTransaction->account=$transaction->account;
            $newTransaction->bot=$transaction->bot;
            $newTransaction->save();
            $transaction->done=true;
            $transaction->save();
        }
    }
    public static function processTransactions(){
        $depositToBotTransactions = Transaction::where("done",false)->where("error",false)->where("type","depositToBot")->get();
        $userToBotTransactions = Transaction::where("done",false)->where("error",false)->where("type","userToBot")->get();

        $botToDepositTransactions = Transaction::where("done",false)->where("error",false)->where("type","botToDeposit")->get();
        $botToUserTransactions = Transaction::where("done",false)->where("error",false)->where("type","botToUser")->get();

        $userToBotAccepted = BotController::mobileAccept(BotController::$bot[1],$userToBotTransactions::where("bot",1));
        BotController::transactionStepToBotToDeposit($userToBotAccepted);
        $userToBotAccepted = BotController::mobileAccept(BotController::$bot[2],$userToBotTransactions::where("bot",2));
        BotController::transactionStepToBotToDeposit($userToBotAccepted);
        $userToBotAccepted = BotController::mobileAccept(BotController::$bot[3],$userToBotTransactions::where("bot",3));
        BotController::transactionStepToBotToDeposit($userToBotAccepted);

        $depositToBotAccepted = BotController::mobileAccept(BotController::$bot[1],$depositToBotTransactions::where("bot",1));
        BotController::transactionStepToBotToUser($depositToBotAccepted);
        $depositToBotAccepted = BotController::mobileAccept(BotController::$bot[2],$depositToBotTransactions::where("bot",2));
        BotController::transactionStepToBotToUser($depositToBotAccepted);
        $depositToBotAccepted = BotController::mobileAccept(BotController::$bot[3],$depositToBotTransactions::where("bot",3));
        BotController::transactionStepToBotToUser($depositToBotAccepted);

        $botToDepositAccepted = BotController::mobileAccept(BotController::$deposit,$botToDepositTransactions);
        BotController::transactionDone($botToDepositAccepted);
        $botToUserAccepted = BotController::mobileAccept(BotController::$bot[1],$botToUserTransactions::where("bot",1));
        BotController::transactionDone($botToUserAccepted);
        $botToUserAccepted = BotController::mobileAccept(BotController::$bot[2],$botToUserTransactions::where("bot",2));
        BotController::transactionDone($botToUserAccepted);
        $botToUserAccepted = BotController::mobileAccept(BotController::$bot[3],$botToUserTransactions::where("bot",3));
        BotController::transactionDone($botToUserAccepted);
    }
}

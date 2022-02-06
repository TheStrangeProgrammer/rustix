<?php

namespace App\Jobs;

use App\Http\Controllers\BotController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Events\NewBalance;
use waylaidwanderer\SteamCommunity\MobileAuth\WgTokenInvalidException;
class ProcessWithdraw implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $toSteamId;
    protected $token;
    protected $selectedItems;
    protected $price;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($toSteamId,$token,$selectedItems,$price)
    {
        $this->toSteamId = $toSteamId;
        $this->token = $token;
        $this->selectedItems = $selectedItems;
        $this->price = $price;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
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
        $depositToBotId=0;
        while($depositToBotId==0){
            $depositToBotId=BotController::sendTakeTradeOffer(config("rustix.depositId"),config("rustix.depositToken"),$tradeOffers,$this->selectedItems);
        }
        //Log::info("D2B Offer Sent");
        BotController::acceptTradeOffer($depositToBotId,$depositTradeOffers);
        $retry = true;
        while($retry){
            try{
                $confirmations =BotController::$deposit->mobileAuth()->confirmations()->fetchConfirmations();
                foreach ($confirmations as $confirmation) {
                    if(BotController::$deposit->mobileAuth()->confirmations()->getConfirmationTradeOfferId($confirmation)==$depositToBotId){
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
        //Log::info("D2B Offer Accepted");
        $items = $tradeOffers->getItems(intval($depositToBotId));

        $user = User::where('steamid', $this->toSteamId)->first();
        if($user->balance<$this->price) return;

        $botToUserId=0;
        while($botToUserId==0){
            $botToUserId = BotController::sendGiveTradeOffer($this->toSteamId,$this->token,$tradeOffers,$items);
        }
        //Log::info("B2U Offer Sent");
        if($user->balance<$this->price) return;
        $retry = true;
        while($retry){
            try{
                $confirmations =BotController::$bot[$random]->mobileAuth()->confirmations()->fetchConfirmations();
                foreach ($confirmations as $confirmation) {
                    if(BotController::$bot[$random]->mobileAuth()->confirmations()->getConfirmationTradeOfferId($confirmation)==$botToUserId){
                        if($user->balance<$this->price) return;
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
        }
       // Log::info("B2U Offer Accepted");

       $user->balance-=$this->price;

       $user->save();
       event(new NewBalance($user->id,$user->balance));
    }
}

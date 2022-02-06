<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\BotController;
use App\Models\User;
use waylaidwanderer\SteamCommunity\MobileAuth\WgTokenInvalidException;
use App\Events\NewBalance;
class ProcessDeposit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $toSteamId;
    protected $token;
    protected $tradeId;
    protected $botId;
    protected $price;
    protected $selectedItems;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($toSteamId,$token,$tradeId,$botId,$selectedItems,$price)
    {
        $this->toSteamId = $toSteamId;
        $this->token = $token;
        $this->tradeId = $tradeId;
        $this->botId = $botId;
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
        $random = $this->botId;
        if(count( BotController::$bot)!=3){
            BotController::loginBot($random);
        } else if(BotController::$bot[$random]==null){
            BotController::loginBot($random);
        }

        $tradeOffers = BotController::$bot[$random]->tradeOffers();

        $items = $tradeOffers->getItems(intval($this->tradeId));

        $botToDepositId=0;
        while($botToDepositId==0){
            $botToDepositId = BotController::sendGiveTradeOffer(config("rustix.depositId"),config("rustix.depositToken"),$tradeOffers,$items);
        }
        $retry = true;
        while($retry){
            try{
                $confirmations =BotController::$bot[$random]->mobileAuth()->confirmations()->fetchConfirmations();
                foreach ($confirmations as $confirmation) {
                    if(BotController::$bot[$random]->mobileAuth()->confirmations()->getConfirmationTradeOfferId($confirmation)==$botToDepositId){
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
        BotController::acceptTradeOffer($botToDepositId,$depositTradeOffers);

        $user = User::where('steamid', $this->toSteamId)->first();
        $user->balance+=$this->price;

        $user->save();
        event(new NewBalance($user->id,$user->balance));
    }
}

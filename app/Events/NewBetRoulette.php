<?php

namespace App\Events;

use App\Http\Controllers\RouletteController;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class NewBetRoulette implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bet;
    public $userId;
    public $amount;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, $bet,$amount)
    {
        $this->userId = $userId;
        $this->bet = $bet;
        $this->amount = $amount;

        $user = User::where('id', $userId)->first();
        if($amount>$user->balance){
            return;
        }
        if($bet!=0&&$bet!=1&&$bet!=2&&$bet!=3){
            return;
        }
        $user->balance-=$amount;
        $user->save();
        event(new NewBalance($user->id,$user->balance));
        RouletteController::addBet($user->id,$user->name,$user->avatar,$bet,$amount);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('betRoulette');
    }
}

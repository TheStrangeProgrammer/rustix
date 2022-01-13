<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Events\NewBalance;
use App\Models\User;
use App\Http\Requests\InventoryRequest;

class UserController extends Controller
{

    const inventoryDelay=30;

    public function getUserInventory()
    {
        $lastInventroyAccess=session('lastInventroyAccess');


        if($lastInventroyAccess==null||now()->diffInSeconds($lastInventroyAccess)>self::inventoryDelay){
            session(['lastInventroyAccess' => Carbon::now()]);
            $response = InventoryController::getInventory(Auth::user()->steamid);
            session(['inventory' => $response]);
            error_log(json_encode($response));
        }

        return view("layouts/inventory",['inventory' => session('inventory')]);
    }

    public function updateBalance(Request $request) {
        $response = User::where('steamid',  $request->user)->first()->balance;

        event(new NewBalance($request->user,$response));

        return response($response,200);
    }
    public function depositItems(){

    }
    public function setTradeURL(){

    }
    public function addbalance() {
        /*$user = User::where('steamid',  Auth::user()->steamid)->first();
        $user->balance+=2;
        $user->save();

        event(new NewBalance($user->steamid,$user->balance));
        $response = Http::get('https://steamcommunity.com/market/priceoverview/?appid=252490&currency=1&market_hash_name=Shimmering Stone Hatchet');
            session(['inventory' => $response]);

            error_log($response);
*/
    }
}

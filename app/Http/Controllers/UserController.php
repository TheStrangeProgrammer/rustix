<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Events\NewBalance;
use App\Models\User;
use App\Http\Requests\InventoryRequest;
use App\Models\BettingHistory;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    const inventoryDelay=30;
    public function getUserInventory()
    {
        return view("layouts/inventory");
    }
    public static function resetFaucet(){
        User::query()->update(['faucet' => false]);
    }
    public function getFaucet(){
        return response()->json(['claimed'=>Auth::user()->faucet,'serverTime'=>Carbon::parse("24:0:0")->diffInSeconds(Carbon::parse(Carbon::now()->toTimeString()))]);
    }
    public function postFaucet(){
        if(Auth::user()->faucet==false){
            $user = User::where('id', Auth::user()->id)->first();
            $user->faucet=true;
            $user->balance+=100;
            $user->save();
        }

    }
    public function getItems(){
        $lastInventroyAccess=session('lastInventroyAccess');


        if($lastInventroyAccess==null||now()->diffInSeconds($lastInventroyAccess)>self::inventoryDelay){
            session(['lastInventroyAccess' => Carbon::now()]);
            $response = InventoryController::getInventory(Auth::user()->steamid);

            if($response!=null)
                session(['inventory' => $response]);
        }

        return session('inventory');
    }

    public function updateBalance(Request $request) {
        $response = User::where('id',  $request->user)->first()->balance;

        event(new NewBalance($request->user,$response));

        return response($response,200);
    }
    public function depositItems(){

    }
    public function addbalance() {

    }
    public function getReferrals(){
        $user = User::where('id', Auth::user()->id)->first();

        $data['referralCode'] = $user->referralCode;
        $referrer = User::where('id', Auth::user()->referredBy)->first();
        if($referrer!=null){
            $data['referrerName'] = $referrer->name;
        }else{
            $data['referrerName'] = null;
        }
        $data['referrals']=[];
        $users = User::where('referredBy', Auth::user()->id)->get();
        foreach($users as $userReferred){

            $data['referrals'][$userReferred->id]['name'] = $userReferred->name;
        }

        return $data;
    }
    public function getProfile(){
        $user = User::where('id', Auth::user()->id)->first();

        $data['totalDeposited'] = $user->totalDeposit;
        $data['totalGambled'] = $user->totalWithdraw;
        $data['tradeToken'] = $user->tradeToken;
        $histories = BettingHistory::where('user_id', Auth::user()->id)->latest()->take(100)->get();
        $betHistory=[];
        foreach($histories as $history){

            $betHistory[$history->id]["amount"] = $history->amount;
            $betHistory[$history->id]["game"] = $history->game;
            $betHistory[$history->id]["time"] = $history->created_at;
            $betHistory[$history->id]["won"] = $history->won;
        }
        $data['betHistory']=$betHistory;
        return $data;
    }
    public function setReferral(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $referringUser = User::where('referralCode',$request->referrerCode )->first();
        if($referringUser==null) return view("layouts/error",['error' => "code does not exist"]);
        if($referringUser->id==$user->id) return view("layouts/error",['error' => "you cannot refer yourself"]);
        $user->referredBy=$referringUser->id;
        $user->save();
        return redirect("profile");

    }
    public function setTradeToken(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $user->tradeToken=$request->tradeToken;
        $user->save();
        return redirect("profile");

    }
    public function roulette(){
        return view("layouts/roulette");
    }
    public function xroulette(){
        return view("layouts/x-roulette");
    }
    public function admin(){
        return view("layouts/admin");
    }
    public function placeBet(Request $request){
        $data = $request->json();
        $data["bet"];
        $data["betAmount"];
    }
    public function getCurrentSecond(){

        $currentSecond = abs(Carbon::now()->isoFormat('s')-60);
        return response()->json($currentSecond);
    }
    public function getXRouletteSpin(){
        $values=[];
        for ($i = 0; $i < 11; $i++) {
            $values[]= rand(100,10000) / 100;
        }

        return response()->json($values);
    }
}

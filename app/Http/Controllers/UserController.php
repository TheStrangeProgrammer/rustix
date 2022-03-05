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
            event(new NewBalance($user->id,$user->balance));
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
    public function setReferral(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        if($user->referralCode==null){
            $exists = User::where('referralCode', $request->json()->all()["referralCode"])->first();
            if($exists==null){
                $user->referralCode=$request->all()["referralCode"];
                $user->save();
                return response()->json(['success' => 1]);
            }
            return response()->json(['success' => 0,'error' => "Code exists"]);
        }
    }
    public function claimReferral(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        if($user->referredBy==null){
            $referringUser = User::where('referralCode',$request->json()->all()["referrerCode"] )->first();
            if($referringUser==null) return response()->json(['success' => 0,'error' => "Code does not exist"]);
            if($referringUser->id==$user->id) return response()->json(['success' => 0,'error' => "You cannot refer yourself"]);
            $user->referredBy=$referringUser->id;
            $user->balance+=10;
            $user->save();
            event(new NewBalance($user->id,$user->balance));
            $referringUser->balance+=100;
            $referringUser->save();
            event(new NewBalance($referringUser->id,$referringUser->balance));
            return response()->json(['success' => 1]);
        }
    }
    public function getReferrals(){
        $user = User::where('id', Auth::user()->id)->first();

        $data['referralCode'] = $user->referralCode;
        $data['referredBy'] = Auth::user()->referredBy;

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


    public function setTradeToken(Request $request){
        $tradeToken=$request->json()->all()["tradeUrl"];
        $user = User::where('id', Auth::user()->id)->first();
        $user->tradeToken=$tradeToken;
        $user->save();
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

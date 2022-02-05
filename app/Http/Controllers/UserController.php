<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Events\NewBalance;
use App\Models\User;
use App\Http\Requests\InventoryRequest;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    const inventoryDelay=30;
    public function getUserInventory()
    {
        $lastInventroyAccess=session('lastInventroyAccess');


        if($lastInventroyAccess==null||now()->diffInSeconds($lastInventroyAccess)>self::inventoryDelay){
            session(['lastInventroyAccess' => Carbon::now()]);
            $response = InventoryController::getInventory(Auth::user()->steamid);

            if($response!=null)
                session(['inventory' => $response]);
        }

        return view("layouts/inventory",['inventory' => session('inventory')]);
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
    public function getProfile(){
        $user = User::where('id', Auth::user()->id)->first();

        $data['totalDeposit'] = $user->totalDeposit;
        $data['totalWithdraw'] = $user->totalWithdraw;
        $data['totalSpent'] = $user->totalSpent;
        $data['tradeToken'] = $user->tradeToken;

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

        return view("layouts/profile",$data);
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

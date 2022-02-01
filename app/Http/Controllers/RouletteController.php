<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Events\NewBalance;
use App\Models\User;
use App\Http\Requests\InventoryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class RouletteController extends Controller
{
    public function roulette(){
        return view("layouts/roulette");
    }
    public static function randomOutcome(){
        return rand(0,14);
    }
    public function getSpin(){
        $roulette = json_decode(Storage::disk('local')->get('rouletteData.json'));
        $data['outcome'] = $roulette->rouletteRoll;
        $data["currentSecond"] = abs(Carbon::now()->isoFormat('s')-60)%30;
        $data["rouletteLast100"]=$roulette->rouletteLast100;

        return response()->json($data);
    }
    public function getBets(){
        $data["bets"]=json_decode(Storage::disk('local')->get('rouletteData.json'))->bets;
        return response()->json($data);
    }
    public function placeBet(Request $request){

        if(abs(Carbon::now()->isoFormat('s')-60)%30<1){
            $response["success"]=false;
            $response["error"]="Too late";
            return response()->json($response);
        }

        $data = $request->all();
        $betAmount = intval($data["betAmount"]);
        if($betAmount<1){
            $response["success"]=false;
            $response["error"]="At least 1 coin";
            return response()->json($response);
        }
        $user = User::where('id', Auth::user()->id)->first();
        if($betAmount>$user->balance){
            $response["success"]=false;
            $response["error"]="Not enough coins";
            return response()->json($response);
        }
        if($data["bet"]!=0&&$data["bet"]!=1&&$data["bet"]!=2&&$data["bet"]!=3){
            $response["success"]=false;
            $response["error"]="Unknown Bet";
            return response()->json($response);
        }

        $user->balance-=$betAmount;
        $user->save();
        event(new NewBalance(Auth::user()->id,$user->balance));
        RouletteController::addBet(Auth::user()->id,Auth::user()->name,Auth::user()->avatar,$data["bet"],$betAmount);

        $response["success"]=true;
        $response["error"]="";
        return response()->json($response);
    }

    private static function addBet($userId,$userName,$userAvatar,$bet,$betAmount){
        $roulette = json_decode(Storage::disk('local')->get('rouletteData.json'),true);
        $toPlace=[
            "name" =>$userName,
            "avatar" =>$userAvatar,
            "amount" =>$betAmount,
        ];
        if($bet==0){
            if (array_key_exists($userId, $roulette["bets"]["red"]))
                $roulette["bets"]["red"][$userId]["amount"]=$roulette["bets"]["red"][$userId]["amount"]+$betAmount;
            else
                $roulette["bets"]["red"][$userId]=$toPlace;
        }
        if($bet==1){
            if (array_key_exists($userId,$roulette["bets"]["green"]))
                $roulette["bets"]["green"][$userId]["amount"]=$roulette["bets"]["green"][$userId]["amount"]+$betAmount;
            else
            $roulette["bets"]["green"][$userId]=$toPlace;
        }
        if($bet==2){
            if (array_key_exists($userId,$roulette["bets"]["black"]))
                $roulette["bets"]["black"][$userId]["amount"]=$roulette["bets"]["black"][$userId]["amount"]+$betAmount;
            else
            $roulette["bets"]["black"][$userId]=$toPlace;
        }
        if($bet==3){
            if (array_key_exists($userId,$roulette["bets"]["bait"]))
                $roulette["bets"]["bait"][$userId]["amount"]=$roulette["bets"]["bait"][$userId]["amount"]+$betAmount;
            else
            $roulette["bets"]["bait"][$userId]=$toPlace;
        }
        Storage::disk('local')->put('rouletteData.json', json_encode($roulette));
    }

    private static function setup(){
        $roulette["rouletteRoll"] = 0;
        $roulette["rouletteLast100"]=[];
        $roulette["bets"]=[
            "red"=>[],
            "green"=>[],
            "black"=>[],
            "bait"=>[]
    ];
        Storage::disk('local')->put('rouletteData.json', json_encode($roulette));
    }

    private static function addLast100($last100,$outcome){
        if(count($last100)>=100){
            array_pop($last100);
        }
        array_unshift($last100,$outcome);
        return $last100;
    }

    public static function newOutcome(){
        if(!Storage::disk('local')->exists('rouletteData.json')){
            RouletteController::setup();
        }
        $roulette = json_decode(Storage::disk('local')->get('rouletteData.json'));

        $roulette->rouletteRoll=RouletteController::randomOutcome();
        RouletteController::processWins($roulette->rouletteRoll,$roulette->bets);
        $roulette->bets=[
            "red"=>[],
            "green"=>[],
            "black"=>[],
            "bait"=>[]
        ];
        $roulette->rouletteLast100 = RouletteController::addLast100($roulette->rouletteLast100,$roulette->rouletteRoll);

        Storage::disk('local')->put('rouletteData.json', json_encode($roulette));
    }

    public static function processWins($outcome,$bets){
        if($outcome<=6){
            if($outcome%2==0) {
                RouletteController::updateBalance($bets->black,2);
            }
            else {
                RouletteController::updateBalance($bets->red,2);
            }
            if($outcome==6){
                RouletteController::updateBalance($bets->bait,7);
            }
        } else if($outcome==7){
            RouletteController::updateBalance($bets->green,14);
        } else if($outcome>=8){
            if($outcome%2==1){
                RouletteController::updateBalance($bets->black,2);
            }
            else{
                RouletteController::updateBalance($bets->red,2);
            }
            if($outcome==8){
                RouletteController::updateBalance($bets->bait,7);
            }
        }
    }

    public static function updateBalance($wins,$multiplier){

        foreach($wins as $key=>$value){
            $value->amount*=$multiplier;
            $user = User::where('id',$key)->first();
            $user->balance+=$value->amount;
            $user->save();
            event(new NewBalance($key,$user->balance));
        }
    }
}

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


class XRouletteController extends Controller
{
    public function roulette(){
        return view("layouts/x-roulette");
    }
    public static function randomOutcomeList(){
        $outcomes=[];
        for($i=0;$i<15;$i++){
            $outcomes[]=round(min(1000000.0,max(1.0,floor(100.0*(1.0-0.05)/((float)rand() / (float)getrandmax()))/100)),2);
        }
        return $outcomes;
    }
    public static function randomOutcome(){
        return rand(0,14);
    }
    public function getSpin(){
        $roulette = json_decode(Storage::disk('local')->get('xrouletteData.json'));
        $data['outcome'] = $roulette->rouletteRoll;
        $data['outcomes'] = $roulette->rouletteOutcomes;
        $data["currentSecond"] = abs(Carbon::now()->isoFormat('s')-60)%30;
        $data["rouletteLast10"]=$roulette->rouletteLast10;

        return response()->json($data);
    }
    public function getBets(){
        $data["bets"]=json_decode(Storage::disk('local')->get('xrouletteData.json'))->bets;
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
        if($data["bet"]<1.01){
            $response["success"]=false;
            $response["error"]="You can't bet negative";
            return response()->json($response);
        }

        $user->balance-=$betAmount;
        $user->save();
        event(new NewBalance(Auth::user()->id,$user->balance));
        XRouletteController::addBet(Auth::user()->id,Auth::user()->name,Auth::user()->avatar,$data["bet"],$betAmount);

        $response["success"]=true;
        $response["error"]="";
        return response()->json($response);
    }

    private static function addBet($userId,$userName,$userAvatar,$bet,$betAmount){
        $roulette = json_decode(Storage::disk('local')->get('xrouletteData.json'),true);
        array_push($roulette["bets"],[
            "id"=>$userId,
            "name" =>$userName,
            "avatar" =>$userAvatar,
            "amount" =>$betAmount,
            "bet" =>$bet,
        ]);
        Storage::disk('local')->put('xrouletteData.json', json_encode($roulette));
    }

    private static function setup(){
        $roulette["rouletteRoll"] = 0;
        $roulette["rouletteOutcomes"] = [];
        $roulette["rouletteLast10"]=[];
        $roulette["bets"]=[];
        Storage::disk('local')->put('xrouletteData.json', json_encode($roulette));
    }

    private static function addLast10($last10,$outcome){
        if(count($last10)>=10){
            array_pop($last10);
        }
        array_unshift($last10,$outcome);
        return $last10;
    }

    public static function newOutcome(){
        if(!Storage::disk('local')->exists('xrouletteData.json')){
            XRouletteController::setup();
        }
        $roulette = json_decode(Storage::disk('local')->get('xrouletteData.json'));

        $roulette->rouletteOutcomes = XRouletteController::randomOutcomeList();

        $roulette->rouletteRoll=XRouletteController::randomOutcome();
        XRouletteController::processWins($roulette->rouletteOutcomes[$roulette->rouletteRoll],$roulette->bets);
        $roulette->bets=[];
        $roulette->rouletteLast10 = XRouletteController::addLast10($roulette->rouletteLast10,$roulette->rouletteOutcomes[$roulette->rouletteRoll]);

        Storage::disk('local')->put('xrouletteData.json', json_encode($roulette));
    }

    public static function processWins($outcome,$bets){
        foreach($bets as $key=>$value){
            if($outcome>$value->bet){
                $value->amount*=$value->bet;
                $user = User::where('id',$value->id)->first();
                $user->balance+=round($value->amount);
                $user->save();
                event(new NewBalance($value->id,$user->balance));
            }

        }
    }


}

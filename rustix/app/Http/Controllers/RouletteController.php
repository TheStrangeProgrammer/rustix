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


class RouletteController extends Controller
{
    public function roulette(){
        return view("layouts/roulette");
    }

    public function getRouletteSpin(){
        $roulette = json_decode(Storage::disk('local')->get('rouletteData.json'));
        $data['outcome'] = $roulette->rouletteRoll;
        $data["currentSecond"] = abs(Carbon::now()->isoFormat('s')-60)%30;
        $data["rouletteLast100"]=$roulette->rouletteLast100;
        //$data["win"]=array_search(,$roulette->wins)
        return response()->json($data);
    }

    public function placeBet(Request $request){

        if(abs(Carbon::now()->isoFormat('s')-60)%30<1){
            $response["success"]=false;
            $response["error"]="Too late";
            return response()->json($response);
        }
        $data = $request->json();
        if($data["betAmount"]>Auth::user()->balance){
            $response["success"]=false;
            $response["error"]="Not enough coins";
            return response()->json($response);
        }
        if($data["bet"]!=0||$data["bet"]!=1||$data["bet"]!=2||$data["bet"]!=3){
            $response["success"]=false;
            $response["error"]="Unknown Bet";
            return response()->json($response);
        }
        RouletteController::addBet(Auth::user()->id,$data["bet"],$data["betAmount"]);

        $response["success"]=true;
        $response["error"]="";
        return response()->json($response);
    }

    private static function addBet($userId,$bet,$betAmount){
        $roulette = json_decode(Storage::disk('local')->get('rouletteData.json'));
        if($bet==0){
            array_push($roulette->bets->red,["user"=>$userId,"bet"=>$bet]);
        }
        if($bet==1){
            array_push($roulette->bets->green,["user"=>$userId,"bet"=>$bet]);
        }
        if($bet==2){
            array_push($roulette->bets->black,["user"=>$userId,"bet"=>$bet]);
        }
        if($bet==3){
            array_push($roulette->bets->bait,["user"=>$userId,"bet"=>$bet]);
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

        $roulette->rouletteRoll=rand(0,14);
        $roulette->wins=RouletteController::processBets($roulette->rouletteRoll,$roulette->bets);
        $roulette->rouletteLast100 = RouletteController::addLast100($roulette->rouletteLast100,$roulette->rouletteRoll);

        Storage::disk('local')->put('rouletteData.json', json_encode($roulette));
    }

    public static function toBet($value){
        $bet=-1;
        if($value<6){
            if($value%2==0) {
                $bet=2;
            }
            else {
                $bet=0;
            }
        }
        if($value==6){
            $bet=3;
        }
        if($value==7){
            $bet=1;
        }
        if($value==8){
            $bet=3;
        }
        if($value>8){
            if($value%2==1){
                $bet=2;
            }
            else{
                $bet=0;
            }
        }
        return $bet;
    }

    public static function processBets($outcome,$bets){
        $win = RouletteController::toBet($outcome);
        if($win==0){
            return $bets->red;
        }
        if($win==1){
            return $bets->green;
        }
        if($win==2){
            return $bets->black;
        }
        if($win==3){
            return $bets->bait;
        }
        return [];

    }
}

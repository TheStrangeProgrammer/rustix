<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BotController extends Controller
{
    const inventoryDelay=30;

    public function getDeposit()
    {
        $lastInventroyAccess=session('lastDepositAccess');


        if($lastInventroyAccess==null||now()->diffInSeconds($lastInventroyAccess)>self::inventoryDelay){
            session(['lastDepositAccess' => Carbon::now()]);
            $response = InventoryController::getDeposit();
            session(['deposit' => $response]);
        }

        return view("layouts/withdraw",['deposit' => session('deposit')]);
    }
    public static function depositItems(Request $request)
    {
        error_log($request);
        $selectedItems = $request->json()->all();
        $itemsToSell=[];
        foreach($selectedItems as $item){
            $itemsToSell[] = InventoryController::createItem($item['id'],$item['amount']);
        }
        $tradeoffer = array(
		    'newversion' => TRUE,
		    'version' => 2,
		    'me' => ['assets' => [], 'currency' => [], 'ready' => FALSE ],
		    'them' => ['assets' => [InventoryController::createItem(1141874039,1)], 'currency' => [], 'ready' => FALSE ]
	  	);
        $data = [
            'sessionid'=>Session::getId(),
            'serverid'=>1,
            'partner'=>Auth::user()->steamid,
            'tradeoffermessage'=>"Request from rustix bot",
            'json_tradeoffer'=>'',
            'captcha'=>'',
            'trade_offer_create_params'=>'',
            'tradeofferid_countered'=>''
        ];
        //$response= Http::withHeaders([
        //    'referer' => 'foo'
        //])->post('https://steamcommunity.com/tradeoffer/new/send', $data);




    }
    public static function withdrawItems($tradeURL,$items)
    {
        session(['lastDepositAccess' => Carbon::now()]);
        $response = InventoryController::getDeposit();
        session(['deposit' => $response]);
        return view("layouts/withdraw",['deposit' => session('deposit')]);
        return Http::get(sprintf(self::inventoryURL, $steamId, env('STEAM_APPID'), env('STEAM_CONTEXT')));
    }
}

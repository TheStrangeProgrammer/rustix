<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use waylaidwanderer\SteamCommunity\Enum\LoginResult;
use waylaidwanderer\SteamCommunity\MobileAuth\WgTokenInvalidException;
use waylaidwanderer\SteamCommunity\SteamCommunity;

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
        $settings=[
            "username"=> "labalamuc84",
            "password"=> "Mihaibingo1",
            "mobileAuth"=> [
                "sharedSecret"=> "f0KS077xz3VFMUxuhVwG4RVyn7A=",
                "identitySecret" => "VEY3hCgkOiNcuuVJFQ9wR82c4Eo=",
                "deviceId"=> "android:31802749-752d-461b-98d6-29463a7c1a9c"
            ]

        ];
        $steam = new SteamCommunity($settings,Storage::disk('local')->path('/'));
        $authCode = $steam->mobileAuth()->steamGuard()->generateSteamGuardCode();
        $steam->setTwoFactorCode($authCode);
        $loginResult = $steam->doLogin(true,false);
        $selectedItems = $request->json()->all();
        if ($loginResult == LoginResult::LoginOkay) {
            $tradeOffers = $steam->tradeOffers();
            $trade = $tradeOffers->createTrade(Auth::user()->steamid);
            foreach($selectedItems as $item){
                $trade->addOtherItem(env('STEAM_APPID'), env('STEAM_CONTEXT'), $item['id']);
            }

            error_log($trade->send());
        }
        error_log($loginResult);
        error_log($request->itemList);
        $selectedItems = $request->json()->all();
        $itemsToSell=[];
        foreach($selectedItems as $item){
            $itemsToSell[] = InventoryController::createItem($item['id'],$item['amount']);
        }
        $tradeoffer = array(
		    'newversion' => TRUE,
		    'version' => 2,
		    'me' => ['assets' => [], 'currency' => [], 'ready' => FALSE ],
		    'them' => ['assets' => $itemsToSell, 'currency' => [], 'ready' => FALSE ]
	  	);
        $data = [
            'sessionid'=>Session::getId(),
            'serverid'=>1,
            'partner'=>Auth::user()->steamid,
            'tradeoffermessage'=>"Request from rustix bot",
            'json_tradeoffer'=>$tradeoffer,
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

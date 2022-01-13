<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
class InventoryController extends Controller
{
    const inventoryURL = "https://steamcommunity.com/profiles/%s/inventory/json/%s/%s";
    const tradeofferURL = "https://steamcommunity.com/tradeoffer/new/?partener=%s&token=%s";

    private static function parseInventory($inventory) {

        if($inventory!=null){
            $parsed = ['success'=>$inventory['success'],'inventory'=>[] ];
            $parsed['success']=$inventory['success'];
            if($inventory['success']==1){
                foreach ($inventory['rgInventory'] as $item){
                    $itemId=$item['classid'].'_'.$item['instanceid'];
                    $itemDesc = $inventory['rgDescriptions'][$itemId];
                    if($itemDesc['tradable']==1){
                        $parsed['inventory'][$itemId]['id']=$item['classid'];
                        $parsed['inventory'][$itemId]['name']=$itemDesc['name'];
                        $parsed['inventory'][$itemId]['amount']=$item['amount'];
                        $parsed['inventory'][$itemId]['price']=PriceController::getItemPrice($itemDesc['market_hash_name']);
                        $parsed['inventory'][$itemId]['icon_url']='https://steamcommunity-a.akamaihd.net/economy/image/'.$itemDesc['icon_url'];
                    }
                }
            }
        }else{
            $parsed['success']=0;
        }
        return $parsed;
    }
    public static function createItem($itemId,$amount)
    {
        return[
            "appid" => env('STEAM_APPID'),
            "contextid" => env('STEAM_CONTEXT'),
            "amount" => $amount,
            "assetid" => $itemId
        ];
    }
    public static function getInventory($steamId)
    {
        $response = Http::get(sprintf(self::inventoryURL, $steamId, env('STEAM_APPID'), env('STEAM_CONTEXT')));

        return Self::parseInventory($response);
    }
    public static function getDeposit()
    {
        $response = Http::get(sprintf(self::inventoryURL, env('STEAM_DEPOSITID'), env('STEAM_APPID'), env('STEAM_CONTEXT')));
        return Self::parseInventory($response);
    }

}

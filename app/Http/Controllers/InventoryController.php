<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
class InventoryController extends Controller
{
    const inventoryURL = "https://steamcommunity.com/profiles/%s/inventory/json/%s/%s";

    private static function parseInventory($inventory) {
        if($inventory==null) return null;
        if(array_key_exists("success",$inventory)&&$inventory['success']==true){
            $parsed = ['success' => $inventory['success'],'inventory'=>[] ];
            $parsed['success']=$inventory['success'];
            if($inventory['success']==1){
                foreach ($inventory['rgInventory'] as $item){
                    $itemDescId=$item['classid'].'_'.$item['instanceid'];
                    $itemDesc = $inventory['rgDescriptions'][$itemDescId];
                    if($itemDesc['tradable']==1){
                        $parsed['inventory'][$item['id']]['id']=$item['id'];
                        $parsed['inventory'][$item['id']]['name']=$itemDesc['name'];
                        $parsed['inventory'][$item['id']]['amount']=$item['amount'];
                        $parsed['inventory'][$item['id']]['price']=PriceController::getItemPrice($itemDesc['market_hash_name']);
                        //$parsed['inventory'][$item['id']]['price']=0;
                        $parsed['inventory'][$item['id']]['icon_url']='https://steamcommunity-a.akamaihd.net/economy/image/'.$itemDesc['icon_url'];
                    }
                }
            }
        }else{
            $parsed['success']=0;
        }
        return $parsed;
    }

    public static function getInventory($steamId)
    {
        $response = Http::get(sprintf(self::inventoryURL, $steamId, config('rustix.steamAppId'), config('rustix.steamContext')));
        return InventoryController::parseInventory(json_decode($response,true));
    }


}

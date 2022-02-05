<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Models\ItemPrice;

class PriceController extends Controller
{
    const priceURL = 'https://steamcommunity.com/market/priceoverview/?appid=%s&currency=%s&market_hash_name=%s';

    public static function getItemPrice($marketHash)
    {

        $item = ItemPrice::where('itemHash', $marketHash)->first();
        if($item==null){
            $item=new ItemPrice;
            $item->itemHash=$marketHash;
            $response = Http::get(sprintf(self::priceURL, config('rustix.steamAppId'), 1,$marketHash));
            $item->itemPrice = str_replace("$","",$response["median_price"]);
            $item->save();
        }
        return (string)(floatval($item->itemPrice)*100);

    }
    public static function updateAllItemPrices(){
        $items = ItemPrice::all();
        foreach($items as $item){
            $response = Http::get(sprintf(self::priceURL, config('rustix.steamAppId'), 1,$item->itemHash));
            $item->itemPrice = str_replace("$","",$response["median_price"]);
            $item->save();
        }
    }


}

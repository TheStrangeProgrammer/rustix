<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;

class PriceController extends Controller
{
    const priceURL = 'https://steamcommunity.com/market/priceoverview/?appid=%s&currency=%s&market_hash_name=%s';

    public static function getItemPrice($marketHash)
    {
        $response = Http::get(sprintf(self::priceURL, config('rustix.steamAppId'), 1,$marketHash));
        return $response["median_price"];
    }
}

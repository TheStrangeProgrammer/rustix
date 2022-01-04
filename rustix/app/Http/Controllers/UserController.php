<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\NewBalance;
use App\Models\User;

class UserController extends Controller
{

    const userInventoryURL = "https://steamcommunity.com/profiles/%s/inventory/json/%s/%s";
    const inventoryDelay=30;

    private function getUrl(string $url): string
    {
        //return sprintf($url, Auth::user()->steamid, 252490, 2);
        return sprintf($url, 76561198980858975, 252490, 2);
    }

    public function getUserInventory()
    {
        $lastInventroyAccess=session('lastInventroyAccess','never');
        $afterDelay=$lastInventroyAccess;
        if($lastInventroyAccess!='never'){

            $afterDelay->addSeconds(self::inventoryDelay);
        }

        if($lastInventroyAccess=='never'||$afterDelay<now()){

            session(['lastInventroyAccess' => Carbon::now() ]);

            $response = Http::get($this->getUrl(self::userInventoryURL));
            session(['inventory' => $response ]);
            //$response = Http::get('https://api.steamapis.com/steam/inventory/'.Auth::user()->steamid.'/252490/2?api_key=SLmArBWVFkgqc5r5_izZrxyHroQ');
            error_log($response);
        }
        return view("layouts/inventory",['data' => session('inventory','never')]);

    }
    public function updateBalance(Request $request) {
        $response = User::where('steamid',  $request->user)->first()->balance;

        event(new NewBalance($request->user,$response));

        return response($response,200);

    }
    public function addbalance() {
        $user = User::where('steamid',  Auth::user()->steamid)->first();
        $user->balance+=2;
        $user->save();
        //Auth::user()->balance;
        event(new NewBalance($user->steamid,$user->balance));
        //event(new NewBalance($request->user,$response));

        //return response($response,200);

    }
}

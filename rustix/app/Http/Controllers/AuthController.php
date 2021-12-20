<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Exception;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('steam')->redirect();
    }
    public function callback()
    {
        try {

            $user = Socialite::driver('steam')->user();
            $isUser = User::where('steamid', $user->id)->first();

            if($isUser){
                Auth::login($isUser);
                return redirect('/');
            }else{
                $createUser = User::create([
                    'nickname' => $user->name,
                    'steamid' => $user->steamid,
                    'avatar' => $user->avatar
                ]);

                Auth::login($createUser);
                return redirect('/');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}

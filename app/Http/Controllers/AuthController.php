<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Exception;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('steam')->redirect();
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function callback()
    {
        try {

            $user = Socialite::driver('steam')->user();
            $isUser = User::where('steamid', $user->id)->first();

            if($isUser){
                Auth::login($isUser);
                $isUser->name=$user->nickname;
                $isUser->avatar=$user->avatar;
                $isUser->save();
                return redirect('/');
            }else{
                $createUser = User::create([
                    'name' => $user->nickname,
                    'steamid' => $user->id,
                    'avatar' => $user->avatar,
                    'referralCode' => uniqid(),
                    'balance' => 2000,
                    'totalDeposit' => 0,
                    'totalWithdraw' => 0,
                    'totalSpent' => 0
                ]);

                Auth::login($createUser);
                return redirect('/');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\RouletteController;
use App\Http\Controllers\XRouletteController;
use App\Http\Controllers\MessageController;
use Laravel\Socialite\Facades\Socialite;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.home');
})->name('home');

Route::get('/contact', function () {
    return view('layouts.contact');


});
Route::get('/register', function () {
    return view('layouts.register');


});
Route::get('/wheel', function () {
    return view('layouts.christmaswheel');


});


Route::get('/auth/redirect', function () {
    return Socialite::driver('steam')->redirect();
})->name('login');


Route::get('/auth/callback', [AuthController::class, 'callback']);
Route::get('/inventory', [UserController::class, 'getUserInventory'])->middleware('auth')->name("getUserInventory");

Route::post('/setReferral', [UserController::class, 'setReferral'])->middleware('auth')->name("setReferral");

Route::post('/depositContinue', [BotController::class, 'depositContinue'])->middleware('auth')->name("depositContinue");

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name("logOut");
Route::get('/faucet', [UserController::class, 'getFaucet'])->middleware('auth')->name("getFaucet");
Route::post('/faucet', [UserController::class, 'postFaucet'])->middleware('auth')->name("postFaucet");
Route::prefix('deposit')->group(function () {
    Route::get('/getItems', [UserController::class, 'getItems'])->middleware('auth')->name("getItems");
    Route::post('/depositItems', [BotController::class, 'depositItems'])->middleware('auth')->name("depositItems");
});

Route::prefix('withdraw')->group(function () {
    Route::get('/getItems', [BotController::class, 'getItems'])->middleware('auth')->name("getItems");
    Route::post('/withdrawItems', [BotController::class, 'withdrawItems'])->middleware('auth')->name("withdrawItems");
});

Route::prefix('profile')->group(function () {
    Route::get('/getProfile', [UserController::class, 'getProfile'])->middleware('auth')->name("getProfile");
    Route::post('/setTradeToken', [UserController::class, 'setTradeToken'])->middleware('auth')->name("setTradeToken");
});

Route::prefix('roulette')->group(function () {
    Route::get('/', [RouletteController::class, 'roulette'])->name('roulette');
    Route::post('/bet', [RouletteController::class, 'placeBet'])->middleware('auth');
});
Route::prefix('x-roulette')->group(function () {
    Route::get('/', [XRouletteController::class, 'roulette'])->name('x-roulette');
    Route::post('/bet', [XRouletteController::class, 'placeBet'])->middleware('auth');
});
Route::post('/message', [MessageController::class ,'broadcast'])->middleware('auth');

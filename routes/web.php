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


});

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
Route::get('/profile', [UserController::class, 'getProfile'])->middleware('auth')->name("getProfile");
Route::post('/setReferral', [UserController::class, 'setReferral'])->middleware('auth')->name("setReferral");
Route::post('/setTradeUrl', [UserController::class, 'setTradeUrl'])->middleware('auth')->name("setTradeUrl");
Route::post('/depositItems', [BotController::class, 'depositItems'])->middleware('auth')->name("depositItems");
Route::get('/withdraw', [BotController::class, 'getDeposit'])->middleware('auth')->name("getDeposit");
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name("logOut");

Route::prefix('roulette')->group(function () {
    Route::get('/', [RouletteController::class, 'roulette'])->name('roulette');
    Route::post('/bet', [RouletteController::class, 'placeBet'])->middleware('auth');
});
Route::prefix('x-roulette')->group(function () {
    Route::get('/', [XRouletteController::class, 'roulette'])->name('x-roulette');
    Route::post('/bet', [XRouletteController::class, 'placeBet'])->middleware('auth');
});
Route::post('/message', [MessageController::class ,'broadcast'])->middleware('auth');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\RouletteController;
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
Route::get('/addbalance', [UserController::class, 'addbalance'])->middleware('auth');
Route::get('/roulette', [RouletteController::class, 'roulette'])->middleware('auth');
Route::get('/x-roulette', [UserController::class, 'xroulette'])->middleware('auth');
Route::get('/getRouletteSpin', [RouletteController::class, 'getRouletteSpin'])->middleware('auth');
Route::get('/getBets', [RouletteController::class, 'getBets']);
Route::post('/placeBet', [RouletteController::class, 'placeBet'])->middleware('auth');
Route::get('/getCurrentSecond', [UserController::class, 'getCurrentSecond'])->middleware('auth');
Route::get('/admin', [UserController::class, 'admin'])->middleware('auth');
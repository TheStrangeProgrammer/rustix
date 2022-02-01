<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RouletteController;
use App\Http\Controllers\XRouletteController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/messages', [MessageController::class ,'getMessages']);
Route::post('/balance', [UserController::class ,'updateBalance']);


Route::prefix('roulette')->group(function () {
    Route::get('/spin', [RouletteController::class, 'getSpin']);
    Route::get('/bets', [RouletteController::class, 'getBets']);
});
Route::prefix('x-roulette')->group(function () {
    Route::get('/spin', [XRouletteController::class, 'getSpin']);
    Route::get('/bets', [XRouletteController::class, 'getBets']);
});

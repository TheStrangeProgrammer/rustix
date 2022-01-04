<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
})->name('steam');

Route::get('/auth/callback', [AuthController::class, 'callback']);
Route::get('/inventory', [UserController::class, 'getUserInventory'])->name("getUserInventory");
Route::get('/logout', [AuthController::class, 'logout'])->name("logOut");
Route::get('/addbalance', [UserController::class, 'addbalance']);

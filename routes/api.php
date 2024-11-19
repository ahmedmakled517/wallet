<?php

use App\Http\Controllers\AppUser\AlertController;
use App\Http\Controllers\AppUser\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => ['tokencheck'],

], function ($router) {
  ///wallet
  Route::get('/user-balance', [WalletController::class, 'userBalance']);
  Route::post('/add-balance', [WalletController::class, 'addBalance']);
  Route::post('/transfer-balance', [WalletController::class, 'transferBalance']);
  Route::get('/donation', [WalletController::class, 'GetDonatePartner']);
  Route::post('donation/{id}', [WalletController::class, 'donation']);
  Route::post('alert', [AlertController::class, 'store']);
});
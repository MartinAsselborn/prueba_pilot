<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosnetController;
use App\Http\Controllers\EsPrimoController;

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



Route::post('/register-card', [PosnetController::class, 'registerCard']);
Route::post('/do-payment', [PosnetController::class, 'doPayment']);

Route::get('/es-primo', [EsPrimoController::class, 'esPrimo']);
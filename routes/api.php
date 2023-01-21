<?php

use App\Http\Controllers\DistributorDashboardController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/payments/m_wallet/confirm/0', [ShopController::class, "captureMpesaPayment"]);
Route::post('/payments/m_wallet/confirm/1', [DistributorDashboardController::class, "captureMpesaPayment"]);

Route::post('/payments/m_wallet/query/1', [DistributorDashboardController::class, 'queryMpesaPayment']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

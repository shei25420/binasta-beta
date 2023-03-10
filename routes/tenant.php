<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DistributorShopController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Auth\Admin\AuthenticationController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', [DistributorShopController::class, 'fetchProducts']);
    Route::get('/products/{slug}', [DistributorShopController::class, 'show']);
    Route::get('/checkout', [DistributorShopController::class, 'checkout']);
    Route::get('/invoice/{ref}', [DistributorShopController::class, 'invoice']);
    Route::post('/make_payment', [DistributorShopController::class, 'makePayment']);
    Route::post('/capture/paypal', [DistributorShopController::class, 'capturePaypalPayment']);

    Route::post('/orders', [OrderController::class, 'store']);

    Route::get('/login', [AuthenticationController::class, 'create'])->name('shop.login.create');
    Route::post('/login', [AuthenticationController::class, 'store'])->name('shop.login.store');

    Route::post('/logout', [AuthenticationController::class, 'destroy'])->name('shop.logout');

    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [DistributorShopController::class, 'register']);
});

<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/products', [ShopController::class, 'fetchProducts']);
    Route::get('/products/{slug}', [ShopController::class, 'show'])->name('shop.products.show');

    Route::get('/checkout', [ShopController::class, 'checkout']);

    Route::get('/login', [AuthenticationController::class, 'create'])->name('shop.login.create');
    Route::post('/login', [AuthenticationController::class, 'store'])->name('shop.login.store');

    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [ShopController::class, 'register']);

    Route::get('/terms', [MainController::class, "terms"]);
});

// Authenticated Routes
Route::middleware("auth")->group(function () {
    Route::get('/invoice/{ref}', [ShopController::class, 'invoice']);
    Route::post('/make_payment', [ShopController::class, 'makePayment']);
    Route::post('/capture/paypal', [ShopController::class, 'capturePaypalPayment']);

    Route::post('/orders', [OrderController::class, 'store']);

    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

Broadcast::routes();

<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\Admin\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get('/login', [AuthenticationController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create']);
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
    
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');

    Route::get('/terms', [MainController::class, "terms"]);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/orders', [UserController::class, 'orders'])->name('user.orders');
    Route::get('/orders/{ref}', [UserController::class, 'fetchOrderProducts']);
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

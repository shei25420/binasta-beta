<?php
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessSubscriberController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BusinessController::class, 'index'])->name('business.index');
Route::post('/subscribe', [BusinessSubscriberController::class, 'store'])->name('business.subscribe');
Route::get('/terms', [MainController::class, "terms"]);

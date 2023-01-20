<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\DistributorOrderController;
use App\Http\Controllers\DistributorReviewController;
use App\Http\Controllers\DistributorDashboardController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\Admin\AuthenticationController;

Route::middleware("guest:distributor")->group(function () {
    Route::get('/register', [DistributorDashboardController::class, 'register']);
    Route::post('/register', [DistributorDashboardController::class, 'storeDistributor']);
    
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

Route::middleware("auth:distributor")->group(function () {
    Route::get('/distributor_packages', [DistributorDashboardController::class, 'fetchPackages']);
    Route::get('/distributor_packages/{slug}', [DistributorDashboardController::class, 'showPackage']);

    Route::post('/distributor_reviews', [DistributorReviewController::class, 'store']);
    Route::put('/distributor_reviews/{id}', [DistributorReviewController::class, 'update']);
    Route::delete('/distributor_reviews/{id}', [DistributorReviewController::class, 'destroy']);

    Route::get("/checkout", [DistributorDashboardController::class, "checkout"]);

    Route::get("/my_orders", [DistributorDashboardController::class, 'myOrders']);
    Route::post('/orders', [DistributorOrderController::class, 'store']);

    Route::get('/my_invoices', [DistributorDashboardController::class, "myInvoices"]);
    Route::get('/invoice/{ref}', [DistributorDashboardController::class, 'invoice']);
    Route::post('/make_payment', [DistributorDashboardController::class, 'makePayment']);
    Route::post('/capture/paypal', [DistributorDashboardController::class, 'capturePaypalPayment']);

    Route::post('/logout', [AuthenticationController::class, 'logout']);

    Route::middleware('distributorVerification')->group(function () {
        Route::get("/", [DistributorDashboardController::class, "index"]);
        Route::get('/orders', [DistributorDashboardController::class, "orders"]);
        Route::get('/users', [DistributorDashboardController::class, "users"]);

        Route::get('/products', [DistributorDashboardController::class, "products"]);

        Route::get('/discounts', [DistributorDashboardController::class, "discounts"]);
        Route::post('/discounts', [DistributorDashboardController::class, "storeDiscount"]);
    });
});


Broadcast::routes(['middleware' => ["auth:distributor"]]);
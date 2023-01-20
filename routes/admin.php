<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\ProductOptionController;
use App\Http\Controllers\ProductCategoryController;

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\DistributorOrderController;
use App\Http\Controllers\DistributorPackageController;
use App\Http\Controllers\DistributorDiscountController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\BinapointsConfigurationController;
use App\Http\Controllers\Auth\Admin\AuthenticationController;


Route::middleware('guest:admin')->group(function () {
            Route::post('/payouts', [PayoutController::class, "store"]);
            Route::get('/login', [AuthenticationController::class, 'create'])->name('login');
            Route::post('/login', [AuthenticationController::class, 'login']);
            Route::get('/forgot-password', [PasswordResetLinkController::class, 'create']);
            Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);

            Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

            Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
        });

        Route::middleware('auth:admin')->group(function () {
            Route::get('/', [AdminController::class, 'index']);

            Route::get('/product_categories', [ProductCategoryController::class, 'index'])->name('mgmt.product_categories.index');
            Route::post('/product_categories', [ProductCategoryController::class, 'store'])->name('mgmt.product_categories.store');
            Route::post('/product_categories/update/{id}', [ProductCategoryController::class, 'update'])->name('mgmt.product_categories.update');
            Route::delete('/product_categories/{id}', [ProductCategoryController::class, 'destroy'])->name('mgmt.product_categories.destroy');

            Route::get('/products', [ProductController::class, 'index'])->name('mgmt.products.index');
            Route::get('/products/search/{query}', [ProductController::class, 'search'])->name('mgmt.products.search');
            Route::get('/products/{id}', [ProductController::class, 'show'])->name('mgmt.products.show');
            Route::post('/products', [ProductController::class, 'store'])->name('mgmt.products.store');
            Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('mgmt.products.update');
            Route::delete('/products/{id}', [ProductController::class, 'destroy']);

            Route::post('/product_options', [ProductOptionController::class, 'store'])->name('mgmt.product_options.store');
            Route::put('/product_options/{id}', [ProductOptionController::class, 'update']);
            Route::delete('/product_options/{id}', [ProductOptionController::class, 'destroy']);

            Route::get('/discounts', [DiscountController::class, 'index'])->name('mgmt.discounts.index');
            Route::post('/discounts', [DiscountController::class, 'store'])->name('mgmt.discounts.store');
            Route::put('/discounts/{id}', [DiscountController::class, 'update']);
            Route::delete('/discounts/{id}', [DiscountController::class, 'destroy']);

            Route::get('/countries', [CountryController::class, 'index'])->name('mgmt.countries.index');
            Route::post('/countries', [CountryController::class, 'store'])->name('mgmt.countries.store');
            Route::put('/countries/{id}', [CountryController::class, 'update']);
            Route::delete('/countries/{id}', [CountryController::class, 'destroy']);

            Route::get('/configurations', [BinapointsConfigurationController::class, 'index'])->name('mgmt.config.index');
            Route::post('/configurations', [BinapointsConfigurationController::class, 'store'])->name('mgmt.config.store');
            Route::put('/configurations/{id}', [BinapointsConfigurationController::class, 'update'])->name('mgmt.config.update');
            Route::delete('/configurations/{id}', [BinapointsConfigurationController::class, 'destroy'])->name('mgmt.config.destroy');

            Route::get('/users', [UserController::class, 'index'])->name('mgmt.users.name');
            Route::get('/users/search/{query}', [UserController::class, 'search'])->name('mgmt.users.search');
            Route::post('/users', [UserController::class, 'store'])->name('mgmt.users.store');

            Route::get('/user_addresses/{query}', [UserAddressController::class, 'search'])->name('mgmt.user_address.search');
            Route::post('/user_addresses', [UserAddressController::class, 'store'])->name('mgmt.user_address.store');

            Route::get('/orders', [OrderController::class, 'index'])->name('mgmt.orders.index');
            Route::get('/orders/new', [OrderController::class, 'create'])->name('mgmt.orders.create');
            Route::post('/orders', [OrderController::class, 'store'])->name('mgmt.orders.store');

            Route::get('/distributors', [DistributorController::class, 'index'])->name('mgmt.distributors.index');
            Route::get('/distributors/ref/{ref}', [DistributorController::class, 'fetchDistributorIdByRef']);
            Route::get('/distributors/search/{query}', [DistributorController::class, 'search'])->name('mgmt.distributors.search');
            Route::post('/distributors', [DistributorController::class, 'store']);
            Route::post('/distributors/suspend', [DistributorController::class, 'suspend']);
            Route::post('/distributors/verify', [DistributorController::class, 'verify']);
            Route::delete('/distributors/{id}', [DistributorController::class, 'destroy']);

            Route::get('/distributor_packages', [DistributorPackageController::class, 'index'])->name('mgmt.distributor_packages.index');
            Route::get('/distributor_packages/{search}', [DistributorPackageController::class, 'search']);
            Route::post('/distributor_packages', [DistributorPackageController::class, 'store'])->name('mgmt.distributor_packages.store');
            Route::put('/distributor_packages/{id}', [DistributorPackageController::class, 'update']);
            Route::delete('/distributor_packages/{id}', [DistributorPackageController::class, 'destroy']);

            Route::get('/distributor_discounts', [DistributorDiscountController::class, 'index']);
            Route::post('/distributor_discounts', [DistributorDiscountController::class, "store"]);
            Route::put('/distributor_discounts/{id}', [DistributorDiscountController::class, "update"]);
            Route::delete("/distributor_discounts/{id}", [DistributorDiscountController::class, "destroy"]);

            Route::get('/distributor_orders', [DistributorOrderController::class, 'index']);


            Route::get('/blog_categories', [BlogCategoryController::class, 'index'])->name('mgmt.blog_categories.index');
            Route::post('/blog_categories', [BlogCategoryController::class, 'store'])->name('mgmt.blog_categories.store');
            Route::put('/blog_categories/{id}', [BlogCategoryController::class, 'update']);
            Route::delete('/blog_categories/{id}', [BlogCategoryController::class, 'destroy']);

            Route::get('/blogs', [BlogController::class, 'index'])->name('mgmt.blogs.index');
            Route::get('/blogs/create', [BlogController::class, 'create'])->name('mgmt.blogs.create');
            Route::get('/blogs/update/{id}', [BlogController::class, 'edit'])->name('mgmt.blogs.udpate.show');
            Route::post('/blogs', [BlogController::class, 'store'])->name('mgmt.blogs.store');
            Route::post('/blogs/update/{id}', [BlogController::class, 'update']);
            Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);

            Route::post('/logout', [AuthenticationController::class, 'logout']);
        });
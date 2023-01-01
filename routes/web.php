<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\ProductOptionController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\DistributorPackageController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BinapointsConfigurationController;
use App\Http\Controllers\Auth\Admin\AuthenticationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessSubscriberController;
use App\Http\Controllers\DistributorDashboardController;
use App\Http\Controllers\DistributorDiscountController;
use App\Http\Controllers\DistributorOrderController;
use App\Http\Controllers\DistributorReviewController;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\DistributorPackage;

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

$default_domain = env("APP_DOMAIN");

Route::group(array('domain' => '{subdomain}.' . Config::get('app.domain')), function () {
    $subdomain = explode('.', request()->getHost())[0];
    if ($subdomain === "management") {
        Route::get('/login', [AuthenticationController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticationController::class, 'login']);

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
        });
    } else if ($subdomain === "shop") {
        Route::get('/', [ShopController::class, 'index'])->name('shop.index');
        Route::get('/products', [ShopController::class, 'fetchProducts']);
        Route::get('/products/{slug}', [ShopController::class, 'show'])->name('shop.products.show');

        Route::get('/checkout', [ShopController::class, 'checkout']);
        Route::get('/invoice/{ref}', [ShopController::class, 'invoice']);
        Route::post('/make_payment', [ShopController::class, 'makePayment']);
        Route::post('/capture/paypal', [ShopController::class, 'capturePaypalPayment']);

        Route::post('/orders', [OrderController::class, 'store']);

        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('shop.login.create');
        Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('shop.login.store');

        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('shop.logout');

        Route::get('/register', [RegisteredUserController::class, 'create']);
        Route::post('/register', [ShopController::class, 'store']);
    } else if ($subdomain === "business") {
        //Business Site Routes
        Route::get('/', [BusinessController::class, 'index'])->name('business.index');
        Route::post('/subscribe', [BusinessSubscriberController::class, 'store'])->name('business.subscribe');
    } else if ($subdomain === "distributor") {
        Route::get('/register', [DistributorDashboardController::class, 'register']);
        Route::post('/register', [DistributorDashboardController::class, 'storeDistributor']);

        Route::get('/login', [AuthenticationController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticationController::class, 'login']);

        Route::middleware("auth:distributor")->group(function () {
            Route::get('/distributor_packages', [DistributorDashboardController::class, 'fetchPackages']);
            Route::get('/distributor_packages/{slug}', [DistributorDashboardController::class, 'showPackage']);

            Route::post('/distributor_reviews', [DistributorReviewController::class, 'store']);
            Route::put('/distributor_reviews/{id}', [DistributorReviewController::class, 'update']);
            Route::delete('/distributor_reviews/{id}', [DistributorReviewController::class, 'destroy']);

            Route::get("/checkout", [DistributorDashboardController::class, "checkout"]);

            Route::get("/orders", [DistributorDashboardController::class, 'orders']);
            Route::post('/orders', [DistributorOrderController::class, 'store']);

            Route::get('/invoice/{ref}', [DistributorDashboardController::class, 'invoice']);
            Route::post('/make_payment', [DistributorDashboardController::class, 'makePayment']);
            Route::post('/capture/paypal', [DistributorDashboardController::class, 'capturePaypalPayment']);
        });
    } else if ($subdomain === "dashboard") {
        Route::get('/login', [AuthenticationController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticationController::class, 'login']);
        Route::middleware('auth')->group(function () {
            Route::get('/orders', [UserController::class, 'orders'])->name('user.orders');
            Route::get('/orders/{ref}', [UserController::class, 'fetchOrderProducts']);
        });
    }
});
Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/how-it-works', [MainController::class, 'howItWorks'])->name('main.how_it_works');
Route::get('/faqs', [MainController::class, 'faqs'])->name('main.faqs');
Route::get('/blog', [MainController::class, 'blog'])->name('main.blogs');
Route::get('/blog/{slug}', [MainController::class, 'singlePost'])->name('main.blogs.show');
Route::get('/contact', [MainController::class, 'contact'])->name('main.contact');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('main.contact.store');
Route::post('/subscribe', [MainSubscriberController::class, 'store'])->name('main.subscriber.store');
// require __DIR__.'/auth.php';


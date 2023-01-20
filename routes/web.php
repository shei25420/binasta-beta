<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ContactMessageController;

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
        require __DIR__."/admin.php";
    } else if ($subdomain === "shop") {
        require __DIR__."/shop.php";
    } else if ($subdomain === "business") {
        require __DIR__."/business.php";
    } else if ($subdomain === "distributor") {
        require __DIR__."/distributor.php";
    } else if ($subdomain === "dashboard") {
        require __DIR__."/dashboard.php";   
    }
});

Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/how-it-works', [MainController::class, 'howItWorks'])->name('main.how_it_works');
Route::get('/faqs', [MainController::class, 'faqs'])->name('main.faqs');
Route::get('/blog', [MainController::class, 'blog'])->name('main.blogs');
Route::get('/blog/{slug}', [MainController::class, 'singlePost'])->name('main.blogs.show');
Route::get('/contact', [MainController::class, 'contact'])->name('main.contact');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('main.contact.store');
Route::get('/terms', [MainController::class, "terms"]);
// Route::post('/subscribe', [MainSubscriberController::class, 'store'])->name('main.subscriber.store');
// require __DIR__.'/auth.php';

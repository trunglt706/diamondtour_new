<?php

use App\Http\Controllers\Guest\AboutController;
use App\Http\Controllers\Guest\BlogController;
use App\Http\Controllers\Guest\ContactController;
use App\Http\Controllers\Guest\DestinationController;
use App\Http\Controllers\Guest\EventController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\LibraryController;
use App\Http\Controllers\Guest\TourController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('clear-cache', function () {
    Cache::flush();
    return redirect()->back()->with('success', 'Clear cache thành công');
})->name('clear_cache');
Route::middleware('SetLang')->prefix('demo')->group(function () {
    Route::prefix('')->controller(HomeController::class)->group(function () {
        Route::get('', 'index')->name('index');
        // Route::get('/lang/{lang}', 'changeLang')->name('lang.change');
        Route::get('load_companion', 'load_companion')->name('home.load_companion');
        Route::get('load_tours', 'load_tours')->name('home.load_tours');
        Route::get('load_faqs', 'load_faqs')->name('home.load_faqs');
        Route::get('load_posts', 'load_posts')->name('home.load_posts');
        Route::get('faq', 'faq')->name('faq');
        Route::get('design-tour', 'privte_schedule')->name('privte_schedule');
        Route::post('design-tour', 'privte_schedule_post')->name('privte_schedule_post');
        Route::get('tim-kiem', 'search')->name('search');
        Route::post('newllter', 'newllter')->name('newllter');
        Route::post('register_tour', 'register_tour')->name('register_tour');
        Route::post('register_promo', 'register_promo')->name('register_promo');
    });
    Route::get('about', [AboutController::class, 'index'])->name('about');
    Route::prefix('library')->name('library.')->controller(LibraryController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{alias}', 'detail')->name('detail');
    });
    Route::prefix('blog')->name('blog.')->controller(BlogController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{alias}', 'detail')->name('detail');
        Route::get('category/{alias}', 'cat_blog')->name('cat_blog');
    });
    Route::prefix('destination')->name('destination.')->controller(DestinationController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{alias}', 'detail')->name('detail');
        Route::get('category/{alias}', 'cat_destinations')->name('cat_destinations');
    });
    Route::prefix('tour')->name('tour.')->controller(TourController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('calendar', 'calendar')->name('calendar');
        Route::get('{alias}', 'detail')->name('detail');
        Route::get('category/{alias}', 'cat_tours')->name('cat_tours');
    });
    Route::prefix('contact')->name('contact.')->controller(ContactController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('create', 'create')->name('create');
    });
    Route::get('event/{slug}', [EventController::class, 'detail'])->name('event.detail');
});

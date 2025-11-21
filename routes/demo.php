<?php

use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Demo\AboutController;
use App\Http\Controllers\Demo\AlbumController;
use App\Http\Controllers\Demo\BlogController;
use App\Http\Controllers\Demo\ContactController;
use App\Http\Controllers\Demo\DestinationController;
use App\Http\Controllers\Demo\EventController;
use App\Http\Controllers\Demo\HomeController;
use App\Http\Controllers\Demo\ServiceController;
use App\Http\Controllers\Demo\TourController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
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

Route::middleware('SetLang')->prefix('')->name('demo.')->group(function () {
    Route::get('/lang/{lang}', [GuestHomeController::class, 'changeLang'])->name('lang.change');
    Route::prefix('')->controller(HomeController::class)->group(function () {
        Route::get('', 'index')->name('home');
        Route::get('faq', 'faq')->name('faq');
        Route::get('search', 'search')->name('search');
        Route::get('load_seasonal_tours', 'load_seasonal_tours')->name('load_seasonal_tours');

        Route::get('design-tour', 'privte_schedule')->name('privte_schedule');
        Route::post('design-tour', 'privte_schedule_post')->name('privte_schedule_post');
    });
    Route::get('gioi-thieu', [AboutController::class, 'index'])->name('about');
    Route::prefix('thu-vien')->name('library.')->controller(AlbumController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('category/{slug}', 'category')->name('category');
        Route::get('{slug}', 'detail')->name('detail');
    });
    Route::prefix('cam-nang-du-lich')->name('blog.')->controller(BlogController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('category/{slug}', 'category')->name('category');
        Route::get('{slug}', 'detail')->name('detail');
    });
    Route::prefix('diem-den')->name('destination.')->controller(DestinationController::class)->group(function () {
        Route::get('{slug}', 'detail')->name('detail');
    });
    Route::get('blogs', [BlogController::class, 'blogs'])->name('blogs');
    Route::prefix('dich-vu')->name('service.')->controller(ServiceController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('category/{slug}', 'category')->name('category');
        Route::get('{slug}', 'detail')->name('detail');
    });
    Route::get('thanh-toan', [ServiceController::class, 'payment'])->name('payment');
    Route::prefix('tour')->name('tour.')->controller(TourController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('category/{slug}', 'category')->name('category');
        Route::get('{slug}', 'detail')->name('detail');
    });
    Route::prefix('landtour')->name('landtour.')->controller(TourController::class)->group(function () {
        Route::get('', 'landtours')->name('index');
    });
    Route::prefix('lien-he')->name('contact.')->controller(ContactController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('create', 'create')->name('create');
    });
    Route::get('su-kien/{slug}', [EventController::class, 'detail'])->name('event.detail');
});

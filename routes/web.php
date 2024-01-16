<?php

use App\Http\Controllers\Guest\AboutController;
use App\Http\Controllers\Guest\BlogController;
use App\Http\Controllers\Guest\DestinationController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\LibraryController;
use App\Http\Controllers\Guest\TourController;
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

Route::prefix('')->controller(HomeController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('faq', 'faq')->name('faq');
});
Route::get('about', [AboutController::class, 'index'])->name('about');
Route::prefix('library')->name('library.')->controller(LibraryController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('{alias}', 'detail')->name('detail');
});
Route::prefix('blog')->name('blog.')->controller(BlogController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('{alias}', 'detail')->name('detail');
});
Route::prefix('destination')->name('destination.')->controller(DestinationController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('{alias}', 'detail')->name('detail');
});
Route::prefix('tour')->name('tour.')->controller(TourController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('{alias}', 'detail')->name('detail');
});

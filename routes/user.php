<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DestinationGroupController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LibraryGroupController;
use App\Http\Controllers\LogActionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourDesignController;
use App\Http\Controllers\TourGroupController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//========== authen
Route::prefix('login')->name('login.')->group(function () {
    Route::get('', [AuthController::class, 'login'])->name('index');
    Route::post('', [AuthController::class, 'postLogin'])->name('post');
});

//========== user
Route::prefix(USER_PREFIX_ROUTE)->name('user.')->middleware(['checkUser'])->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('index');
    Route::get('logout', [HomeController::class, 'logout'])->name('logout');
    Route::post('select2', [HomeController::class, 'get_data_select2'])->name('get_data_select2');
    Route::get('doupload', [HomeController::class, 'upload_editor'])->name('upload_editor');

    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('', [BlogController::class, 'index'])->name('index');
        Route::get('list', [BlogController::class, 'list'])->name('list');
        Route::get('{id}', [BlogController::class, 'detail'])->name('detail');
        Route::post('insert', [BlogController::class, 'insert'])->name('insert');
        Route::post('update', [BlogController::class, 'update'])->name('update');
        Route::post('delete', [BlogController::class, 'update'])->name('delete');
    });

    Route::prefix('blog_group')->name('blog_group.')->group(function () {
        Route::get('', [BlogCategoryController::class, 'index'])->name('index');
        Route::get('list', [BlogCategoryController::class, 'list'])->name('list');
        Route::get('{id}', [BlogCategoryController::class, 'detail'])->name('detail');
        Route::post('insert', [BlogCategoryController::class, 'insert'])->name('insert');
        Route::post('update', [BlogCategoryController::class, 'update'])->name('update');
        Route::post('delete', [BlogCategoryController::class, 'update'])->name('delete');
    });

    Route::prefix('booking')->name('booking.')->group(function () {
        Route::get('', [BookingController::class, 'index'])->name('index');
        Route::get('list', [BookingController::class, 'list'])->name('list');
        Route::get('{id}', [BookingController::class, 'detail'])->name('detail');
        Route::post('insert', [BookingController::class, 'insert'])->name('insert');
        Route::post('update', [BookingController::class, 'update'])->name('update');
        Route::post('delete', [BookingController::class, 'update'])->name('delete');
    });

    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('', [ContactController::class, 'index'])->name('index');
        Route::get('list', [ContactController::class, 'list'])->name('list');
        Route::get('{id}', [ContactController::class, 'detail'])->name('detail');
        Route::post('insert', [ContactController::class, 'insert'])->name('insert');
        Route::post('update', [ContactController::class, 'update'])->name('update');
        Route::post('delete', [ContactController::class, 'update'])->name('delete');
    });

    Route::prefix('destination')->name('destination.')->group(function () {
        Route::get('', [DestinationController::class, 'index'])->name('index');
        Route::get('list', [DestinationController::class, 'list'])->name('list');
        Route::get('{id}', [DestinationController::class, 'detail'])->name('detail');
        Route::post('insert', [DestinationController::class, 'insert'])->name('insert');
        Route::post('update', [DestinationController::class, 'update'])->name('update');
        Route::post('delete', [DestinationController::class, 'update'])->name('delete');
    });

    Route::prefix('destination_group')->name('destination_group.')->group(function () {
        Route::get('', [DestinationGroupController::class, 'index'])->name('index');
        Route::get('list', [DestinationGroupController::class, 'list'])->name('list');
        Route::get('{id}', [DestinationGroupController::class, 'detail'])->name('detail');
        Route::post('insert', [DestinationGroupController::class, 'insert'])->name('insert');
        Route::post('update', [DestinationGroupController::class, 'update'])->name('update');
        Route::post('delete', [DestinationGroupController::class, 'update'])->name('delete');
    });

    Route::prefix('qa')->name('qa.')->group(function () {
        Route::get('', [FAQController::class, 'index'])->name('index');
        Route::get('list', [FAQController::class, 'list'])->name('list');
        Route::get('{id}', [FAQController::class, 'detail'])->name('detail');
        Route::post('insert', [FAQController::class, 'insert'])->name('insert');
        Route::post('update', [FAQController::class, 'update'])->name('update');
        Route::post('delete', [FAQController::class, 'update'])->name('delete');
    });

    Route::prefix('library')->name('library.')->group(function () {
        Route::get('', [LibraryController::class, 'index'])->name('index');
        Route::get('list', [LibraryController::class, 'list'])->name('list');
        Route::get('{id}', [LibraryController::class, 'detail'])->name('detail');
        Route::post('insert', [LibraryController::class, 'insert'])->name('insert');
        Route::post('update', [LibraryController::class, 'update'])->name('update');
        Route::post('delete', [LibraryController::class, 'update'])->name('delete');
    });

    Route::prefix('library_group')->name('library_group.')->group(function () {
        Route::get('', [LibraryGroupController::class, 'index'])->name('index');
        Route::get('list', [LibraryGroupController::class, 'list'])->name('list');
        Route::get('{id}', [LibraryGroupController::class, 'detail'])->name('detail');
        Route::post('insert', [LibraryGroupController::class, 'insert'])->name('insert');
        Route::post('update', [LibraryGroupController::class, 'update'])->name('update');
        Route::post('delete', [LibraryGroupController::class, 'update'])->name('delete');
    });

    Route::prefix('log_action')->name('log_action.')->group(function () {
        Route::get('', [LogActionController::class, 'index'])->name('index');
        Route::get('list', [LogActionController::class, 'list'])->name('list');
        Route::get('{id}', [LogActionController::class, 'detail'])->name('detail');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('index');
        Route::post('', [ProfileController::class, 'update_account'])->name('update_account');
    });

    Route::prefix('schedule')->name('schedule.')->group(function () {
        Route::get('', [ScheduleController::class, 'index'])->name('index');
        Route::get('list', [ScheduleController::class, 'list'])->name('list');
        Route::get('{id}', [ScheduleController::class, 'detail'])->name('detail');
        Route::post('insert', [ScheduleController::class, 'insert'])->name('insert');
        Route::post('update', [ScheduleController::class, 'update'])->name('update');
        Route::post('delete', [ScheduleController::class, 'update'])->name('delete');
    });

    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('', [SettingController::class, 'index'])->name('index');
        Route::post('update', [SettingController::class, 'update'])->name('update');
    });

    Route::prefix('social')->name('social.')->group(function () {
        Route::get('', [SocialController::class, 'index'])->name('index');
        Route::get('list', [SocialController::class, 'list'])->name('list');
        Route::get('{id}', [SocialController::class, 'detail'])->name('detail');
        Route::post('insert', [SocialController::class, 'insert'])->name('insert');
        Route::post('update', [SocialController::class, 'update'])->name('update');
        Route::post('delete', [SocialController::class, 'update'])->name('delete');
    });

    Route::prefix('tour')->name('tour.')->group(function () {
        Route::get('', [TourController::class, 'index'])->name('index');
        Route::get('list', [TourController::class, 'list'])->name('list');
        Route::get('{id}', [TourController::class, 'detail'])->name('detail');
        Route::post('insert', [TourController::class, 'insert'])->name('insert');
        Route::post('update', [TourController::class, 'update'])->name('update');
        Route::post('delete', [TourController::class, 'update'])->name('delete');
    });

    Route::prefix('tour_group')->name('tour_group.')->group(function () {
        Route::get('', [TourGroupController::class, 'index'])->name('index');
        Route::get('list', [TourGroupController::class, 'list'])->name('list');
        Route::get('{id}', [TourGroupController::class, 'detail'])->name('detail');
        Route::post('insert', [TourGroupController::class, 'insert'])->name('insert');
        Route::post('update', [TourGroupController::class, 'update'])->name('update');
        Route::post('delete', [TourGroupController::class, 'update'])->name('delete');
    });

    Route::prefix('tour_design')->name('tour_design.')->group(function () {
        Route::get('', [TourDesignController::class, 'index'])->name('index');
        Route::get('list', [TourDesignController::class, 'list'])->name('list');
        Route::get('{id}', [TourDesignController::class, 'detail'])->name('detail');
        Route::post('update', [TourDesignController::class, 'update'])->name('update');
        Route::post('delete', [TourDesignController::class, 'update'])->name('delete');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('list', [UserController::class, 'list'])->name('list');
        Route::get('{id}', [UserController::class, 'detail'])->name('detail');
        Route::post('insert', [UserController::class, 'insert'])->name('insert');
        Route::post('update', [UserController::class, 'update'])->name('update');
        Route::post('update_account', [UserController::class, 'update_account'])->name('update_account');
        Route::post('delete', [UserController::class, 'update'])->name('delete');
    });
});

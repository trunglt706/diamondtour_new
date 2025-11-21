<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DestinationGroupController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventSubmissionController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LibraryGroupController;
use App\Http\Controllers\LogActionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NewllterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\QaGroupController;
use App\Http\Controllers\RegisterPromoController;
use App\Http\Controllers\RegisterTourController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScheduleDetailController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\TourAgeController;
use App\Http\Controllers\TourBalanaceController;
use App\Http\Controllers\TourCalendarController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourDesignController;
use App\Http\Controllers\TourGroupController;
use App\Http\Controllers\TourLibraryController;
use App\Http\Controllers\TourObjectController;
use App\Http\Controllers\TourServiceController;
use App\Http\Controllers\TourStyleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
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
    Route::post('delete_image', [HomeController::class, 'delete_image'])->name('delete_image');

    Route::post('ajax/log_action', [HomeController::class, 'load_log_action'])->name('home.log_action');
    Route::post('ajax/contact', [HomeController::class, 'load_contact'])->name('home.contact');
    Route::post('ajax/register_promo', [HomeController::class, 'load_register_promo'])->name('home.register_promo');
    Route::post('ajax/register_tour', [HomeController::class, 'load_register_tour'])->name('home.register_tour');

    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('', [BlogController::class, 'index'])->name('index');
        Route::get('list', [BlogController::class, 'list'])->name('list');
        Route::get('create', [BlogController::class, 'create'])->name('create');
        Route::get('{id}', [BlogController::class, 'detail'])->name('detail');
        Route::get('edit/{id}', [BlogController::class, 'edit'])->name('edit');
        Route::post('insert', [BlogController::class, 'insert'])->name('insert');
        Route::post('update', [BlogController::class, 'update'])->name('update');
        Route::post('updateAlbum', [BlogController::class, 'updateAlbum'])->name('updateAlbum');
        Route::post('delete', [BlogController::class, 'delete'])->name('delete');
    });

    Route::prefix('event')->name('event.')->group(function () {
        Route::get('', [EventController::class, 'index'])->name('index');
        Route::get('list', [EventController::class, 'list'])->name('list');
        Route::get('create', [EventController::class, 'create'])->name('create');
        Route::get('{id}', [EventController::class, 'detail'])->name('detail');
        Route::get('edit/{id}', [EventController::class, 'edit'])->name('edit');
        Route::post('insert', [EventController::class, 'insert'])->name('insert');
        Route::post('update', [EventController::class, 'update'])->name('update');
        Route::post('delete', [EventController::class, 'delete'])->name('delete');
    });

    Route::prefix('event-submission')->name('event_submission.')->group(function () {
        Route::get('', [EventSubmissionController::class, 'index'])->name('index');
        Route::get('list', [EventSubmissionController::class, 'list'])->name('list');
        Route::get('create', [EventSubmissionController::class, 'create'])->name('create');
        Route::get('{id}', [EventSubmissionController::class, 'detail'])->name('detail');
        Route::get('edit/{id}', [EventSubmissionController::class, 'edit'])->name('edit');
        Route::post('insert', [EventSubmissionController::class, 'insert'])->name('insert');
        Route::post('update', [EventSubmissionController::class, 'update'])->name('update');
        Route::post('delete', [EventSubmissionController::class, 'delete'])->name('delete');
    });

    Route::prefix('blog_group')->name('blog_group.')->group(function () {
        Route::get('', [BlogCategoryController::class, 'index'])->name('index');
        Route::get('list', [BlogCategoryController::class, 'list'])->name('list');
        Route::get('{id}', [BlogCategoryController::class, 'detail'])->name('detail');
        Route::post('insert', [BlogCategoryController::class, 'insert'])->name('insert');
        Route::post('update', [BlogCategoryController::class, 'update'])->name('update');
        Route::post('delete', [BlogCategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('booking')->name('booking.')->group(function () {
        Route::get('', [BookingController::class, 'index'])->name('index');
        Route::get('list', [BookingController::class, 'list'])->name('list');
        Route::get('{id}', [BookingController::class, 'detail'])->name('detail');
        Route::post('insert', [BookingController::class, 'insert'])->name('insert');
        Route::post('update', [BookingController::class, 'update'])->name('update');
        Route::post('delete', [BookingController::class, 'delete'])->name('delete');
    });

    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('', [ContactController::class, 'index'])->name('index');
        Route::get('list', [ContactController::class, 'list'])->name('list');
        Route::get('accept', [ContactController::class, 'accept'])->name('accept');
        Route::get('{id}', [ContactController::class, 'detail'])->name('detail');
        Route::post('insert', [ContactController::class, 'insert'])->name('insert');
        Route::post('update', [ContactController::class, 'update'])->name('update');
        Route::post('delete', [ContactController::class, 'delete'])->name('delete');
    });

    Route::prefix('destination')->name('destination.')->group(function () {
        Route::get('', [DestinationController::class, 'index'])->name('index');
        Route::get('list', [DestinationController::class, 'list'])->name('list');
        Route::get('create', [DestinationController::class, 'create'])->name('create');
        Route::get('{id}', [DestinationController::class, 'detail'])->name('detail');
        Route::get('edit/{id}', [DestinationController::class, 'edit'])->name('edit');
        Route::post('insert', [DestinationController::class, 'insert'])->name('insert');
        Route::post('update', [DestinationController::class, 'update'])->name('update');
        Route::post('updateAlbum', [DestinationController::class, 'updateAlbum'])->name('updateAlbum');
        Route::post('delete', [DestinationController::class, 'delete'])->name('delete');
    });

    Route::prefix('destination_group')->name('destination_group.')->group(function () {
        Route::get('', [DestinationGroupController::class, 'index'])->name('index');
        Route::get('list', [DestinationGroupController::class, 'list'])->name('list');
        Route::get('{id}', [DestinationGroupController::class, 'detail'])->name('detail');
        Route::post('insert', [DestinationGroupController::class, 'insert'])->name('insert');
        Route::post('update', [DestinationGroupController::class, 'update'])->name('update');
        Route::post('delete', [DestinationGroupController::class, 'delete'])->name('delete');
    });

    Route::prefix('qa')->name('qa.')->group(function () {
        Route::get('', [FAQController::class, 'index'])->name('index');
        Route::get('list', [FAQController::class, 'list'])->name('list');
        Route::get('{id}', [FAQController::class, 'detail'])->name('detail');
        Route::post('insert', [FAQController::class, 'insert'])->name('insert');
        Route::post('update', [FAQController::class, 'update'])->name('update');
        Route::post('delete', [FAQController::class, 'delete'])->name('delete');
    });

    Route::prefix('qa_group')->name('qa_group.')->group(function () {
        Route::get('', [QaGroupController::class, 'index'])->name('index');
        Route::get('list', [QaGroupController::class, 'list'])->name('list');
        Route::get('{id}', [QaGroupController::class, 'detail'])->name('detail');
        Route::post('insert', [QaGroupController::class, 'insert'])->name('insert');
        Route::post('update', [QaGroupController::class, 'update'])->name('update');
        Route::post('delete', [QaGroupController::class, 'delete'])->name('delete');
    });

    Route::prefix('library')->name('library.')->group(function () {
        Route::get('', [LibraryController::class, 'index'])->name('index');
        Route::get('list', [LibraryController::class, 'list'])->name('list');
        Route::get('{id}', [LibraryController::class, 'detail'])->name('detail');
        Route::post('insert', [LibraryController::class, 'insert'])->name('insert');
        Route::post('update', [LibraryController::class, 'update'])->name('update');
        Route::post('delete', [LibraryController::class, 'delete'])->name('delete');
    });

    Route::prefix('library_group')->name('library_group.')->group(function () {
        Route::get('', [LibraryGroupController::class, 'index'])->name('index');
        Route::get('list', [LibraryGroupController::class, 'list'])->name('list');
        Route::get('{id}', [LibraryGroupController::class, 'detail'])->name('detail');
        Route::post('insert', [LibraryGroupController::class, 'insert'])->name('insert');
        Route::post('update', [LibraryGroupController::class, 'update'])->name('update');
        Route::post('delete', [LibraryGroupController::class, 'delete'])->name('delete');
    });

    Route::prefix('video')->name('video.')->group(function () {
        Route::get('', [VideoController::class, 'index'])->name('index');
        Route::get('list', [VideoController::class, 'list'])->name('list');
        Route::get('{id}', [VideoController::class, 'detail'])->name('detail');
        Route::post('update', [VideoController::class, 'update'])->name('update');
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
        Route::post('delete', [ScheduleController::class, 'delete'])->name('delete');
    });

    Route::prefix('schedule_detail')->name('schedule_detail.')->group(function () {
        Route::get('list', [ScheduleDetailController::class, 'list'])->name('list');
        Route::get('{id}', [ScheduleDetailController::class, 'detail'])->name('detail');
        Route::post('insert', [ScheduleDetailController::class, 'insert'])->name('insert');
        Route::post('update', [ScheduleDetailController::class, 'update'])->name('update');
        Route::post('delete', [ScheduleDetailController::class, 'delete'])->name('delete');
    });

    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('', [SettingController::class, 'index'])->name('index');
        Route::post('update', [SettingController::class, 'update'])->name('update');
        Route::post('swapImage', [SettingController::class, 'swapImage'])->name('swapImage');
    });

    Route::prefix('social')->name('social.')->group(function () {
        Route::get('', [SocialController::class, 'index'])->name('index');
        Route::get('list', [SocialController::class, 'list'])->name('list');
        Route::get('{id}', [SocialController::class, 'detail'])->name('detail');
        Route::post('insert', [SocialController::class, 'insert'])->name('insert');
        Route::post('update', [SocialController::class, 'update'])->name('update');
        Route::post('delete', [SocialController::class, 'delete'])->name('delete');
    });

    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('', [MenuController::class, 'index'])->name('index');
        Route::get('list', [MenuController::class, 'list'])->name('list');
        Route::get('{id}', [MenuController::class, 'detail'])->name('detail');
        Route::post('insert', [MenuController::class, 'insert'])->name('insert');
        Route::post('update', [MenuController::class, 'update'])->name('update');
    });

    Route::prefix('service')->name('service.')->group(function () {
        Route::get('', [ServiceController::class, 'index'])->name('index');
        Route::get('list', [ServiceController::class, 'list'])->name('list');
        Route::get('{id}', [ServiceController::class, 'detail'])->name('detail');
        Route::post('insert', [ServiceController::class, 'insert'])->name('insert');
        Route::post('update', [ServiceController::class, 'update'])->name('update');
        Route::post('delete', [ServiceController::class, 'delete'])->name('delete');
    });

    Route::prefix('tour')->name('tour.')->group(function () {
        Route::get('', [TourController::class, 'index'])->name('index');
        Route::get('list', [TourController::class, 'list'])->name('list');
        Route::get('create', [TourController::class, 'create'])->name('create');
        Route::get('{id}', [TourController::class, 'detail'])->name('detail');
        Route::get('edit/{id}', [TourController::class, 'edit'])->name('edit');
        Route::post('insert', [TourController::class, 'insert'])->name('insert');
        Route::post('update', [TourController::class, 'update'])->name('update');
        Route::post('delete', [TourController::class, 'delete'])->name('delete');
    });

    Route::prefix('tour_group')->name('tour_group.')->group(function () {
        Route::get('', [TourGroupController::class, 'index'])->name('index');
        Route::get('list', [TourGroupController::class, 'list'])->name('list');
        Route::get('{id}', [TourGroupController::class, 'detail'])->name('detail');
        Route::post('insert', [TourGroupController::class, 'insert'])->name('insert');
        Route::post('update', [TourGroupController::class, 'update'])->name('update');
        Route::post('delete', [TourGroupController::class, 'delete'])->name('delete');
    });

    Route::prefix('tour_design')->name('tour_design.')->group(function () {
        Route::get('', [TourDesignController::class, 'index'])->name('index');
        Route::get('list', [TourDesignController::class, 'list'])->name('list');
        Route::get('{id}', [TourDesignController::class, 'detail'])->name('detail');
        Route::post('update', [TourDesignController::class, 'update'])->name('update');
        Route::post('delete', [TourDesignController::class, 'delete'])->name('delete');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('list', [UserController::class, 'list'])->name('list');
        Route::get('updateStatus', [UserController::class, 'updateStatus'])->name('updateStatus');
        Route::get('{id}', [UserController::class, 'detail'])->name('detail');
        Route::post('insert', [UserController::class, 'insert'])->name('insert');
        Route::post('update', [UserController::class, 'update'])->name('update');
        Route::post('update_account', [UserController::class, 'update_account'])->name('update_account');
        Route::post('delete', [UserController::class, 'delete'])->name('delete');
    });

    Route::prefix('tour_object')->name('tour_object.')->group(function () {
        Route::get('', [TourObjectController::class, 'index'])->name('index');
        Route::get('list', [TourObjectController::class, 'list'])->name('list');
        Route::get('{id}', [TourObjectController::class, 'detail'])->name('detail');
        Route::post('insert', [TourObjectController::class, 'insert'])->name('insert');
        Route::post('update', [TourObjectController::class, 'update'])->name('update');
        Route::post('delete', [TourObjectController::class, 'delete'])->name('delete');
    });

    Route::prefix('tour_balance')->name('tour_balance.')->group(function () {
        Route::get('', [TourBalanaceController::class, 'index'])->name('index');
        Route::get('list', [TourBalanaceController::class, 'list'])->name('list');
        Route::get('{id}', [TourBalanaceController::class, 'detail'])->name('detail');
        Route::post('insert', [TourBalanaceController::class, 'insert'])->name('insert');
        Route::post('update', [TourBalanaceController::class, 'update'])->name('update');
        Route::post('delete', [TourBalanaceController::class, 'delete'])->name('delete');
    });

    Route::prefix('tour_age')->name('tour_age.')->group(function () {
        Route::get('', [TourAgeController::class, 'index'])->name('index');
        Route::get('list', [TourAgeController::class, 'list'])->name('list');
        Route::get('{id}', [TourAgeController::class, 'detail'])->name('detail');
        Route::post('insert', [TourAgeController::class, 'insert'])->name('insert');
        Route::post('update', [TourAgeController::class, 'update'])->name('update');
        Route::post('delete', [TourAgeController::class, 'delete'])->name('delete');
    });

    Route::prefix('tour_service')->name('tour_service.')->group(function () {
        Route::get('', [TourServiceController::class, 'index'])->name('index');
        Route::get('list', [TourServiceController::class, 'list'])->name('list');
        Route::get('{id}', [TourServiceController::class, 'detail'])->name('detail');
        Route::post('insert', [TourServiceController::class, 'insert'])->name('insert');
        Route::post('update', [TourServiceController::class, 'update'])->name('update');
        Route::post('delete', [TourServiceController::class, 'delete'])->name('delete');
    });

    Route::prefix('tour_style')->name('tour_style.')->group(function () {
        Route::get('', [TourStyleController::class, 'index'])->name('index');
        Route::get('list', [TourStyleController::class, 'list'])->name('list');
        Route::get('{id}', [TourStyleController::class, 'detail'])->name('detail');
        Route::post('insert', [TourStyleController::class, 'insert'])->name('insert');
        Route::post('update', [TourStyleController::class, 'update'])->name('update');
        Route::post('delete', [TourStyleController::class, 'delete'])->name('delete');
    });

    Route::prefix('tour_library')->name('tour_library.')->group(function () {
        Route::get('', [TourLibraryController::class, 'index'])->name('index');
        Route::get('list', [TourLibraryController::class, 'list'])->name('list');
        Route::get('{id}', [TourLibraryController::class, 'detail'])->name('detail');
        Route::post('insert', [TourLibraryController::class, 'insert'])->name('insert');
        Route::post('update', [TourLibraryController::class, 'update'])->name('update');
        Route::post('delete', [TourLibraryController::class, 'delete'])->name('delete');
    });

    Route::prefix('tour_calendar')->name('tour_calendar.')->group(function () {
        Route::get('', [TourCalendarController::class, 'index'])->name('index');
        Route::get('list', [TourCalendarController::class, 'list'])->name('list');
        Route::get('{id}', [TourCalendarController::class, 'detail'])->name('detail');
        Route::post('insert', [TourCalendarController::class, 'insert'])->name('insert');
        Route::post('update', [TourCalendarController::class, 'update'])->name('update');
        Route::post('delete', [TourCalendarController::class, 'delete'])->name('delete');
    });

    Route::prefix('newllter')->name('newllter.')->group(function () {
        Route::get('', [NewllterController::class, 'index'])->name('index');
        Route::get('list', [NewllterController::class, 'list'])->name('list');
        Route::get('accept', [NewllterController::class, 'accept'])->name('accept');
        Route::get('{id}', [NewllterController::class, 'detail'])->name('detail');
        Route::post('delete', [NewllterController::class, 'delete'])->name('delete');
    });

    Route::prefix('register_tour')->name('register_tour.')->group(function () {
        Route::get('', [RegisterTourController::class, 'index'])->name('index');
        Route::get('list', [RegisterTourController::class, 'list'])->name('list');
        Route::get('accept', [RegisterTourController::class, 'accept'])->name('accept');
        Route::get('{id}', [RegisterTourController::class, 'detail'])->name('detail');
        Route::post('delete', [RegisterTourController::class, 'delete'])->name('delete');
    });

    Route::prefix('register_promo')->name('register_promo.')->group(function () {
        Route::get('', [RegisterPromoController::class, 'index'])->name('index');
        Route::get('list', [RegisterPromoController::class, 'list'])->name('list');
        Route::get('accept', [RegisterPromoController::class, 'accept'])->name('accept');
        Route::get('{id}', [RegisterPromoController::class, 'detail'])->name('detail');
        Route::post('delete', [RegisterPromoController::class, 'delete'])->name('delete');
    });

    Route::prefix('country')->name('country.')->group(function () {
        Route::get('', [CountryController::class, 'index'])->name('index');
        Route::get('list', [CountryController::class, 'list'])->name('list');
        Route::get('{id}', [CountryController::class, 'detail'])->name('detail');
        Route::post('insert', [CountryController::class, 'insert'])->name('insert');
        Route::post('update', [CountryController::class, 'update'])->name('update');
        Route::post('delete', [CountryController::class, 'delete'])->name('delete');
    });

    Route::prefix('province')->name('province.')->group(function () {
        Route::get('', [ProvinceController::class, 'index'])->name('index');
        Route::get('list', [ProvinceController::class, 'list'])->name('list');
        Route::get('{id}', [ProvinceController::class, 'detail'])->name('detail');
        Route::post('insert', [ProvinceController::class, 'insert'])->name('insert');
        Route::post('update', [ProvinceController::class, 'update'])->name('update');
        Route::post('delete', [ProvinceController::class, 'delete'])->name('delete');
    });

    Route::prefix('review')->name('review.')->group(function () {
        Route::get('', [ReviewController::class, 'index'])->name('index');
        Route::get('list', [ReviewController::class, 'list'])->name('list');
        Route::get('{id}', [ReviewController::class, 'detail'])->name('detail');
        Route::post('insert', [ReviewController::class, 'insert'])->name('insert');
        Route::post('update', [ReviewController::class, 'update'])->name('update');
        Route::post('delete', [ReviewController::class, 'delete'])->name('delete');
    });
});

<?php

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

Route::get('/', function () {
    return view('pages.main');
});
Route::get('/ve-chung-toi', function () {
    return view('pages.about-us');
});
Route::get('/thu-vien-anh', function () {
    return view('pages.gallery');
});
Route::get('/thu-vien-anh/{alias}', function () {
    return view('pages.single-gallery');
});
Route::get('/blog', function () {
    return view('pages.posts');
});

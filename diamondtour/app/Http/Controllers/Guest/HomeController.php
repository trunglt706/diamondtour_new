<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.main');
    }

    public function faq()
    {
        return view('pages.faq');
    }
}

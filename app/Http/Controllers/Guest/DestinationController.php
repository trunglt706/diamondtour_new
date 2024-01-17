<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class DestinationController extends Controller
{

    public function index()
    {
        return view('pages.destination');
    }

    public function detail($alias)
    {
        // return view('pages.destination');
    }
}

<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibraryController extends Controller
{

    public function index()
    {
        return view('pages.gallery');
    }

    public function detail($alias)
    {
        return view('pages.single-gallery');
    }
}

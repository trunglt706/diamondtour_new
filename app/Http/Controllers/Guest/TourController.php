<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class TourController extends Controller
{

    public function index()
    {
      return view('pages.tour');
    }

    public function cat_tours($cat_alias)
    {
      return view('pages.cat-tour');
    }

    public function detail($alias)
    {
      return view('pages.single-tour');
    }
}

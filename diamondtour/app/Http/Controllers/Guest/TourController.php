<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class TourController extends Controller
{

    public function index()
    {
      return view('pages.tour');
    }

    public function details($alias)
    {
      
    }
}

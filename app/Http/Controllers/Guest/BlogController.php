<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{

    public function index()
    {
        return view('pages.posts');
    }

    public function cat_blog($cat_alias)
    {
      return view('pages.cat-post');
    }

    public function detail($alias)
    {
        return view('pages.single-post');
    }
}

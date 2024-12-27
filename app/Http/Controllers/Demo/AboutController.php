<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class AboutController extends Controller
{
    /**
     * Trang giới thiệu
     */
    public function index()
    {
        if (Cache::has('demo_about')) {
            $data = Cache::get('demo_about');
        } else {
            $data = Cache::remember('demo_about', CACHE_TIME, function () {
                $menu = Menu::ofCode('about')->select('background', 'name', 'description', 'name_en', 'name_ch', 'description_en', 'description_ch')->first();
                return [
                    'menu' => $menu,
                    'about_images' => get_image_from_codes('about-images'),
                    'content' => get_option('about-content'),
                ];
            });
        }
        return view('guest.about.index', compact('data'));
    }
}

<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\TourGroup;
use Illuminate\Support\Facades\Cache;

class AboutController extends Controller
{

    public function index()
    {
        $key = CACHE_ABOUT . '-index';
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () {
                $menu = Menu::ofCode('about')->first();
                // tour_groups
                $tour_groups = TourGroup::ofStatus(TourGroup::STATUS_ACTIVE)
                    ->orderBy('numering', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'slug', 'name', 'name_en', 'name_ch', 'description')->limit(6)->get();

                $seo = [
                    'image' => $menu->background,
                    'title' => $menu->name,
                    'description' => $menu->description,
                ];
                return [
                    'menu' => $menu,
                    'tour_groups' => $tour_groups,
                    'seo' => $seo
                ];
            });
        }
        return view('pages.about-us', compact('data'));
    }
}

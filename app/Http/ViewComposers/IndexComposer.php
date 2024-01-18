<?php

namespace App\Http\ViewComposers;

use App\Models\Menu;
use App\Models\Setting;
use App\Models\Social;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class IndexComposer
{
    /**
     * The system repository implementation.
     *
     */

    /**
     * Create a new profile composer.
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * 
     * @param View $view
     */
    public function compose(View $view)
    {
        //=========== menu
        if (Cache::has(CACHE_MENU)) {
            $menus = Cache::get(CACHE_MENU);
        } else {
            $menus = Cache::rememberForever(CACHE_MENU, function () {
                return Menu::with('menus')->ofStatus(Menu::STATUS_ACTIVE)->parentId(0)->orderBy('numering', 'asc')->get();
            });
        }
        $view->with('menus', $menus);

        //=========== social
        if (Cache::has(CACHE_SOCIAL)) {
            $socials = Cache::get(CACHE_SOCIAL);
        } else {
            $socials = Cache::rememberForever(CACHE_SOCIAL, function () {
                return Social::ofStatus(Social::STATUS_ACTIVE)->orderBy('numering', 'asc')->get();
            });
        }
        $view->with('socials', $socials);

        //=========== seo
        if (Cache::has(CACHE_SEO)) {
            $socials = Cache::get(CACHE_SEO);
        } else {
            $socials = Cache::rememberForever(CACHE_SEO, function () {
                $settings = [];
                Setting::whereHas('group', function ($q) {
                    $q->ofCode('seo');
                })->each(function ($modal) use (&$settings) {
                    $settings[$modal->code] = $modal->value;
                });
                return $settings;
            });
        }
        $view->with('seo', $socials);
    }
}

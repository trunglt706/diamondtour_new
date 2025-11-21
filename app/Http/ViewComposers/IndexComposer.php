<?php

namespace App\Http\ViewComposers;

use App\Models\Menu;
use App\Models\Setting;
use App\Models\Social;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Illuminate\Support\Facades\Config;

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
        $locale = Config::get('app.locale');
        $view->with('locale', $locale);

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
                return Social::ofStatus(Social::STATUS_ACTIVE)->orderBy('numering', 'desc')->select('icon', 'link')->get();
            });
        }
        $view->with('socials', $socials);

        //=========== seo
        if (Cache::has(CACHE_SEO . '-' . $locale)) {
            $seo = Cache::get(CACHE_SEO . '-' . $locale);
        } else {
            $seo = Cache::rememberForever(CACHE_SEO . '-' . $locale, function () use ($locale) {
                $settings = [];
                Setting::each(function ($modal) use (&$settings, $locale) {
                    $value = $locale == 'vi' ? 'value' : 'value_' . $locale;
                    $_value = $modal->$value ?? $modal->value;
                    $settings[$modal->code] = $_value;
                });
                return $settings;
            });
        }
        $view->with('seo', $seo);
    }
}

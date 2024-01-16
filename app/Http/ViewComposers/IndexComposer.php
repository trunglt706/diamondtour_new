<?php

namespace App\Http\ViewComposers;

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
        if (Cache::has(CACHE_SOCIAL)) {
            $socials = Cache::get(CACHE_SOCIAL);
        } else {
            $socials = Cache::rememberForever(CACHE_SOCIAL, function () {
                return Social::get();
            });
        }
        $view->with('data_social', $socials);
    }
}

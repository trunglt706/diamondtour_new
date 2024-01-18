<?php

namespace App\Http\ViewComposers;

use App\Models\UserMenu;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AdminComposer
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
        $user = auth()->check() ? auth()->user() : null;
        if (!is_null($user)) {
            $view->with('user_info', $user);

            if (Cache::has(CACHE_MENU_USER)) {
                $menus = Cache::get(CACHE_MENU_USER);
            } else {
                $menus = Cache::rememberForever(CACHE_MENU_USER, function () {
                    return UserMenu::with('menus')->ofStatus(UserMenu::STATUS_ACTIVE)->parentId(0)->orderBy('numering', 'asc')->get();
                });
            }
            $view->with('user_menus', $menus);
        }
    }
}

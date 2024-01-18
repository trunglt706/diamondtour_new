<?php

use App\Models\Setting;
use App\Models\UserMenu;

if (!function_exists('get_option')) {
    function get_option($code, $default = '')
    {
        $setting = Setting::ofCode($code)->first();
        return $setting->value ?? $default;
    }
}

if (!function_exists('renderUserMenu')) {
    function renderUserMenu($currentUrl = '')
    {
        $menus = UserMenu::with('menus')->parentId(0)->ofStatus(UserMenu::STATUS_ACTIVE)->orderBy('numering', 'asc')->get();
        foreach ($menus as $menu) {
            $hasSub = (count($menu->menus) > 0) ? 'has-sub' : '';
            $menuUrl = (!empty($menu->url)) ? $menu->url : '';
            $menuIcon = (!empty($menu->icon)) ? '<span class="menu-icon">' . $menu->icon . '</span>' : '';
            $menuText = (!empty($menu->name)) ? '<span class="menu-text">' . $menu->name . '</span>' : '';
            $menuCaret = (!empty($hasSub)) ? '<span class="menu-caret"><b class="caret"></b></span>' : '';
            $menuSubMenu = '';

            if (count($menu->menus) > 0) {
                $subMenu = renderUserSubMenu($menu->menus, $currentUrl);
                if ($subMenu[0]) {
                    $menuSubMenu .= '<div class="menu-submenu">';
                    $menuSubMenu .= $subMenu[0];
                    $menuSubMenu .= '</div>';

                    $active = ((!empty($menu->url) && check_active_menu($menu->url, $currentUrl)) || $subMenu[1] == 'active') ? 'active' : '';
                    echo '
                        <div class="menu-item ' . $hasSub . ' ' . $active . '">
                            <a href="' . $menuUrl . '" class="menu-link ' . $active . '">
                                ' . $menuIcon . '
                                ' . $menuText . '
                                ' . $menuCaret . '
                            </a>
                            ' . $menuSubMenu . '
                        </div>
                    ';
                }
            } else if ($menu->code == 'dashboard') {
                $active = (!empty($menu->url) && check_active_menu($menu->url, $currentUrl)) ? 'active' : '';
                echo '
                        <div class="menu-item ' . $hasSub . ' ' . $active . '">
                            <a href="' . $menuUrl . '" class="menu-link ' . $active . '">
                                ' . $menuIcon . '
                                ' . $menuText . '
                                ' . $menuCaret . '
                            </a>
                            ' . $menuSubMenu . '
                        </div>
                ';
            }
        }
    }
}

if (!function_exists('renderUserSubMenu')) {
    // generate code
    function renderUserSubMenu($value, $currentUrl = '/')
    {
        $subMenu = '';
        $status_active = '';
        foreach ($value as $menu) {
            if ($menu->code == 'dashboard') {
                $subSubMenu = '';
                $hasSub = count($menu->menus) > 0 ? 'has-sub' : '';
                $menuUrl = $menu->url ?? '';
                $menuCaret = (!empty($hasSub)) ? '<span class="menu-caret"><b class="caret"></b></span>' : '';
                $menuText = $menu->name ? '<span class="menu-text">' . $menu->name . '</span>' : '';

                if (!empty($hasSub)) {
                    $subSubMenu .= '<div class="menu-submenu">';
                    $subSubMenu .= renderUserSubMenu($menu->menus, $currentUrl);
                    $subSubMenu .= '</div>';
                }
                $active = check_active_menu($menuUrl, $currentUrl) ? 'active' : '';
                if ($status_active == '') {
                    $status_active = $active;
                }
                $subMenu .= '
                        <div class="menu-item ' . $hasSub . ' ' . $active . '">
                            <a href="' . $menuUrl . '" class="menu-link">' . $menuText . $menuCaret . '</a>
                            ' . $subSubMenu . '
                        </div>
                ';
            }
        }
        return [$subMenu, $status_active];
    }
}

if (!function_exists('check_active_menu')) {
    function check_active_menu($url, $currentUrl)
    {
        $host = request()->schemeAndHttpHost();
        if ($url != $host && $url != $host . '/' . USER_PREFIX_ROUTE) {
            $pattern = '/^' . preg_quote($url, '/') . '(\/.*)?$/';
            return preg_match($pattern, $currentUrl);
        }
        return $url == $currentUrl;
    }
}

if (!defined('USER_PREFIX_ROUTE')) {
    define('USER_PREFIX_ROUTE', 'user');
}

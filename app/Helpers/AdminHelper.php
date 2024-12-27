<?php

use App\Models\LogAction;
use App\Models\Setting;
use App\Models\UserMenu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

if (!function_exists('get_option')) {
    function get_option($code, $default = '')
    {
        $setting = Setting::ofCode($code)->select('value')->first();
        return $setting->value ?? $default;
    }
}

if (!function_exists('renderUserMenu')) {
    function renderUserMenu($currentUrl = '')
    {
        if (Cache::has(CACHE_MENU_USER)) {
            $menus = Cache::get(CACHE_MENU_USER);
        } else {
            $menus = Cache::remember(CACHE_MENU_USER, CACHE_TIME, function () {
                return UserMenu::with('menus')->parentId(0)->ofStatus(UserMenu::STATUS_ACTIVE)->orderBy('numering', 'asc')->get();
            });
        }
        foreach ($menus as $menu) {
            $hasSub = (count($menu->menus) > 0) ? 'has-sub' : '';
            $menuUrl = (!empty($menu->link)) ? $menu->link : '';
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

                    $active = $subMenu[1] == 'active' ? 'active' : '';
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
            } else {
                $active = check_active($menu->active);
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
            $subSubMenu = '';
            $hasSub = count($menu->menus) > 0 ? 'has-sub' : '';
            $menuUrl = $menu->link ?? '';
            $menuCaret = (!empty($hasSub)) ? '<span class="menu-caret"><b class="caret"></b></span>' : '';
            $menuText = $menu->name ? '<span class="menu-text">' . $menu->name . '</span>' : '';

            if (!empty($hasSub)) {
                $subSubMenu .= '<div class="menu-submenu">';
                $subSubMenu .= renderUserSubMenu($menu->menus, $currentUrl);
                $subSubMenu .= '</div>';
            }
            $active = check_active($menu->active);
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
    define('USER_PREFIX_ROUTE', 'admin');
}

if (!function_exists('generate_limit_select')) {
    function generate_limit_select($values = [10, 20, 50, 100])
    {
        $string = '<div class="w-75px me-1"><select name="limit" class="form-select filter-limit form-filter select-picker">';
        foreach ($values as $key => $v) {
            $selected = $key == 0 ? ' selected' : '';
            $string .= '<option value="' . $v . '" ' . $selected . '>' . $v . '</option>';
        }
        $string .= '</select></div>';
        return $string;
    }
}

if (!function_exists('check_active')) {
    function check_active($json)
    {
        $data = $json ? json_decode($json) : [];
        foreach ($data as $item) {
            if (Request::is($item)) {
                return 'active';
            }
        }
        return '';
    }
}

if (!function_exists('save_log')) {
    function save_log($content, $payload = [])
    {
        LogAction::create([
            'user_id' => auth()->check() ? auth()->user()->id : null,
            'description' => $content,
            'data_json' => json_encode($payload),
            'ip' => get_ip(),
            'device' => get_device()
        ]);
    }
}

if (!function_exists('stripHtml')) {
    function stripHtml($content)
    {
        // Loại bỏ tất cả các thẻ HTML
        $content = strip_tags($content);

        // Thay thế các ký tự HTML entity (ví dụ: &nbsp;, &amp;) bằng ký tự bình thường
        $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return $content;
    }
}

<?php

namespace Database\Seeders;

use App\Models\UserMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seed_user_menu extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserMenu::truncate();

        UserMenu::create([
            'code' => 'dashboard',
            'name' => 'Trang chủ',
            'link' => route('user.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE
            ]),
            'icon' => '<i class="fas fa-home"></i>'
        ]);
        UserMenu::create([
            'code' => 'user',
            'name' => 'Quản trị viên',
            'link' => route('user.user.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/user*',
                USER_PREFIX_ROUTE . '/log_action*',
                USER_PREFIX_ROUTE . '/profile*'
            ]),
            'icon' => '<i class="fas fa-user-circle"></i>'
        ]);
        UserMenu::create([
            'code' => 'tour',
            'name' => 'Tour',
            'link' => route('user.tour.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/tour*',
                USER_PREFIX_ROUTE . '/tour_group*',
                USER_PREFIX_ROUTE . '/tour_design*'
            ]),
            'icon' => '<i class="fas fa-plane-departure"></i>'
        ]);
        UserMenu::create([
            'code' => 'blog',
            'name' => 'Blog',
            'link' => route('user.blog.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/blog*',
                USER_PREFIX_ROUTE . '/blog_group*'
            ]),
            'icon' => '<i class="fas fa-file-alt"></i>'
        ]);
        UserMenu::create([
            'code' => 'destination',
            'name' => 'Destination',
            'link' => route('user.destination.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/destination*',
                USER_PREFIX_ROUTE . '/destination_group*'
            ]),
            'icon' => '<i class="fas fa-map-marker-alt"></i>'
        ]);
        UserMenu::create([
            'code' => 'setting',
            'name' => 'Cài đặt',
            'link' => route('user.setting.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/setting*',
                USER_PREFIX_ROUTE . '/social*',
                USER_PREFIX_ROUTE . '/qa*'
            ]),
            'icon' => '<i class="fas fa-tools"></i>'
        ]);
    }
}

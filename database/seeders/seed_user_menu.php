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
            'active' => 'user'
        ]);
        UserMenu::create([
            'code' => 'user',
            'name' => 'Quản trị viên',
            'link' => route('user.user.index'),
            'active' => 'user/user*'
        ]);
        UserMenu::create([
            'code' => 'tour',
            'name' => 'Tour',
            'link' => route('user.tour.index'),
            'active' => 'user/tour*'
        ]);
        UserMenu::create([
            'code' => 'blog',
            'name' => 'Blog',
            'link' => route('user.blog.index'),
            'active' => 'user/blog*'
        ]);
        UserMenu::create([
            'code' => 'destination',
            'name' => 'Destination',
            'link' => route('user.destination.index'),
            'active' => 'user/destination*'
        ]);
        UserMenu::create([
            'code' => 'setting',
            'name' => 'Cài đặt',
            'link' => route('user.setting.index'),
            'active' => 'user/setting*'
        ]);
    }
}

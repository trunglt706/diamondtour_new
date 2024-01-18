<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seed_menu extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::truncate();

        Menu::create([
            'code' => 'dashboard',
            'name' => 'Trang chủ',
            'link' => route('index'),
            'active' => '/'
        ]);
        Menu::create([
            'code' => 'about',
            'name' => 'Giới thiệu',
            'link' => route('about'),
            'active' => 'about'
        ]);
        Menu::create([
            'code' => 'destination',
            'name' => 'Điểm đến',
            'link' => route('destination.index'),
            'active' => 'destination*'
        ]);
        Menu::create([
            'code' => 'tour',
            'name' => 'Tour',
            'link' => route('tour.index'),
            'active' => 'tour*'
        ]);
        Menu::create([
            'code' => 'blog',
            'name' => 'Blog',
            'link' => route('blog.index'),
            'active' => 'blog*'
        ]);
        Menu::create([
            'code' => 'library',
            'name' => 'Thư viện',
            'link' => route('library.index'),
            'active' => 'library*'
        ]);
    }
}

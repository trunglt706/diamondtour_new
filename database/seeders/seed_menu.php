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
            'active' => 'about',
            'description' => 'Giá trị, cảm hứng và trải nghiệm du lịch khác biệt!',
            'background'  => asset('assets/images/breadcrumb-about-us.jpg'),
        ]);
        Menu::create([
            'code' => 'destination',
            'name' => 'Điểm đến',
            'link' => route('destination.index'),
            'active' => 'destination*',
            'description' => 'Các địa danh thú vị',
            'background' => asset('assets/images/bg_blog.png'),
        ]);
        Menu::create([
            'code' => 'tour',
            'name' => 'Tour',
            'link' => route('tour.index'),
            'active' => 'tour*',
            'description' => 'Những Tour được lựa chọn nhiều nhất',
            'background'  => asset('assets/images/bg-tour-list.png'),
        ]);
        Menu::create([
            'code' => 'blog',
            'name' => 'Blog',
            'link' => route('blog.index'),
            'active' => 'blog*',
            'description' => 'Nơi chia sẻ thông tin hành trình',
            'background' => asset('assets/images/bg_blog.png'),
        ]);
        Menu::create([
            'code' => 'library',
            'name' => 'Thư viện',
            'link' => route('library.index'),
            'active' => 'library*',
            'description' => 'Nơi lưu giữ hành trình của chúng tôi',
            'background' => asset('assets/images/breadcrumb-gallery.jpg')
        ]);
    }
}

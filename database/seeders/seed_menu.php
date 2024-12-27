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
            'active' => '/',
            'description' => 'Vinh hạnh mang đến trải nghiệm khác biệt trên mỗi hành trình!'
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
        Menu::create([
            'code' => 'faq',
            'name' => 'Câu hỏi thường gặp',
            'link' => route('faq'),
            'active' => 'faq*',
            'description' => 'Câu hỏi thường gặp',
            'background' => asset('assets/images/bg_blog.png'),
            'status' => Menu::STATUS_BLOCKED
        ]);
        Menu::create([
            'code' => 'design-tour',
            'name' => 'Thiết kế lịch trình',
            'link' => route('privte_schedule'),
            'active' => 'design-tour*',
            'description' => 'Thiết kế lịch trình',
            'background' => asset('assets/images/bg_blog.png'),
            'status' => Menu::STATUS_BLOCKED
        ]);
        Menu::create([
            'code' => 'contact',
            'name' => 'Liên hệ',
            'link' => route('contact.index'),
            'active' => 'contact*',
            'description' => 'Thông tin liên hệ',
            'background' => asset('assets/images/bg_blog.png'),
            'status' => Menu::STATUS_BLOCKED
        ]);
        Menu::create([
            'code' => 'calendar',
            'name' => 'Lịch khởi hành',
            'link' => route('tour.calendar'),
            'active' => 'tour*',
            'description' => 'Thông tin lịch khởi hành',
            'background' => asset('assets/images/bg_blog.png'),
            'status' => Menu::STATUS_BLOCKED
        ]);
        Menu::create([
            'code' => 'search',
            'name' => 'Tìm kiếm',
            'link' => route('search'),
            'active' => 'tim-kiem*',
            'description' => 'Tìm kiếm từ khóa',
            'background' => asset('assets/images/bg_blog.png'),
            'status' => Menu::STATUS_BLOCKED
        ]);
    }
}

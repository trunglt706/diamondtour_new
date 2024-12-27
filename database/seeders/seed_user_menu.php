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
                USER_PREFIX_ROUTE . '/tour_design*',
                USER_PREFIX_ROUTE . '/schedule*',
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
            'name' => 'Điểm đến',
            'link' => route('user.destination.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/destination*',
                USER_PREFIX_ROUTE . '/destination_group*',
                USER_PREFIX_ROUTE . '/review*',
            ]),
            'icon' => '<i class="fas fa-map-marker-alt"></i>'
        ]);
        UserMenu::create([
            'code' => 'event',
            'name' => 'Sự kiện',
            'link' => route('user.event.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/event*',
            ]),
            'icon' => '<i class="fas fa-calendar-alt"></i>'
        ]);
        UserMenu::create([
            'code' => 'service',
            'name' => 'Dịch vụ',
            'link' => route('user.service.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/service*',
            ]),
            'icon' => '<i class="fas fa-hand-holding-heart"></i>'
        ]);
        UserMenu::create([
            'code' => 'setting',
            'name' => 'Cài đặt',
            'link' => route('user.setting.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/setting*',
                USER_PREFIX_ROUTE . '/social*',
                USER_PREFIX_ROUTE . '/qa*',
                USER_PREFIX_ROUTE . '/qa_group*',
                USER_PREFIX_ROUTE . '/menu*',
            ]),
            'icon' => '<i class="fas fa-tools"></i>'
        ]);
        $other = UserMenu::create([
            'code' => 'other',
            'name' => 'Khác',
            'link' => route('user.contact.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/contact*',
                USER_PREFIX_ROUTE . '/newllter*',
                USER_PREFIX_ROUTE . '/country*',
                USER_PREFIX_ROUTE . '/province*',
            ]),
            'icon' => '<i class="fas fa-th-large"></i>'
        ]);
        UserMenu::create([
            'parent_id' => $other->id,
            'code' => 'contact',
            'name' => 'Thông tin đăng ký',
            'link' => route('user.contact.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/contact*',
                USER_PREFIX_ROUTE . '/newllter*',
                USER_PREFIX_ROUTE . '/register_promo*',
                USER_PREFIX_ROUTE . '/register_tour*',
            ]),
            'icon' => '<i class="fas fa-th-large"></i>'
        ]);
        UserMenu::create([
            'parent_id' => $other->id,
            'code' => 'country',
            'name' => 'Quốc gia',
            'link' => route('user.country.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/country*',
            ]),
            'icon' => '<i class="fas fa-globe-europe"></i>'
        ]);
        UserMenu::create([
            'parent_id' => $other->id,
            'code' => 'province',
            'name' => 'Khu vực',
            'link' => route('user.province.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/province*',
            ]),
            'icon' => '<i class="fas fa-crosshairs"></i>'
        ]);
        UserMenu::create([
            'parent_id' => $other->id,
            'code' => 'library',
            'name' => 'Thư viện',
            'link' => route('user.library.index'),
            'active' => json_encode([
                USER_PREFIX_ROUTE . '/library*',
                USER_PREFIX_ROUTE . '/library_group*',
            ]),
            'icon' => '<i class="fas fa-images"></i>'
        ]);
    }
}

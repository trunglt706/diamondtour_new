<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seed_module extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::truncate();

        Module::create([
            'code' => 'blog',
            'name' => 'Blog',
            'icon' => '<i class="fas fa-file-alt"></i>'
        ]);
        Module::create([
            'code' => 'destination',
            'name' => 'Điểm đến',
            'icon' => '<i class="fas fa-street-view"></i>'
        ]);
        Module::create([
            'code' => 'user',
            'name' => 'Quản trị viên',
            'icon' => '<i class="fas fa-user-circle"></i>'
        ]);
        Module::create([
            'code' => 'setting',
            'name' => 'Cài đặt',
            'icon' => '<i class="fas fa-tools"></i>'
        ]);
        Module::create([
            'code' => 'tour',
            'name' => 'Tour',
            'icon' => '<i class="fas fa-plane-departure"></i>'
        ]);
        Module::create([
            'code' => 'social',
            'name' => 'Social',
            'icon' => '<i class="fas fa-share-alt-square"></i>'
        ]);
        Module::create([
            'code' => 'review',
            'name' => 'Review',
            'icon' => '<i class="far fa-comments"></i>'
        ]);
        Module::create([
            'code' => 'newllter',
            'name' => 'Newllter',
            'icon' => '<i class="fas fa-mail-bulk"></i>'
        ]);
        Module::create([
            'code' => 'library',
            'name' => 'Thư viện',
            'icon' => '<i class="far fa-images"></i>'
        ]);
        Module::create([
            'code' => 'log_action',
            'name' => 'Nhật ký',
            'icon' => '<i class="fas fa-history"></i>'
        ]);
        Module::create([
            'code' => 'qa',
            'name' => 'Câu hỏi thường gặp',
            'icon' => '<i class="fas fa-question-circle"></i>'
        ]);
        Module::create([
            'code' => 'contact',
            'name' => 'Liên hệ',
            'icon' => '<i class="fas fa-file-signature"></i>'
        ]);
        Module::create([
            'code' => 'schedule',
            'name' => 'Lịch trình',
            'icon' => '<i class="far fa-calendar-check"></i>'
        ]);
    }
}

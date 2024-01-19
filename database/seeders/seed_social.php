<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seed_social extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Social::truncate();

        Social::create([
            'code' => 'facebook',
            'name' => 'Facebook',
            'icon' => '<i class="fa-brands fa-square-facebook"></i>'
        ]);
        Social::create([
            'code' => 'instagram',
            'name' => 'Instagram',
            'icon' => '<i class="fa-brands fa-instagram"></i>'
        ]);
        Social::create([
            'code' => 'youtube',
            'name' => 'Youtube',
            'icon' => '<i class="fa-brands fa-youtube"></i>'
        ]);
    }
}

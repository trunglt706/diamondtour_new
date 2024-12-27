<?php

namespace Database\Seeders;

use App\Models\TourStyle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seed_style extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tour_styles')->delete();
        TourStyle::create([
            'name' => 'Trải nghiệm'
        ]);
        TourStyle::create([
            'name' => 'Phật Giáo'
        ]);
        TourStyle::create([
            'name' => 'Nghỉ dưỡng Luxury'
        ]);
        TourStyle::create([
            'name' => 'Trekking/Hiking'
        ]);
    }
}

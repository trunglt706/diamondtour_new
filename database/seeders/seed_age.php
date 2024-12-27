<?php

namespace Database\Seeders;

use App\Models\TourAge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seed_age extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tour_ages')->delete();
        TourAge::create([
            'name' => 'Từ 18 đến 24'
        ]);
        TourAge::create([
            'name' => 'Từ 25 đến 34'
        ]);
        TourAge::create([
            'name' => 'Từ 35 đến 44'
        ]);
        TourAge::create([
            'name' => 'Từ 45 đến 54'
        ]);
        TourAge::create([
            'name' => 'Trên 55'
        ]);
    }
}

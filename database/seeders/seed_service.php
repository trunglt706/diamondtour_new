<?php

namespace Database\Seeders;

use App\Models\TourService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seed_service extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tour_services')->delete();
        TourService::create([
            'name' => '2 sao'
        ]);
        TourService::create([
            'name' => '3 sao'
        ]);
        TourService::create([
            'name' => '4 sao'
        ]);
        TourService::create([
            'name' => '5 sao'
        ]);
    }
}

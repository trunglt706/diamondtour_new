<?php

namespace Database\Seeders;

use App\Models\TourBalance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seed_balance extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tour_balances')->delete();
        TourBalance::create([
            'name' => 'Dưới 10 triệu',
            'from' => 0,
            'to' => 10000000
        ]);
        TourBalance::create([
            'name' => 'Từ 10 đến 20 triệu',
            'from' => 10000000,
            'to' => 20000000
        ]);
        TourBalance::create([
            'name' => 'Từ 20 đến 30 triệu',
            'from' => 20000000,
            'to' => 30000000
        ]);
        TourBalance::create([
            'name' => 'Từ 30 đến 50 triệu',
            'from' => 300000000,
            'to' => 500000000
        ]);
        TourBalance::create([
            'name' => 'Từ 50 đến 100 triệu',
            'from' => 50000000,
            'to' => 100000000
        ]);
        TourBalance::create([
            'name' => 'Trên 100 triệu',
            'from' => 100000000,
            'to' => 10000000000
        ]);
    }
}

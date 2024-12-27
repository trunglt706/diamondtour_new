<?php

namespace Database\Seeders;

use App\Models\TourObject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seed_object extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tour_objects')->delete();
        TourObject::create([
            'name' => 'Cặp đôi/ Vợ chồng'
        ]);
        TourObject::create([
            'name' => 'Gia đình'
        ]);
        TourObject::create([
            'name' => 'Nhóm bạn'
        ]);
        TourObject::create([
            'name' => 'Công ty'
        ]);
    }
}

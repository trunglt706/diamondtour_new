<?php

namespace Database\Seeders;

use App\Models\Countries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seed_country extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->delete();
        Countries::create([
            'code' => 'VN',
            'name' => 'Việt Nam'
        ]);
        Countries::create([
            'code' => 'INDIA',
            'name' => 'Ấn Độ'
        ]);
    }
}

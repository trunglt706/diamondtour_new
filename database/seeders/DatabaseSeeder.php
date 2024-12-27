<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(seed_menu::class);
        $this->call(seed_module::class);
        $this->call(seed_setting::class);
        $this->call(seed_social::class);
        $this->call(seed_user_menu::class);
        $this->call(seed_user::class);
        $this->call(seed_country::class);
        $this->call(seed_age::class);
        $this->call(seed_balance::class);
        $this->call(seed_object::class);
        $this->call(seed_style::class);
        $this->call(seed_service::class);
        Artisan::call('hcvn:install');
        Cache::flush();
        Artisan::call('app:sync-qa');
        // Artisan::call('app:sync-library');
        // Artisan::call('app:sync-comment');
        // Artisan::call('app:sync-blog');
        // Artisan::call('app:sync-destination');
        // Artisan::call('app:sync-tour');
    }
}

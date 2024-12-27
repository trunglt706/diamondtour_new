<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // \Log::debug('Bắt đầu update DB');
        // DB::update("UPDATE destination_groups SET image = REPLACE(image, 'http:', 'https:')");

        // DB::update("UPDATE destinations SET image = REPLACE(image, 'http:', 'https:')");
        // DB::update("UPDATE destinations SET image = REPLACE(image, 'http:', 'https:')");
        // DB::update("UPDATE destinations SET background = REPLACE(background, 'http:', 'https:')");
        // DB::update("UPDATE destinations SET image_description = REPLACE(image_description, 'http:', 'https:')");
        // DB::update("UPDATE destinations SET image_content = REPLACE(image_content, 'http:', 'https:')");
        // DB::update("UPDATE destinations SET album = REPLACE(album, 'http:', 'https:')");

        // DB::update("UPDATE libraries SET image = REPLACE(image, 'http:', 'https:')");

        // DB::update("UPDATE library_groups SET image = REPLACE(image, 'http:', 'https:')");
        // DB::update("UPDATE library_groups SET background = REPLACE(background, 'http:', 'https:')");

        // DB::update("UPDATE menus SET link = REPLACE(link, 'http:', 'https:')");
        // DB::update("UPDATE menus SET background = REPLACE(background, 'http:', 'https:')");
        // DB::update("UPDATE menus SET images = REPLACE(images, 'http:', 'https:')");

        // DB::update("UPDATE post_groups SET image = REPLACE(image, 'http:', 'https:')");

        // DB::update("UPDATE posts SET image = REPLACE(image, 'http:', 'https:')");
        // DB::update("UPDATE posts SET album = REPLACE(album, 'http:', 'https:')");
        // DB::update("UPDATE posts SET background = REPLACE(background, 'http:', 'https:')");

        // DB::update("UPDATE schedules SET image = REPLACE(image, 'http:', 'https:')");

        // DB::update("UPDATE settings SET value = REPLACE(value, 'http:', 'https:')");

        // DB::update("UPDATE tour_groups SET image = REPLACE(image, 'http:', 'https:')");

        // DB::update("UPDATE tours SET image = REPLACE(image, 'http:', 'https:')");
        // DB::update("UPDATE tours SET images = REPLACE(images, 'http:', 'https:')");
        // DB::update("UPDATE tours SET background = REPLACE(background, 'http:', 'https:')");
        // \Log::debug('Đã update xong DB ' . now());
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Review;
use Illuminate\Console\Command;

class SyncComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-comment';

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
        for ($i = 0; $i < 5; $i++) {
            Review::create([
                'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.',
                'user_name' => 'Louna Daniel',
                'user_avatar' => asset('assets/images/testimonial-item.jpg'),
                'name' => 'Designation'
            ]);
        }
    }
}

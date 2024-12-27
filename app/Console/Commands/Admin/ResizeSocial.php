<?php

namespace App\Console\Commands\Admin;

use App\Models\Social;
use Illuminate\Console\Command;
use Intervention\Image\ImageManagerStatic as Image;

class ResizeSocial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:resize-social';

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
        $list = Social::all();
        foreach ($list as $item) {
            try {
                //icon
                if (file_exists(public_path($item->icon))) {
                    $image = Image::make(public_path($item->icon));
                    $image->resize(200, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $old_file = $item->icon;
                    $webpString = preg_replace('/\.[a-zA-Z0-9]+$/', '.webp', $item->icon);
                    $image->save($webpString);
                    $item->icon = $webpString; // Lưu đường dẫn tương đối
                    $item->save();

                    delete_file($old_file);
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}

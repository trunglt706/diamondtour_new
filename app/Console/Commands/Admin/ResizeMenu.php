<?php

namespace App\Console\Commands\Admin;

use App\Models\Menu;
use Illuminate\Console\Command;
use Intervention\Image\ImageManagerStatic as Image;

class ResizeMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:resize-menu';

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
        $list = Menu::all();
        foreach ($list as $item) {
            try {
                //background
                // if (file_exists(public_path($item->background))) {
                //     $image = Image::make(public_path($item->background));
                //     $image->resize(1500, null, function ($constraint) {
                //         $constraint->aspectRatio();
                //         $constraint->upsize();
                //     });
                //     $old_file = $item->background;
                //     $webpString = preg_replace('/\.[a-zA-Z0-9]+$/', '.webp', $item->background);
                //     $image->save($webpString);
                //     $item->background = $webpString; // Lưu đường dẫn tương đối
                //     $item->save();

                //     delete_file($old_file);
                // }

                // images
                $new_images = [];
                $images = $item->images ? json_decode($item->images) : [];
                foreach ($images as $img) {
                    if (file_exists(public_path($img))) {
                        $image = Image::make(public_path($img));
                        $image->resize(1500, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                        $image->save(public_path($img));

                        $webpString = preg_replace('/\.[a-zA-Z0-9]+$/', '.webp', $img);
                        $image->save($webpString);
                        array_push($new_images, $webpString);

                        delete_file($img);
                    }
                }
                $item->images = json_encode($new_images);
                $item->save();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}

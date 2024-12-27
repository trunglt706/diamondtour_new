<?php

namespace App\Console\Commands\Admin;

use App\Models\Destination;
use Illuminate\Console\Command;
use Intervention\Image\ImageManagerStatic as Image;

class ResizeDestination extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:resize-destination';

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
        $list = Destination::all();
        foreach ($list as $item) {
            try {
                //image
                if (file_exists(public_path($item->image))) {
                    $image = Image::make(public_path($item->image));
                    $image->resize(900, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $old_file = $item->image;
                    $webpString = preg_replace('/\.[a-zA-Z0-9]+$/', '.webp', $item->image);
                    $image->save($webpString);
                    $item->image = $webpString; // Lưu đường dẫn tương đối
                    $item->save();

                    delete_file($old_file);
                }

                //image_description
                if (file_exists(public_path($item->image_description))) {
                    $image = Image::make(public_path($item->image_description));
                    $image->resize(900, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $old_file = $item->image_description;
                    $webpString = preg_replace('/\.[a-zA-Z0-9]+$/', '.webp', $item->image_description);
                    $image->save($webpString);
                    $item->image_description = $webpString; // Lưu đường dẫn tương đối
                    $item->save();

                    delete_file($old_file);
                }

                //image_content
                if (file_exists(public_path($item->image_content))) {
                    $image = Image::make(public_path($item->image_content));
                    $image->resize(900, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $old_file = $item->image_content;
                    $webpString = preg_replace('/\.[a-zA-Z0-9]+$/', '.webp', $item->image_content);
                    $image->save($webpString);
                    $item->image_content = $webpString; // Lưu đường dẫn tương đối
                    $item->save();

                    delete_file($old_file);
                }

                //background
                if (file_exists(public_path($item->background))) {
                    $image = Image::make(public_path($item->background));
                    $image->resize(1500, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $old_file = $item->background;
                    $webpString = preg_replace('/\.[a-zA-Z0-9]+$/', '.webp', $item->background);
                    $image->save($webpString);
                    $item->background = $webpString; // Lưu đường dẫn tương đối
                    $item->save();

                    delete_file($old_file);
                }

                //album
                // $albums = $item->album ? json_decode($item->album) : [];
                // foreach ($albums as $album) {
                //     if (file_exists(public_path($album))) {
                //         $image = Image::make(public_path($album));
                //         $image->resize(1500, null, function ($constraint) {
                //             $constraint->aspectRatio();
                //             $constraint->upsize();
                //         });
                //         $image->save(public_path($album));
                //     }
                // }
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}

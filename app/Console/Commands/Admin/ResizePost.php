<?php

namespace App\Console\Commands\Admin;

use App\Models\Post;
use Illuminate\Console\Command;
use Intervention\Image\ImageManagerStatic as Image;

class ResizePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:resize-post';

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
        $list = Post::orderBy('created_at', 'desc')->get();
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

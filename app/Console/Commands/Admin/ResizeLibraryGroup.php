<?php

namespace App\Console\Commands\Admin;

use App\Models\LibraryGroup;
use Illuminate\Console\Command;
use Intervention\Image\ImageManagerStatic as Image;

class ResizeLibraryGroup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:resize-library-group';

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
        $list = LibraryGroup::all();
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
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}

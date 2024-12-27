<?php

namespace App\Console\Commands\Admin;

use App\Models\Images;
use App\Models\Setting;
use Illuminate\Console\Command;
use Intervention\Image\ImageManagerStatic as Image;

class ResizeSetting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:resize-setting';

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
        $list = Setting::ofType([Setting::TYPE_FILE, Setting::TYPE_IMAGES])->get();
        foreach ($list as $item) {
            try {
                if ($item->type == Setting::TYPE_FILE) {
                    //image
                    if (file_exists(public_path($item->value))) {
                        $image = Image::make(public_path($item->value));
                        $image->resize(300, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                        $old_file = $item->value;
                        $webpString = preg_replace('/\.[a-zA-Z0-9]+$/', '.webp', $item->value);
                        $image->save($webpString);
                        $item->value = $webpString; // Lưu đường dẫn tương đối
                        $item->save();

                        delete_file($old_file);
                    }
                } else {
                    // Images::ofCode($item->code)->each(function ($img) {
                    //     //url
                    //     if (file_exists(public_path($img->url))) {
                    //         $image = Image::make(public_path($img->url));
                    //         $image->resize(500, null, function ($constraint) {
                    //             $constraint->aspectRatio();
                    //             $constraint->upsize();
                    //         });
                    //         $image->save(public_path($img->url));
                    //     }
                    // });
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}

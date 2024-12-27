<?php

namespace App\Console\Commands\Admin;

use App\Models\Library;
use Illuminate\Console\Command;
use Intervention\Image\ImageManagerStatic as Image;

class ResizeLibrary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:resize-library';

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
        $list = Library::orderBy('created_at', 'asc')->limit(20)->get();
        foreach ($list as $item) {
            try {
                //image
                if (file_exists(public_path($item->image))) {
                    $image = Image::make(public_path($item->image));
                    $image->resize(1500, null, function ($constraint) {
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
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Library;
use App\Models\LibraryGroup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Str;

class SyncLibrary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-library';

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
        DB::beginTransaction();
        try {
            DB::table('libraries')->delete();
            DB::table('library_groups')->delete();

            $link = 'https://dev-diamondtour.pantheonsite.io/thu-vien-anh/';
            $html = file_get_contents($link);

            // Khởi tạo DomCrawler
            $crawler = new Crawler($html);
            $listItems = $crawler->filter('article');
            $listItems->each(function (Crawler $post) {
                // Lấy thông tin từ mỗi phần tử
                $image = $post->filter('.elementor-widget-container img')->attr('src');
                $url = $post->filter('.make-column-clickable-elementor')->attr('data-column-clickable');
                $title = $post->filter('.elementor-widget-container h2')->text();
                $slug = Str::between($url, 'https://dev-diamondtour.pantheonsite.io/gallery/', '/');
                $group = LibraryGroup::create([
                    'slug' => $slug,
                    'name' => $title,
                    'image' => $image
                ]);

                $html = file_get_contents($url);
                $crawler = new Crawler($html);
                $listDetails = $crawler->filter('.e-gallery-item');
                $listDetails->each(function (Crawler $item) use ($group) {
                    $image = $item->filter('.e-gallery-image')->attr('data-thumbnail');
                    $title = $item->filter('.elementor-gallery-item__title')->text();
                    Library::create([
                        'group_id' => $group->id,
                        'image' => $image,
                        'name' => $title,
                    ]);
                });
            });
            DB::commit();
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
        }
    }
}

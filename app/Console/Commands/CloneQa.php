<?php

namespace App\Console\Commands;

use App\Models\Qa;
use App\Models\QaGroup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;

class CloneQa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clone-qa';

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
            DB::table('qas')->delete();
            DB::table('qa_groups')->delete();

            $link = 'https://dev-diamondtour.pantheonsite.io/nhung-cau-hoi-thuong-gap/';
            $html = file_get_contents($link);

            // Khởi tạo DomCrawler
            $crawler = new Crawler($html);
            $listItems = $crawler->filter('elementor-heading-title');
            $listItems->each(function (Crawler $group) {
                // Lấy thông tin từ mỗi phần tử
                $name = $group->filter('h2')->text();
                $new = QaGroup::create([
                    'name' => $name,
                ]);
                // $listDetails = $group->filter('.card-wrapper');
                // $listDetails->each(function (Crawler $item) use ($new) {
                //     $name = $item->filter('.card-header .title')->text();
                //     $description = $item->filter('.card-body p')->text();
                //     Qa::create([
                //         'name' => $name,
                //         'image' => $description,
                //         'group_id' => $new->id,
                //     ]);
                // });
            });
            DB::commit();
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
        }
    }
}

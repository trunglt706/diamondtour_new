<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\PostGroup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Str;

class SyncBlog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-blog';

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
        DB::table('posts')->delete();
        DB::table('post_groups')->delete();

        $list = [
            [
                'slug' => 'nhat-ky',
                'name' => 'Nhật ký hành trình',
                'image' => 'https://diamondtour.vn/wp-content/uploads/2020/05/8-co-lung-ta-tay-tang-565x380.jpg',
                'link' => 'https://diamondtour.vn/nhat-ky/'
            ], [
                'slug' => 'cam-nang',
                'name' => 'Cẩm nang kinh nghiệm',
                'image' => 'https://diamondtour.vn/wp-content/uploads/2023/07/z4392822083463_d13e706f21a7a73ff1ff15e9cc2b4472-565x380.jpg',
                'link' => 'https://diamondtour.vn/kinh-nghiem/'
            ]
        ];
        DB::beginTransaction();
        try {
            foreach ($list as $item) {
                $postGroup = PostGroup::create($item);
                // Tạo client Panther
                // Sử dụng Guzzle để tải nội dung trang web
                $link = $item['link'];
                $html = file_get_contents($link);

                // Khởi tạo DomCrawler
                $crawler = new Crawler($html);
                $listItems = $crawler->filter('.list-article__item');
                $listItems->each(function (Crawler $post) use ($postGroup, $link) {
                    // Lấy thông tin từ mỗi phần tử
                    $image = $post->filter('img')->attr('src');
                    $url = $post->filter('.list-article__image a')->attr('href');
                    $title = $post->filter('.list-article__content a')->text();
                    $slug = Str::between($url, $link, '/');
                    $slug = Str::between($slug, 'https://diamondtour.vn/tin-tuc/', '/');
                    $data = [
                        'image' => $image,
                        'link' => $url,
                        'name' => $title,
                        'group_id' => $postGroup->id,
                        'slug' => $slug,
                        'status' => Post::STATUS_ACTIVE
                    ];
                    $html = file_get_contents($url);
                    $crawler = new Crawler($html);
                    $content = $crawler->filter('.article-detail__body')->text();
                    $description = $crawler->filter('meta[name="description"]')->attr('content');
                    $data['content'] = $content;
                    $data['description'] = $description;
                    Post::create($data);
                });
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            showLog($th);
        }
    }
}

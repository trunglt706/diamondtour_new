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
                'slug' => 'kinh-nghiem',
                'name' => 'Cẩm nang kinh nghiệm',
                'image' => 'https://diamondtour.vn/wp-content/uploads/2023/07/z4392822083463_d13e706f21a7a73ff1ff15e9cc2b4472-565x380.jpg',
                'link' => 'https://diamondtour.vn/kinh-nghiem/'
            ]
        ];

        $list2 = [
            [
                'slug' => 'van-hoa',
                'name' => 'Thông tin văn hóa',
                'image' => 'https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/8-1-e1589452514332.jpg',
                'link' => 'https://dev-diamondtour.pantheonsite.io/van-hoa/'
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
                    $data['tags'] = json_encode(['hành trình', 'nhật ký', 'tour']);
                    $data['album'] = json_encode([
                        asset('assets/images/tour_home_3.png'),
                        asset('assets/images/destination-home-3.jpg'),
                        asset('assets/images/slider-2.jpg'),
                        asset('assets/images/bg_newsletter.png'),
                        asset('assets/images/bg-tour-list.png'),
                        asset('assets/images/post-culture-4.png'),
                    ]);
                    Post::create($data);
                });
            }

            foreach ($list2 as $item) {
                $postGroup = PostGroup::create($item);
                // Tạo client Panther
                // Sử dụng Guzzle để tải nội dung trang web
                $link = $item['link'];
                $html = file_get_contents($link);

                // Khởi tạo DomCrawler
                $crawler = new Crawler($html);
                $listItems = $crawler->filter('article');
                $listItems->each(function (Crawler $post) use ($postGroup, $link) {
                    // Lấy thông tin từ mỗi phần tử
                    $image = $post->filter('.elementor-post__thumbnail img')->attr('src');
                    $url = $post->filter('.elementor-post__thumbnail__link')->attr('href');
                    $title = $post->filter('.elementor-post__title a')->text();
                    $slug = Str::between($url, $link, '/');
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
                    $content = $crawler->filter('.post-details .elementor-widget-container')->text();
                    $description = $crawler->filter('meta[name="description"]')->attr('content');
                    $data['content'] = $content;
                    $data['description'] = $description;
                    $data['tags'] = json_encode(['hành trình', 'văn hóa', 'bài viết']);
                    $data['album'] = json_encode([
                        asset('assets/images/tour_home_3.png'),
                        asset('assets/images/destination-home-3.jpg'),
                        asset('assets/images/slider-2.jpg'),
                        asset('assets/images/bg_newsletter.png'),
                        asset('assets/images/bg-tour-list.png'),
                        asset('assets/images/post-culture-4.png'),
                    ]);
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

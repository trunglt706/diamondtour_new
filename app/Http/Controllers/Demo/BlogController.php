<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Post;
use App\Models\PostGroup;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    /**
     * Trang chính
     */
    public function index()
    {
        $menu = Menu::ofCode('blog')->select('background', 'name', 'description')->first();
        $data = [
            'ads' => true,
            'favorits' => self::favorits(),
            'hot' => self::hot(),
            'importants' => self::importants(),
            'news' => self::news(),
            'viewers' => self::viewers(),
            'categories' => self::categories(),
            'menu' => $menu
        ];
        return view('guest.blogs.index', compact('data'));
    }

    /**
     * Lấy danh sách danh mục bài viết
     */
    public static function categories()
    {
        $key = 'blog-categories';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return PostGroup::ofStatus(PostGroup::STATUS_ACTIVE)->select('slug', 'name')->withCount('blogs')->orderBy('blogs_count', 'desc')->get();
        });
    }

    /**
     * Lấy danh sách bài viết được xem nhất
     */
    public static function viewers()
    {
        $key = 'blog-viewers';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return Post::where(['posts.status' => 'active'])
                ->orderBy('posts.view_total', 'desc')->orderBy('posts.created_at', 'desc')
                ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'posts.slug', 'posts.image', 'posts.view_total', 'posts.created_at', 'posts.description')->limit(6)->get();
        });
    }

    /**
     * Lấy danh sách bài viết mới nhất
     */
    public static function news()
    {
        $key = 'blog-news';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            $list = Post::where(['posts.status' => 'active'])
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'posts.slug', 'posts.image', 'posts.tags', 'posts.created_at', 'posts.description')->limit(6)->get();
            return [
                'left' => $list ? $list->slice(0, 3) : null,
                'right' => $list ? $list->slice(3, 6) : null,
            ];
        });
    }

    /**
     * Lấy danh sách bài viết tiêu điểm
     */
    public static function importants()
    {
        $key = 'blog-importants';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return Post::leftJoin('post_groups', 'post_groups.id', '=', 'posts.group_id')
                ->where(['posts.status' => 'active', 'posts.tieu_diem' => 1])
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'post_groups.name as group_name', 'post_groups.name_en as group_name_en', 'post_groups.name_ch as group_name_ch', 'posts.slug', 'posts.image', 'posts.created_at', 'posts.description')->limit(6)->get();
        });
    }

    /**
     * Lấy danh sách bài viết được yêu thích nhất
     */
    public static function favorits()
    {
        $key = 'blog-favorits';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return Post::where(['posts.status' => 'active'])->where('posts.like_total', '>', 0)
                ->orderBy('posts.like_total', 'desc')->orderBy('posts.created_at', 'desc')
                ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'posts.slug', 'posts.image', 'posts.like_total', 'posts.created_at', 'posts.description')->limit(4)->get();
        });
    }

    /**
     * Lấy bài viết hot nhất
     */
    public static function hot()
    {
        $key = 'blog-hot';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return Post::where(['posts.status' => 'active', 'posts.hot' => 1])
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'posts.slug', 'posts.tags', 'posts.image', 'posts.created_at', 'posts.description')->first();
        });
    }

    /**
     * Trang danh mục
     */
    public function category($slug)
    {
        $list = null;
        $title = "";
        switch ($slug) {
            case 'news':
                # list bài đăng mới nhất
                $title = __('messages.blog.blog_new');
                $list = Post::leftJoin('post_groups', 'post_groups.id', '=', 'posts.group_id')
                    ->where(['posts.status' => 'active'])
                    ->orderBy('posts.created_at', 'desc')
                    ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'post_groups.slug as group_slug', 'post_groups.name as group_name', 'post_groups.name_en as group_name_en', 'post_groups.name_ch as group_name_ch', 'posts.slug', 'posts.image', 'posts.created_at', 'posts.description')->paginate(9);
                break;
            case 'favorits':
                # list bài đăng yêu thích nhất
                $title = __('messages.blog.blog_yeu_thich');
                $list = Post::leftJoin('post_groups', 'post_groups.id', '=', 'posts.group_id')
                    ->where('posts.like_total', '>', 0)->where(['posts.status' => 'active'])
                    ->orderBy('posts.like_total', 'desc')->orderBy('posts.created_at', 'desc')
                    ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'post_groups.slug as group_slug', 'post_groups.name as group_name', 'post_groups.name_en as group_name_en', 'post_groups.name_ch as group_name_ch', 'posts.slug', 'posts.image', 'posts.created_at', 'posts.description')->paginate(9);
                break;
            case 'viewers':
                # list bài đăng được xem nhiều nhất
                $title = __('messages.blog.xem_nhieu_nhat');
                $list = Post::leftJoin('post_groups', 'post_groups.id', '=', 'posts.group_id')
                    ->where(['posts.status' => 'active'])
                    ->orderBy('posts.view_total', 'desc')->orderBy('posts.created_at', 'desc')
                    ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'post_groups.slug as group_slug', 'post_groups.name as group_name', 'post_groups.name_en as group_name_en', 'post_groups.name_ch as group_name_ch', 'posts.slug', 'posts.image', 'posts.created_at', 'posts.description')->paginate(9);
                break;
            case 'importants':
                # list bài đăng là tiêu điểm trong tuần
                $title = __('messages.blog.blog_tieu_diem');
                $list = Post::leftJoin('post_groups', 'post_groups.id', '=', 'posts.group_id')
                    ->where(['posts.status' => 'active', 'posts.important' => 1])
                    ->orderBy('posts.created_at', 'desc')
                    ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'post_groups.slug as group_slug', 'post_groups.name as group_name', 'post_groups.name_en as group_name_en', 'post_groups.name_ch as group_name_ch', 'posts.slug', 'posts.image', 'posts.created_at', 'posts.description')->paginate(9);
                break;
            default:
                # list bài đăng thuộc danh mục
                $group = PostGroup::ofSlug($slug)->ofStatus(PostGroup::STATUS_ACTIVE)->first();
                $title = get_data_lang($group, 'name');
                $list = Post::leftJoin('post_groups', 'post_groups.id', '=', 'posts.group_id')
                    ->where(['posts.status' => 'active', 'posts.group_id' => $group->id])
                    ->orderBy('posts.created_at', 'desc')
                    ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'post_groups.slug as group_slug', 'post_groups.name as group_name', 'post_groups.name_en as group_name_en', 'post_groups.name_ch as group_name_ch', 'posts.slug', 'posts.image', 'posts.created_at', 'posts.description')->paginate(9);
                break;
        }
        $data = [
            'title' => $title,
            'list' => $list,
        ];
        return view('guest.blogs.list.index', compact('data'));
    }

    /**
     * Trang chi tiết
     */
    public function detail($slug)
    {
        $blog = Post::ofStatus(Post::STATUS_ACTIVE)->ofSlug($slug)->firstOrFail();
        CheckViewSession("_blog_$blog->id", $blog);
        $others = Post::groupId($blog->group_id)->ofStatus(Post::STATUS_ACTIVE)
            ->orderBy('created_at', 'desc')
            ->select('name', 'posts.name_en', 'posts.name_ch', 'slug', 'image', 'description')->limit(6)->get();
        $data = [
            'blog' => $blog,
            'others' => $others,
        ];
        return view('guest.blogs.detail.index', compact('data'));
    }

    /**
     * Trang blogs
     */
    public function blogs()
    {
        $data = [
            'importants' => Post::leftJoin('post_groups', 'post_groups.id', '=', 'posts.group_id')
                ->where(['posts.status' => 'active', 'posts.important' => 1])
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'post_groups.name as group_name', 'post_groups.name_en as group_name_en', 'post_groups.name_ch as group_name_ch', 'posts.slug', 'posts.image', 'posts.created_at', 'posts.description')->limit(3)->get(),
            'news' => Post::where(['posts.status' => 'active'])
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'posts.slug', 'posts.image', 'posts.created_at', 'posts.description')->limit(6)->get(),
            'guests' => Post::where(['posts.status' => 'active'])
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'posts.slug', 'posts.image', 'posts.created_at')->limit(6)->get(),
            'shares' => Post::leftJoin('post_groups', 'post_groups.id', '=', 'posts.group_id')
                ->where(['posts.status' => 'active', 'posts.important' => 1])
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'post_groups.name as group_name', 'post_groups.name_en as group_name_en', 'post_groups.name_ch as group_name_ch', 'posts.slug', 'posts.image', 'posts.created_at', 'posts.description')->limit(6)->get(),
        ];
        return view('guest.blogs.blogs.index', compact('data'));
    }
}

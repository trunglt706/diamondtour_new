<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Post;
use App\Models\PostGroup;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{

    public function index()
    {
        $page = request('page', '');
        $key = CACHE_BLOG . '-index-' . $page;
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () {
                $menu = Menu::ofCode('blog')->select('background', 'name', 'name_en', 'name_ch', 'description', 'description_en', 'description_ch')->first();
                $important = Post::ofStatus(Post::STATUS_ACTIVE)
                    ->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'name', 'slug', 'image', 'description')->limit(6)->get();
                $important1 = $important ? $important->slice(0, 3) : null;
                $important2 = $important ? $important->slice(3, 3) : null;

                $nhatkyGroup = PostGroup::ofSlug('nhat-ky')->ofStatus(PostGroup::STATUS_ACTIVE)->select('id', 'name', 'name_en', 'name_ch', 'slug')->first();
                $nhatky = $nhatkyGroup ? Post::groupId($nhatkyGroup->id)->ofStatus(Post::STATUS_ACTIVE)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->limit(3)->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image', 'description')->get()
                    : null;

                $kinhnghiemGroup = PostGroup::ofSlug('kinh-nghiem')->ofStatus(PostGroup::STATUS_ACTIVE)->select('id', 'name', 'name_en', 'name_ch', 'slug')->first();
                $kinhnghiem = $kinhnghiemGroup ? Post::groupId($kinhnghiemGroup->id)->ofStatus(Post::STATUS_ACTIVE)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->limit(3)->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image', 'description')->get()
                    : null;

                $vanhoaGroup = PostGroup::ofSlug('van-hoa')->ofStatus(PostGroup::STATUS_ACTIVE)->select('id', 'name', 'name_en', 'name_ch', 'slug')->first();
                $vanhoa = $vanhoaGroup ? Post::groupId($vanhoaGroup->id)->ofStatus(Post::STATUS_ACTIVE)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->limit(6)->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image', 'description')->get()
                    : null;
                $vanhoa1 = $vanhoa ? $vanhoa->slice(0, 3) : null;
                $vanhoa2 = $vanhoa ? $vanhoa->slice(3, 3) : null;

                $seo = [
                    'image' => $menu->background,
                    'title' => $menu->name,
                    'description' => $menu->description,
                ];
                return [
                    'menu' => $menu,
                    'important1' => $important1,
                    'important2' => $important2,
                    'nhatky' => $nhatky,
                    'nhatkyGroup' => $nhatkyGroup,
                    'kinhnghiem' => $kinhnghiem,
                    'kinhnghiemGroup' => $kinhnghiemGroup,
                    'vanhoa1' => $vanhoa1,
                    'vanhoa2' => $vanhoa2,
                    'vanhoaGroup' => $vanhoaGroup,
                    'seo' => $seo
                ];
            });
        }
        return view('pages.posts', compact('data'));
    }

    public function cat_blog($cat_alias)
    {
        $page = request('page', '');
        $key = CACHE_BLOG . '-category-' . $page . '-' . $cat_alias;
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () use ($cat_alias) {
                $group = PostGroup::ofSlug($cat_alias)->ofStatus(PostGroup::STATUS_ACTIVE)->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image')->firstOrFail();
                $groupId = $group->id;
                $list = Post::groupId($groupId)->ofStatus(Post::STATUS_ACTIVE)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image', 'description')->paginate(6);
                $seo = [
                    'image' => $group->image,
                    'title' => $group->name,
                    'description' => get_option('seo-description'),
                ];
                return [
                    'list' => $list,
                    'group' => $group,
                    'seo' => $seo
                ];
            });
        }
        return view('pages.cat-post', compact('data'));
    }

    public function detail($alias)
    {
        $key = CACHE_BLOG . '-detail-' . $alias;
        $blog = Post::with('group')->ofSlug($alias)->ofStatus(Post::STATUS_ACTIVE)
            ->firstOrFail();
        CheckViewSession("_blog_$blog->id", $blog);
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () use ($blog) {
                $menu = Menu::ofCode('blog')->select('background', 'name', 'name_en', 'name_ch', 'description', 'description_en', 'description_ch')->first();
                $other = Post::where('id', '<>', $blog->id)->groupId($blog->group_id)->ofStatus(Post::STATUS_ACTIVE)
                    ->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->limit(3)->select('id', 'slug', 'name', 'name_en', 'name_ch', 'image', 'description')
                    ->get();

                $tour_ids = $blog->tours ? json_decode($blog->tours) : [];
                $tours = Tour::whereIn('id', $tour_ids)->ofStatus(Tour::STATUS_ACTIVE)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'name', 'slug', 'image', 'description', 'price')->limit(6)->get();

                $seo = [
                    'image' => $blog->image,
                    'title' => $blog->name,
                    'description' => $blog->description,
                    'keywords' => $blog->tags ? implode(', ', json_decode($blog->tags)) : ''
                ];
                return [
                    'menu' => $menu,
                    'other' => $other,
                    'tours' => $tours,
                    'blog' => $blog,
                    'seo' => $seo
                ];
            });
        }
        return view('pages.single-post', compact('data'));
    }
}

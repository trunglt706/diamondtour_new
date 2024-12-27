<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\LibraryGroup;
use App\Models\Menu;
use App\Models\TourGroup;
use Illuminate\Support\Facades\Cache;

class AlbumController extends Controller
{
    /**
     * Trang chính
     */
    public function index()
    {
        $menu = Menu::ofCode('library')->select('background', 'name', 'description', 'name_en', 'name_ch', 'description_en', 'description_ch')->first();
        $data = [
            'news' => self::news(),
            'hot' => self::hot(),
            'important' => self::important(),
            'guests' => self::guests(),
            'viewers' => self::viewers(),
            'likes' => self::likes(),
            'menu' => $menu
        ];
        return view('guest.album.index', compact('data'));
    }

    /**
     * Lấy danh sách album thích nhiều nhất
     */
    public static function likes()
    {
        $key = 'album-likes';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return LibraryGroup::with(['libraries' => function ($query) {
                $query->limit(3);
            }])->ofStatus(LibraryGroup::STATUS_ACTIVE)->orderBy('like_total', 'desc')
                ->select('slug', 'id', 'name', 'date', 'address', 'name_en', 'name_ch', 'description', 'image')->first();
        });
    }

    /**
     * Lấy danh sách album xem nhiều nhất
     */
    public static function viewers()
    {
        $key = 'album-viewers';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return LibraryGroup::ofStatus(LibraryGroup::STATUS_ACTIVE)->orderBy('view_total', 'desc')
                ->select('slug', 'name', 'date', 'name_en', 'name_ch', 'description', 'image')->limit(4)->get();
        });
    }

    /**
     * Lấy danh sách album của khách
     */
    public static function guests()
    {
        $key = 'album-guests';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return LibraryGroup::ofStatus(LibraryGroup::STATUS_ACTIVE)->ofGuest(1)->orderBy('created_at', 'desc')
                ->select('slug', 'name', 'name_en', 'name_ch', 'description', 'image')->limit(4)->get();
        });
    }

    /**
     * Lấy danh sách album mới nhất
     */
    public static function news()
    {
        $key = 'album-news';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return TourGroup::where(['status' => 'active'])
                ->orderBy('created_at', 'desc')
                ->select('name', 'name_en', 'name_ch', 'slug', 'image', 'description')->get();
        });
    }

    /**
     * Lấy album hot nhất
     */
    public static function hot()
    {
        $key = 'album-hot';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return LibraryGroup::ofStatus(LibraryGroup::STATUS_ACTIVE)->ofHot(1)->orderBy('created_at', 'desc')
                ->select('slug', 'name', 'name_en', 'name_ch', 'description', 'image', 'date', 'address', 'created_at')->limit(3)->get();
        });
    }

    /**
     * Lấy album quan trọng nhất
     */
    public static function important()
    {
        $key = 'album-important';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return LibraryGroup::ofStatus(LibraryGroup::STATUS_ACTIVE)->ofImportant(1)->orderBy('created_at', 'desc')
                ->select('slug', 'name', 'name_en', 'name_ch', 'description', 'image', 'created_at')->first();
        });
    }

    /**
     * Trang danh mục
     */
    public function category($slug)
    {
        $tour_group = TourGroup::ofStatus(TourGroup::STATUS_ACTIVE)->ofSlug($slug)->select('name', 'name_en', 'name_ch', 'image', 'description', 'video_name', 'video_image', 'video_status', 'video_url')->firstOrFail();
        $next_season = get_next_season(get_current_season());
        $data = [
            'tour_group' => $tour_group,
            'likes' => LibraryGroup::tourGroupId($tour_group->id)->ofStatus(LibraryGroup::STATUS_ACTIVE)->orderBy('like_total', 'desc')
                ->select('slug', 'name', 'name_en', 'name_ch', 'created_at', 'image')->limit(6)->get(),
            'news' => LibraryGroup::tourGroupId($tour_group->id)->ofStatus(LibraryGroup::STATUS_ACTIVE)->orderBy('created_at', 'desc')
                ->select('slug', 'name', 'name_en', 'name_ch', 'created_at', 'image')->limit(8)->get(),
            'seasons' => LibraryGroup::tourGroupId($tour_group->id)->ofSeason($next_season)->ofStatus(LibraryGroup::STATUS_ACTIVE)->orderBy('created_at', 'desc')
                ->select('slug', 'name', 'name_en', 'name_ch', 'image')->limit(6)->get(),
            'video' => $tour_group,
        ];
        return view('guest.album.group.index', compact('data'));
    }

    /**
     * Trang chi tiết
     */
    public function detail($slug)
    {
        $group = LibraryGroup::ofStatus(LibraryGroup::STATUS_ACTIVE)->ofSlug($slug)->firstOrFail();
        CheckViewSession("_album_$group->id", $group);
        $page = request('page', 1);
        $data = [
            'images' => Library::groupId($group->id)->type(Library::TYPE_LIBRARY)->ofStatus(Library::STATUS_ACTIVE)->select('image', 'extension', 'name', 'name_en', 'name_ch')->orderBy('created_at', 'desc')->paginate(8),
            'group' => $group,
        ];
        return view('guest.album.detail.index', compact('data'));
    }
}

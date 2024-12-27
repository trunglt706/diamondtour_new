<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Library;
use App\Models\Menu;
use App\Models\Qa;
use App\Models\Schedule;
use App\Models\Tour;
use App\Models\TourCalendar;
use App\Models\TourGroup;
use Illuminate\Support\Facades\Cache;

class TourController extends Controller
{
    /**
     * Trang chính
     */
    public function index()
    {
        $menu = Menu::ofCode('tour')->select('background', 'name', 'description', 'name_en', 'name_ch', 'description_en', 'description_ch')->first();
        $next_season = get_next_season(get_current_season());
        $data = [
            'blogs' => self::blogs(),
            'tours' => self::tours(),
            'seasonal_tours' => self::seasonal_tours($next_season),
            'design' => self::tour_designs(),
            'faq' => self::faqs(),
            'menu' => $menu,
            't' => Tour::IS_TOUR,
            'first' => Tour::ofStatus(Tour::STATUS_ACTIVE)->ofType(Tour::IS_TOUR)->latest()->select('tours.name', 'name_en', 'name_ch', 'tours.slug', 'tours.description')->first(),
        ];
        return view('guest.tours.index', compact('data'));
    }

    /**
     * Lấy danh sách câu hỏi thường gặp
     */
    public static function faqs()
    {
        $key = 'tour-faq';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return Qa::where(['qas.status' => 'active'])
                ->orderBy('qas.created_at', 'desc')
                ->select('qas.id', 'qas.name', 'qas.name_en', 'qas.name_ch', 'qas.description', 'qas.description_en', 'qas.description_ch')->limit(8)->get();
        });
    }

    /**
     * Lấy danh sách tour sắp diễn ra
     */
    public static function blogs($t = '0')
    {
        $key = "tour-blog-$t";
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () use ($t) {
            return TourCalendar::join('tours', 'tours.id', '=', 'tour_calendars.tour_id')->ofDisplay(true)->whereDate('tour_calendars.end', '>=', date('Y-m-d'))
                ->where('tours.type', $t)->orderBy('tour_calendars.start', 'asc')->orderBy('tour_calendars.created_at', 'desc')
                ->select('tours.name', 'tours.name_en', 'tours.name_ch', 'tours.slug', 'tours.image')->limit(3)->get();
        });
    }

    /**
     * Lấy danh sách sản phẩm cốt lỗi
     */
    public static function tours()
    {
        $key = 'tour-group';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return TourGroup::where(['status' => 'active'])
                ->orderBy('numering', 'desc')->orderBy('created_at', 'desc')
                ->select('name', 'slug', 'country_id', 'image', 'description', 'starts', 'days', 'personals')->get();
        });
    }

    /**
     * Lấy danh sách tour thiết kế
     */
    public static function tour_designs($t = '0')
    {
        $key = "tour-design-$t";
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () use ($t) {
            return Tour::where(['tours.status' => 'active', 'tours.design' => 1])->where('tours.type', $t)
                ->orderBy('tours.important', 'desc')->orderBy('tours.created_at', 'desc')
                ->select('tours.name', 'name_en', 'name_ch', 'tours.slug', 'tours.image', 'tours.duration')->limit(6)->get();
        });
    }

    /**
     * Lấy danh sách tour theo mùa
     */
    public static function seasonal_tours($seasonal, $t = '0')
    {
        $key = "home-seasonal-tour-$seasonal-$t";
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () use ($seasonal, $t) {
            return Tour::where(['status' => 'active', 'season' => $seasonal])->where('tours.type', $t)
                ->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                ->select('name', 'name_en', 'name_ch', 'slug', 'image')->limit(3)->get();
        });
    }

    /**
     * Trang danh mục
     */
    public function category($slug)
    {
        switch ($slug) {
            case 'list':
                $t = request('t', Tour::IS_TOUR);
                # load danh sách all tour
                $data['menu'] =  Menu::ofCode('tour')->select('background', 'name', 'description', 'name_en', 'name_ch', 'description_en', 'description_ch')->first();
                $data['tours'] = Tour::leftJoin('countries', 'tours.country_id', '=', 'countries.id')->ofStatus(Tour::STATUS_ACTIVE)
                    ->ofType($t)->select('tours.image', 'tours.slug', 'tours.name', 'tours.name_en', 'tours.name_ch', 'tours.from', 'tours.price', 'countries.name as country_name')
                    ->orderBy('tours.created_at', 'desc')->paginate(12);
                return view('guest.tours.all.index', compact('data'));
                break;
            case 'design':
                $t = request('t', Tour::IS_TOUR);
                # load danh sách tour design
                $data['tours'] = Tour::leftJoin('countries', 'tours.country_id', '=', 'countries.id')->ofStatus(Tour::STATUS_ACTIVE)
                    ->ofDesign(Tour::IS_DESIGN)->ofType($t)->select('tours.image', 'tours.slug', 'tours.name', 'tours.name_en', 'tours.name_ch', 'tours.from', 'tours.price')
                    ->orderBy('tours.created_at', 'desc')->paginate(9);
                return view('guest.tours.group.design', compact('data'));
                break;
            case 'season':
                $q = request('q', '');
                $t = request('t', Tour::IS_TOUR);
                # load danh sách tour theo mùa
                $data['tours'] = Tour::leftJoin('countries', 'tours.country_id', '=', 'countries.id')->ofStatus(Tour::STATUS_ACTIVE)
                    ->ofType($t)->ofSeason($q)->select('tours.image', 'tours.slug', 'tours.name', 'tours.name_en', 'tours.name_ch', 'tours.from', 'tours.price')
                    ->orderBy('tours.created_at', 'desc')->paginate(9);
                return view('guest.tours.group.season', compact('data'));
                break;
            case 'bundle':
                $t = request('t', Tour::IS_TOUR);
                $b = request('b', '1');
                # load danh sách tour theo mùa
                $data['tours'] = Tour::leftJoin('countries', 'tours.country_id', '=', 'countries.id')->ofStatus(Tour::STATUS_ACTIVE)
                    ->ofType($t)->ofBundle($b)
                    ->select('tours.image', 'tours.slug', 'tours.name', 'tours.name_en', 'tours.name_ch', 'tours.from', 'tours.price')->orderBy('tours.created_at', 'desc')->paginate(9);
                return view('guest.tours.group.bundle', compact('data'));
                break;
            default:
                $t = request('t', Tour::IS_TOUR);
                $group = TourGroup::ofStatus(TourGroup::STATUS_ACTIVE)->ofSlug($slug)->firstOrFail();
                CheckViewSession("_tour_group_$group->id", $group);
                $page = request('page', 1);
                $data = [
                    'tours' => self::destination_of_groups($group->id, $page),
                    'group' => $group,
                ];
                return view('guest.tours.group.index', compact('data'));
                break;
        }
    }

    /**
     * Lấy danh sách điểm đến theo quốc gia thuộc nhóm
     */
    public static function destination_of_groups($group_id, $page)
    {
        $key = "destination-of-group-$group_id-$page";
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () use ($group_id) {
            return Destination::leftJoin('countries', 'destinations.country_id', '=', 'countries.id')
                ->ofStatus(Destination::STATUS_ACTIVE)->ofType(Destination::TYPE_NATIONAL)->where(function ($q) use ($group_id) {
                    $q->whereJsonContains('tour_group_ids', (string)$group_id)
                        ->orWhere('tour_group_id', $group_id);
                })
                ->select('destinations.image', 'countries.name as country_name', 'destinations.slug', 'destinations.name', 'destinations.name_en', 'destinations.name_ch')
                ->orderBy('destinations.created_at', 'desc')->paginate(6);
        });
    }

    /**
     * Lấy danh sách tour thuộc nhóm
     */
    public static function tour_of_groups($group_id, $page, $t = '0')
    {
        $key = "tour-of-group-$group_id-$page-$t";
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () use ($group_id, $t) {
            return Tour::ofStatus(Tour::STATUS_ACTIVE)->ofType($t)
                ->where(function ($q) use ($group_id) {
                    $q->groupId($group_id)
                        ->orWhereHas('groups', function ($q1) use ($group_id) {
                            $q1->groupId($group_id);
                        });
                })
                ->select('image', 'slug', 'name', 'name_en', 'name_ch', 'view_total', 'like_total')->orderBy('created_at', 'desc')->paginate(6);
        });
    }

    /**
     * Trang chi tiết
     */
    public function detail($slug)
    {
        $data = Tour::ofStatus(Tour::STATUS_ACTIVE)->ofSlug($slug)->firstOrFail();
        CheckViewSession("_tour_$data->id", $data);
        $data = [
            'tour' => $data,
            'schedules' => self::schedule_of_tours($data->id),
            'albums' => Library::groupId($data->id)->type(Library::TYPE_TOUR)->ofStatus(Library::STATUS_ACTIVE)->select('id', 'image')->limit(5)->get(),
        ];
        return view('guest.tours.detail.index', compact('data'));
    }

    /**
     * Lấy danh sách lịch trình thuộc tour
     */
    public static function schedule_of_tours($tour_id)
    {
        $key = 'schedule-of-group-' . $tour_id;
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () use ($tour_id) {
            return Schedule::tourId($tour_id)->ofStatus(Schedule::STATUS_ACTIVE)->select('id', 'image', 'description', 'name')->orderBy('created_at', 'asc')->get();
        });
    }

    /**
     * Trang landtours
     */
    public function landtours()
    {
        $menu = Menu::ofCode('landtour')->select('background', 'name', 'description', 'name_en', 'name_ch', 'description_en', 'description_ch')->first();
        $next_season = get_next_season(get_current_season());
        $data = [
            'blogs' => self::blogs(Tour::IS_LANDTOUR),
            'tours' => self::tours(),
            'seasonal_tours' => self::seasonal_tours($next_season, Tour::IS_LANDTOUR),
            'design' => self::tour_designs(Tour::IS_LANDTOUR),
            'faq' => self::faqs(),
            'menu' => $menu,
            't' => Tour::IS_LANDTOUR,
            'first' => Tour::ofStatus(Tour::STATUS_ACTIVE)->ofType(Tour::IS_LANDTOUR)->latest()->select('tours.name', 'name_en', 'name_ch', 'tours.slug', 'tours.description')->first(),
        ];
        return view('guest.landtours.index', compact('data'));
    }
}

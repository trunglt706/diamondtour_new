<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Http\Requests\DesignTourRequest;
use App\Http\Requests\NewllterRequest;
use App\Models\Countries;
use App\Models\DesignTour;
use App\Models\Destination;
use App\Models\Events;
use App\Models\Menu;
use App\Models\Newllter;
use App\Models\Post;
use App\Models\Province;
use App\Models\QaGroup;
use App\Models\Review;
use App\Models\Tour;
use App\Models\TourAge;
use App\Models\TourBalance;
use App\Models\TourGroup;
use App\Models\TourObject;
use App\Models\TourService;
use App\Models\TourStyle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    /**
     * Trang search tours
     */
    public function search()
    {
        $search = request('search', '');
        $type = request('t', '');
        $start = request('start', '');
        $end = request('end', '');

        $tours = null;
        $blogs = null;
        $destinations = null;
        $menu = Menu::ofCode('search')->select('background', 'name', 'description', 'name_en', 'name_ch', 'description_en', 'description_ch')->first();
        switch ($type) {
            case 'tour':
                $tours = Tour::ofStatus(Tour::STATUS_ACTIVE);
                if ($start != '' && $end != '') {
                    $tours = $tours->where('from', '>=', $start)->where(function ($q) use ($end) {
                        $q->where('to', '<=', $end)
                            ->orWhereNull('to');
                    });
                }
                $tours = $tours->search($search)->select('image', 'slug', 'name', 'name_en', 'name_ch', 'from', 'price')->orderBy('created_at', 'desc')->paginate(6);
                break;
            case 'activity':
                $tours = Tour::ofStatus(Tour::STATUS_ACTIVE)->where("activity", "LIKE", "%$search%")->select('image', 'slug', 'name', 'name_en', 'name_ch', 'from', 'price')->orderBy('created_at', 'desc')->paginate(6);
                break;
            case 'blog':
                $blogs = Post::ofStatus(Post::STATUS_ACTIVE)->search($search)->select('image', 'slug', 'name', 'name_en', 'name_ch')->orderBy('created_at', 'desc')->paginate(6);
                break;
            case 'destination':
                $destinations = Destination::leftJoin('provinces', 'destinations.province_id', '=', 'provinces.id')
                    ->leftJoin('countries', 'destinations.country_id', '=', 'countries.id')
                    ->ofStatus(Destination::STATUS_ACTIVE)->search($search)
                    ->select('destinations.image', 'countries.name as country_name', 'provinces.name as province_name', 'destinations.slug', 'destinations.type', 'destinations.name', 'destinations.name_en', 'destinations.name_ch')->orderBy('destinations.created_at', 'desc')->paginate(6);
                break;

            default:
                $blogs = Post::ofStatus(Post::STATUS_ACTIVE)->search($search)->select('image', 'slug', 'name', 'name_en', 'name_ch')->orderBy('created_at', 'desc')->paginate(6);
                $tours = Tour::ofStatus(Tour::STATUS_ACTIVE)->search($search)->select('image', 'slug', 'name', 'name_en', 'name_ch', 'from', 'price')->orderBy('created_at', 'desc')->paginate(6);
                $destinations = Destination::leftJoin('provinces', 'destinations.province_id', '=', 'provinces.id')
                    ->leftJoin('countries', 'destinations.country_id', '=', 'countries.id')
                    ->ofStatus(Destination::STATUS_ACTIVE)->search($search)
                    ->select('destinations.image', 'countries.name as country_name', 'provinces.name as province_name', 'destinations.slug', 'destinations.type', 'destinations.name', 'destinations.name_en', 'destinations.name_ch')->orderBy('destinations.created_at', 'desc')->paginate(6);
                break;
        }
        $data = [
            'menu' => $menu,
            'blogs' => $blogs,
            'tours' => $tours,
            'type' => $type,
            'search' => $search,
            'destinations' => $destinations,
        ];
        return view('guest.home.search', compact('data'));
    }
    /**
     * Trang faq
     */
    public function faq()
    {
        if (Cache::has('demo_faq')) {
            $data = Cache::get('demo_faq');
        } else {
            $data = Cache::remember('demo_faq', CACHE_TIME, function () {
                $menu = Menu::ofCode('faq')->select('background', 'name', 'description', 'name_en', 'name_ch', 'description_en', 'description_ch')->first();
                $list = QaGroup::with('qas')->ofStatus(QaGroup::STATUS_ACTIVE)
                    ->orderBy('numering', 'asc')->orderBy('created_at', 'asc')
                    ->select('id', 'name', 'name_en', 'name_ch')->get();
                return [
                    'list' => $list,
                    'menu' => $menu
                ];
            });
        }
        return view('guest.faq.index', compact('data'));
    }

    /**
     * Trang chính
     */
    public function index()
    {
        $menu = Menu::ofCode('dashboard')->select('background', 'images', 'name', 'description', 'name_en', 'name_ch', 'description_en', 'description_ch')->first();
        $next_season = get_next_season(get_current_season());
        $data = [
            'blogs' => self::blogs(),
            'tours' => self::tours(),
            'seasonal_tours' => TourController::seasonal_tours($next_season),
            'events' => self::events(),
            'feedbacks' => self::feedbacks(),
            'cam_nang' => self::cam_nang(),
            'menu' => $menu
        ];
        return view('guest.home.index', compact('data'));
    }

    /**
     * Ajax load tour theo mùa
     */
    public function load_seasonal_tours()
    {
        $season = request('season');
        $data['seasonal_tours'] = TourController::seasonal_tours($season);
        return view('guest.home.ajax.seasonal_tours', compact('data'))->render();
    }

    /**
     * Lấy danh sách bài viết nối bật
     */
    public static function blogs()
    {
        $key = 'home-blog';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return Post::join('post_groups', 'post_groups.id', '=', 'posts.group_id')
                ->where(['posts.status' => 'active'])
                ->orderBy('posts.important', 'desc')->orderBy('posts.created_at', 'desc')
                ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'posts.slug', 'posts.image', 'post_groups.name as group_name', 'post_groups.name_en as group_name_en', 'post_groups.name_ch as group_name_ch')->limit(3)->get();
        });
    }

    /**
     * Lấy danh sách sản phẩm cốt lỗi
     */
    public static function tours()
    {
        $key = 'home-tour';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return TourGroup::where(['status' => 'active'])
                ->orderBy('numering', 'desc')->orderBy('created_at', 'desc')
                ->select('name', 'country_id', 'slug', 'image', 'description', 'starts', 'days', 'personals')->get();
        });
    }

    /**
     * Lấy sự kiện nổi bật
     */
    public static function events()
    {
        $key = 'home-event';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return Events::where(['status' => 'active', 'home' => 1])
                ->select('title', 'slug', 'image', 'description', 'date')->first();
        });
    }

    /**
     * Lấy danh sách feedback từ khách hàng
     */
    public static function feedbacks()
    {
        $key = 'home-feedback';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return Review::where(['status' => 'active', 'destination_id' => null])
                ->orderBy('created_at', 'desc')
                ->select('name', 'content', 'user_name', 'user_avatar')->limit(5)->get();
        });
    }

    /**
     * Lấy danh sách cẩm nang du lịch
     */
    public static function cam_nang()
    {
        $key = 'home-cam-nang';
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return Cache::remember($key, CACHE_TIME, function () {
            return Post::join('post_groups', 'post_groups.id', '=', 'posts.group_id')
                ->where(['posts.status' => 'active'])
                ->orderBy('posts.important', 'desc')->orderBy('posts.created_at', 'desc')
                ->select('posts.name', 'posts.name_en', 'posts.name_ch', 'posts.slug', 'posts.description', 'posts.image', 'posts.created_at', 'post_groups.name as group_name', 'post_groups.name_en as group_name_en', 'post_groups.name_ch as group_name_ch')->limit(4)->get();
        });
    }

    public function privte_schedule()
    {
        if (Cache::has(CACHE_DESIGN_TOUR)) {
            $data = Cache::get(CACHE_DESIGN_TOUR);
        } else {
            $data = Cache::remember(CACHE_DESIGN_TOUR, CACHE_TIME, function () {
                $menu = Menu::ofCode('design-tour')->select('background', 'name', 'name_en', 'name_ch', 'description', 'description_en', 'description_ch')->first();
                $countries = Countries::ofStatus(Countries::STATUS_ACTIVE)->select('id', 'name')->get();
                // tour_groups
                $tour_groups = TourGroup::ofStatus(TourGroup::STATUS_ACTIVE)
                    ->orderBy('numering', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'name', 'name_en', 'name_ch')->get();
                // provinces
                $provinces = Province::select('id', 'name')->get();
                // objects
                $objects = TourObject::ofStatus(TourObject::STATUS_ACTIVE)->select('id', 'name')->get();
                // ages
                $ages = TourAge::ofStatus(TourAge::STATUS_ACTIVE)->select('id', 'name')->get();
                // balances
                $balances = TourBalance::ofStatus(TourBalance::STATUS_ACTIVE)->select('id', 'name')->get();
                // styles
                $styles = TourStyle::ofStatus(TourStyle::STATUS_ACTIVE)->select('id', 'name')->get();
                // styles
                $services = TourService::ofStatus(TourService::STATUS_ACTIVE)->select('id', 'name')->get();

                $seo = [
                    'image' => $menu->background,
                    'title' => $menu->name,
                    'description' => $menu->description,
                ];

                return [
                    'menu' => $menu,
                    'countries' => $countries,
                    'tour_groups' => $tour_groups,
                    'provinces' => $provinces,
                    'objects' => $objects,
                    'ages' => $ages,
                    'balances' => $balances,
                    'styles' => $styles,
                    'services' => $services,
                    'seo' => $seo
                ];
            });
        }
        return view('guest.other.privte_schedule', compact('data'));
    }

    public function privte_schedule_post(DesignTourRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            // chỉ cho phép gửi liên hệ 1 lần trong ngày từ email hoặc số ĐT
            $date = now()->format('Y-m-d');
            $check = DesignTour::ofPhone($data['phone'])->whereDate('created_at', $date)->count();
            if ($check > 0) {
                return redirect()->back()->with('error', 'Bạn đã đăng ký lịch trình trước đó!');
            }
            if (isset($data['phone'])) {
                $check = DesignTour::ofEmail($data['email'])->whereDate('created_at', $date)->count();
                if ($check > 0) {
                    return redirect()->back()->with('error', 'Bạn đã đăng ký lịch trình trước đó!');
                }
            }
            if (isset($data['someone_id']) && $data['someone_id'] == 'other') {
                unset($data['someone_id']);
            }
            $data['expected_date'] = isset($data['expected_date']) ? Carbon::parse(formatDate($data['expected_date']))->format('Y-m-d') : now()->format('Y-m-d');
            DesignTour::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Thiết kế lịch trình riêng thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            showLog($th);
            return redirect()->back()->with('error', 'Thiết kế lịch trình riêng thất bại!');
        }
    }

    public function changeLang($lang)
    {
        $a = ['vi', 'en', 'ch'];
        if (in_array($lang, $a)) {
            Session::put('locale', $lang);
        } else {
            Session::put('locale', Config::get('app.locale'));
        }
        return redirect()->back();
    }

    /**
     * Post newsletter subscription
     *
     * @param NewllterRequest $request
     * @return void
     */
     public function newllter(NewllterRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only('email');
            $requestCount = session()->get('newllter_request_count', 0);
            if ($requestCount >= 1) {
                return redirect()->back()->with('error', 'Rất tiết, bạn đã vượt quá số lượng đăng ký nhận thông báo!');
            }
            Newllter::create($data);
            DB::commit();
            session()->put('newllter_request_count', $requestCount + 1);
            return redirect()->back()->with('success', 'Đăng ký thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            showLog($th);
            return redirect()->back()->with('error', 'Đăng ký thất bại!');
        }
    }
}

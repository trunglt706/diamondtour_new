<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\DesignTourRequest;
use App\Http\Requests\NewllterRequest;
use App\Models\Countries;
use App\Models\Destination;
use App\Models\Menu;
use App\Models\Newllter;
use App\Models\Post;
use App\Models\QaGroup;
use App\Models\Review;
use App\Models\Tour;
use App\Models\TourAge;
use App\Models\TourBalance;
use App\Models\DesignTour;
use App\Models\Events;
use App\Models\RegisterPromo;
use App\Models\RegisterTour;
use App\Models\TourCalendar;
use App\Models\TourGroup;
use App\Models\TourObject;
use App\Models\TourService;
use App\Models\TourStyle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Vanthao03596\HCVN\Models\Province;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    public function index()
    {
        $key = CACHE_HOME . '-index';
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () {
                $tour_groups = TourGroup::ofStatus(TourGroup::STATUS_ACTIVE)
                    ->orderBy('numering', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'slug', 'name', 'name_en', 'name_ch', 'image')->limit(6)->get();

                $calendars = TourCalendar::with('tour', 'tour.withCountry')->ofDisplay(true)->whereDate('end', '>=', date('Y-m-d'))
                    ->orderBy('start', 'asc')->orderBy('created_at', 'desc')->limit(6)->get();

                $menu = Menu::ofCode('dashboard')->first();

                // review
                $review = Review::ofStatus(Review::STATUS_ACTIVE)->whereNull('destination_id')->orderBy('created_at', 'desc')->select('id', 'name', 'content', 'user_name', 'user_avatar')->limit(5)->get();

                // destination
                $destination = Destination::ofType(Destination::TYPE_NATIONAL)->ofStatus(Destination::STATUS_ACTIVE)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'slug', 'name', 'name_en', 'name_ch', 'description', 'image')->limit(5)->get();

                $seo = [
                    'image' => $menu->background,
                    'title' => $menu->name,
                    'description' => $menu->description,
                ];

                // blog
                $blog = Post::ofStatus(Post::STATUS_ACTIVE)
                    ->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image', 'description')->limit(4)->get();
                $blog1 = $blog ? $blog->slice(0, 1) : null;
                $blog2 = $blog ? $blog->slice(1, 3) : null;

                // faq
                $faq_group = QaGroup::with('qas')->ofStatus(QaGroup::STATUS_ACTIVE)->first();

                // tours (discovery)
                $tours = Tour::join('tour_groups', 'tours.group_id', '=', 'tour_groups.id')
                    ->ofStatus(Tour::STATUS_ACTIVE)->orderBy('tours.important', 'desc')->orderBy('tours.created_at', 'desc')
                    ->select('tours.id', 'tours.slug', 'tours.name', 'tours.name_en', 'tours.name_ch', 'tours.description', 'tours.price', 'tours.currency', 'tours.image', 'tour_groups.name as group_name', 'tour_groups.name_en as group_name_en', 'tour_groups.name_ch as group_name_ch')->limit(8)->get();
                return [
                    'blog1' => $blog1,
                    'blog2' => $blog2,
                    'faq_group' => $faq_group,
                    'tours' => $tours,
                    'tour_groups' => $tour_groups,
                    'menu' => $menu,
                    'calendars' => $calendars,
                    'seo' => $seo,
                    'review' => $review,
                    'destination' => $destination,
                ];
            });
        }
        $data['event'] = Events::ofStatus(Events::STATUS_ACTIVE)->ofHome(1)->select('slug', 'background')->first();
        return view('pages.main', compact('data'));
    }

    public function load_companion()
    {
        return view('pages.blocks.companion');
    }

    public function load_tours()
    {
        $type = request('type', 'home');
        $key = 'home-load_tours';
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () {
                // tours
                $data['tours'] = Tour::join('tour_groups', 'tours.group_id', '=', 'tour_groups.id')
                    ->ofStatus(Tour::STATUS_ACTIVE)->orderBy('tours.important', 'desc')->orderBy('tours.created_at', 'desc')
                    ->select(
                        'tours.id',
                        'tours.slug',
                        'tours.name',
                        'tours.name_en',
                        'tours.name_ch',
                        'tours.description',
                        'tours.price',
                        'tours.currency',
                        'tours.image',
                        'tour_groups.name as group_name',
                        'tour_groups.name_en as group_name_en',
                        'tour_groups.name_ch as group_name_ch'
                    )->limit(8)->get();
            });
        }

        return $type == 'about' ? view('pages.blocks.discovery', compact('data')) : view('pages.blocks.destination-home', compact('data'));
    }

    public function load_faqs()
    {
        $key = 'home-load_faqs';
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () {
                $data['faq_group'] = QaGroup::with('qas')->ofStatus(QaGroup::STATUS_ACTIVE)->first();
            });
        }
        return view('pages.blocks.faq-home', compact('data'));
    }

    public function load_posts()
    {
        $key = 'home-load_posts';
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () {
                $blog = Post::ofStatus(Post::STATUS_ACTIVE)
                    ->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image', 'description')->limit(4)->get();
                $blog1 = $blog ? $blog->slice(0, 1) : null;
                $blog2 = $blog ? $blog->slice(1, 3) : null;
                return [
                    'blog1' => $blog1,
                    'blog2' => $blog2,
                ];
            });
        }
        return view('pages.blocks.post-home', compact('data'));
    }

    public function faq()
    {
        $key = 'home-faq';
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () {
                $menu = Menu::ofCode('faq')->first();
                $list = QaGroup::with('qas')->ofStatus(QaGroup::STATUS_ACTIVE)
                    ->orderBy('numering', 'asc')->orderBy('created_at', 'asc')
                    ->select('id', 'name', 'name_en', 'name_ch')->get();
                $seo = [
                    'image' => $menu->background,
                    'title' => $menu->name,
                    'description' => $menu->description,
                ];
                return [
                    'menu' => $menu,
                    'list' => $list,
                    'seo' => $seo
                ];
            });
        }
        return view('pages.faq', compact('data'));
    }

    public function privte_schedule()
    {
        if (Cache::has(CACHE_DESIGN_TOUR)) {
            $data = Cache::get(CACHE_DESIGN_TOUR);
        } else {
            $data = Cache::remember(CACHE_DESIGN_TOUR, CACHE_TIME, function () {
                $menu = Menu::ofCode('design-tour')->first();
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
        return view('pages.privte_schedule', compact('data'));
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

    public function search()
    {
        $tag = request('tag', '');
        $blogs = Post::ofStatus(Post::STATUS_ACTIVE)->search($tag)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
            ->select('id', 'slug', 'name', 'name_en', 'name_ch', 'image', 'description', 'tags')
            ->paginate(5);
        $destinations = Destination::ofStatus(Destination::STATUS_ACTIVE)->search($tag)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
            ->select('id', 'slug', 'name', 'name_en', 'name_ch', 'image', 'description', 'tags')
            ->paginate(5);
        $tours = Tour::ofStatus(Tour::STATUS_ACTIVE)->search($tag)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
            ->select('id', 'slug', 'name', 'name_en', 'name_ch', 'image', 'description', 'price', 'currency')
            ->paginate(5);
        $seo = [
            'image' => get_option('seo-logo'),
            'title' => 'Tìm kếm',
            'description' => get_option('seo-description'),
        ];
        $menu = Menu::ofCode('search')->first();

        $data = [
            'tours' => $tours,
            'destinations' => $destinations,
            'blogs' => $blogs,
            'tag' => $tag,
            'seo' => $seo,
            'menu' => $menu
        ];
        return view('pages.search-article', compact('data'));
    }

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

    public function register_promo()
    {
        DB::beginTransaction();
        try {
            $data = request()->only('name', 'phone', 'email', 'question', 'content');
            RegisterPromo::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Đăng ký thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            showLog($th);
            return redirect()->back()->with('error', 'Đăng ký thất bại!');
        }
    }

    public function register_tour()
    {
        DB::beginTransaction();
        try {
            $data = request()->only('name', 'phone', 'adults', 'children', 'other', 'content');
            RegisterTour::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Đăng ký thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            showLog($th);
            return redirect()->back()->with('error', 'Đăng ký thất bại!');
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
}

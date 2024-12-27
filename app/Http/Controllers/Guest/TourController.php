<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\Library;
use App\Models\Menu;
use App\Models\Tour;
use App\Models\TourBalance;
use App\Models\TourCalendar;
use App\Models\TourGroup;
use Illuminate\Support\Facades\Cache;

class TourController extends Controller
{

  public function index()
  {
    $page = request('page', '');
    $country = request('country', '');
    $from = request('from', '');
    $to = request('to', '');
    $price = request('price', '');

    $list = Tour::with('withCountry')->ofStatus(Tour::STATUS_ACTIVE);
    $list = $country != '' ? $list->countryId($country) : $list;
    if ($from && $to) {
      $list = $from != '' ? $list->between(formatDate($from), formatDate($to)) : $list;
    }
    if ($price != '') {
      $price = TourBalance::ofStatus(TourBalance::STATUS_ACTIVE)->find($price);
      if ($price) {
        $list = $list->betweenPrice($price->from, $price->to);
      }
    }
    $list = $list->orderBy('important', 'desc')->orderBy('created_at', 'desc')
      ->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image', 'description', 'from', 'to', 'country_id', 'price', 'currency')->paginate(8);
    $key = CACHE_TOUR . '-index-' . $page;
    if (Cache::has($key)) {
      $data = Cache::get($key);
    } else {
      $data = Cache::remember($key, CACHE_TIME, function () {
        $menu = Menu::ofCode('tour')->select('background', 'name', 'name_en', 'name_ch', 'description', 'description_en', 'description_ch')->first();
        //countries
        $countries = Countries::ofStatus(Countries::STATUS_ACTIVE)->select('id', 'name', 'code')->get();
        // balances
        $balances = TourBalance::select('id', 'name')->get();
        $seo = [
          'image' => $menu->background,
          'title' => $menu->name,
          'description' => $menu->description,
        ];
        return [
          'menu' => $menu,
          'countries' => $countries,
          'balances' => $balances,
          'seo' => $seo
        ];
      });
    }
    $data['list'] = $list;
    return view('pages.tour', compact('data'));
  }

  public function cat_tours($cat_alias)
  {
    $page = request('page', '');
    $key = CACHE_TOUR . '-category-' . $cat_alias . '-' . $page;
    $group = TourGroup::ofSlug($cat_alias)->ofStatus(TourGroup::STATUS_ACTIVE)->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image', 'description')->firstOrFail();
    CheckViewSession("_tour_group_$group->id", $group);
    if (Cache::has($key)) {
      $data = Cache::get($key);
    } else {
      $data = Cache::remember($key, CACHE_TIME, function () use ($group) {
        $list = Tour::with('withCountry')->ofStatus(Tour::STATUS_ACTIVE)
          ->where(function ($q) use ($group) {
            $q->groupId($group->id)
              ->orWhereHas('groups', function ($q1) use ($group) {
                $q1->groupId($group->id);
              });
          })
          ->orderBy('important', 'desc')->orderBy('created_at', 'desc')
          ->select('id', 'name', 'slug', 'image', 'name_en', 'name_ch', 'description', 'from', 'to', 'country_id', 'price', 'currency')->paginate(8);

        $seo = [
          'image' => $group->image,
          'title' => $group->name,
          'description' => $group->description,
        ];
        return [
          'list' => $list,
          'seo' => $seo,
          'group' => $group
        ];
      });
    }
    return view('pages.cat-tour', compact('data'));
  }

  public function detail($alias)
  {
    $key = CACHE_TOUR . '-detail-' . $alias;
    $tour = Tour::with('group', 'schedules', 'schedules.details')->ofSlug($alias)->ofStatus(Tour::STATUS_ACTIVE)->firstOrFail();
    CheckViewSession("_tour_$tour->id", $tour);
    if (Cache::has($key)) {
      $data = Cache::get($key);
    } else {
      $data = Cache::remember($key, CACHE_TIME, function () use ($tour) {
        $menu = Menu::ofCode('tour')->select('background', 'name', 'name_en', 'name_ch', 'description', 'description_en', 'description_ch')->first();
        $images = Library::type(Library::TYPE_TOUR)->ofStatus(Library::STATUS_ACTIVE)
          ->groupId($tour->id)->select('id', 'name', 'name_en', 'name_ch', 'image')->get();
        $seo = [
          'image' => $tour->image,
          'title' => $tour->name,
          'description' => $tour->description,
          'keywords' => $tour->tags ? implode(', ', json_decode($tour->tags)) : ''
        ];
        return [
          'menu' => $menu,
          'images' => $images,
          'tour' => $tour,
          'seo' => $seo,
        ];
      });
    }
    return view('pages.single-tour', compact('data'));
  }

  public function calendar()
  {
    $key = CACHE_TOUR . '-calendar';
    if (Cache::has($key)) {
      $data = Cache::get($key);
    } else {
      $data = Cache::remember($key, CACHE_TIME, function () {
        $calendars = TourCalendar::with('tour', 'tour.withCountry')->ofDisplay(true)->whereDate('end', '>=', date('Y-m-d'))
          ->orderBy('start', 'asc')->orderBy('created_at', 'desc')->limit(6)->get();
        $list = TourCalendar::with('tour')->ofDisplay(true)
          ->orderBy('start', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        $menu = Menu::ofCode('calendar')->select('background', 'name', 'name_en', 'name_ch', 'description', 'description_en', 'description_ch')->first();
        $seo = [
          'image' => $menu->background,
          'title' => $menu->name,
          'description' => $menu->description,
        ];
        return [
          'seo' => $seo,
          'calendars' => $calendars,
          'list' => $list,
          'menu' => $menu,
        ];
      });
    }
    return view('pages.tour_calendar.index', compact('data'));
  }
}

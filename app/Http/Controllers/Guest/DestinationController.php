<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationGroup;
use App\Models\Menu;
use App\Models\QaGroup;
use App\Models\Review;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;

class DestinationController extends Controller
{

    public function index()
    {
        $page = request('page', '');
        $key = CACHE_DESTINATION . '-index-' . $page;
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () {
                $locals = Destination::ofStatus(Destination::STATUS_ACTIVE)->ofType(Destination::TYPE_LOCAL)
                    ->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'slug', 'name', 'name_en', 'name_ch', 'image', 'address', 'group_id')->paginate(8);
                $menu = Menu::ofCode('destination')->first();
                $nationals = Destination::ofStatus(Destination::STATUS_ACTIVE)->ofType(Destination::TYPE_NATIONAL)
                    ->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'slug', 'name', 'name_en', 'name_ch', 'image')->get();

                // faq
                $faq_group = QaGroup::with('qas')->ofStatus(QaGroup::STATUS_ACTIVE)->ofImportant(1)->first();
                $seo = [
                    'image' => $menu->background,
                    'title' => $menu->name,
                    'description' => $menu->description,
                ];
                return [
                    'menu' => $menu,
                    'nationals' => $nationals,
                    'faq_group' => $faq_group,
                    'seo' => $seo,
                    'locals' => $locals
                ];
            });
        }
        return view('pages.destination', compact('data'));
    }

    public function cat_destinations($cat_alias)
    {
        $page = request('page', '');
        $key = CACHE_DESTINATION . '-category-' . $page . '-' . $cat_alias;
        $group = DestinationGroup::ofSlug($cat_alias)->ofStatus(DestinationGroup::STATUS_ACTIVE)->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image', 'description')->firstOrFail();
        CheckViewSession("_destination_group_$group->id", $group);
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () use ($group) {
                $list = Destination::groupId($group->id)->ofStatus(Destination::STATUS_ACTIVE)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image', 'description')->paginate(6);
                $seo = [
                    'image' => $group->image,
                    'title' => $group->name,
                    'description' => $group->description,
                ];
                return [
                    'list' => $list,
                    'group' => $group,
                    'seo' => $seo
                ];
            });
        }
        return view('pages.cat-destination', compact('data'));
    }

    public function detail($alias)
    {
        $key = CACHE_DESTINATION . '-detail-' . $alias;
        $destination = Destination::with('group')->ofSlug($alias)->ofStatus(Destination::STATUS_ACTIVE)
            ->firstOrFail();
        CheckViewSession("_destination_$destination->id", $destination);
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () use ($destination) {
                $menu = Menu::ofCode('destination')->select('background', 'name', 'name_en', 'name_ch', 'description', 'description_en', 'description_ch')->first();
                $reviews = $reviews1 = $reviews2 = null;
                if ($destination->type == Destination::TYPE_NATIONAL) {
                    $reviews = Review::destinationId($destination->id)->ofStatus(Review::STATUS_ACTIVE)->orderBy('created_at', 'desc')->select('id', 'name', 'content', 'user_name', 'user_avatar')->limit(4)->get();
                    $reviews1 = $reviews ? $reviews->slice(0, 2) : null;
                    $reviews2 = $reviews ? $reviews->slice(2, 3) : null;
                }

                $other = Destination::where('id', '<>', $destination->id)->groupId($destination->group_id)->ofStatus(Destination::STATUS_ACTIVE)
                    ->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->limit(3)->select('id', 'slug', 'name', 'image', 'description')
                    ->get();

                $tour_ids = $destination->tours ? json_decode($destination->tours) : [];
                $tours = Tour::whereIn('id', $tour_ids)->ofStatus(Tour::STATUS_ACTIVE)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image', 'description', 'price')->limit(6)->get();

                $seo = [
                    'image' => $destination->image,
                    'title' => $destination->name,
                    'description' => $destination->description,
                    'keywords' => $destination->tags ? implode(', ', json_decode($destination->tags)) : ''
                ];
                return [
                    'menu' => $menu,
                    'reviews1' => $reviews1,
                    'reviews2' => $reviews2,
                    'other' => $other,
                    'tours' => $tours,
                    'destination' => $destination,
                    'seo' => $seo,
                ];
            });
        }
        if ($destination && $destination->type == DestinationGroup::TYPE_NATIONAL) {
            return view('pages.single-destination', compact('data'));
        } else {
            return view('pages.single-destination-local', compact('data'));
        }
    }
}

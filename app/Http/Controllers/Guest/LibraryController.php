<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\LibraryGroup;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class LibraryController extends Controller
{

    public function index()
    {
        $page = request('page', '');
        $key = CACHE_LIBRARY . '-index-' . $page;
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () {
                $menu = Menu::ofCode('library')->select('background', 'name', 'name_en', 'name_ch', 'description', 'description_en', 'description_ch')->first();
                $list = LibraryGroup::ofStatus(LibraryGroup::STATUS_ACTIVE)
                    ->orderBy('important', 'desc')->orderBy('numering', 'desc')->orderBy('created_at', 'desc')
                    ->select('slug', 'image', 'name_en', 'name_ch', 'name')->paginate(6);
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
        return view('pages.gallery', compact('data'));
    }

    public function detail($alias)
    {
        $page = request('page', '');
        $key = CACHE_LIBRARY . '-detail-' . $page . '-' . $alias;
        $group = LibraryGroup::ofSlug($alias)->ofStatus(LibraryGroup::STATUS_ACTIVE)->firstOrFail();
        CheckViewSession("_library_group_$group->id", $group);
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () use ($group) {
                $menu = Menu::ofCode('library')->select('background', 'name', 'name_en', 'name_ch', 'description', 'description_en', 'description_ch')->first();
                $list = Library::groupId($group->id)->type(Library::TYPE_LIBRARY)->ofStatus(Library::STATUS_ACTIVE)
                    ->orderBy('important', 'desc')->orderBy('numering', 'desc')->orderBy('created_at', 'desc')
                    ->select('id', 'image', 'name', 'name_en', 'name_ch')->paginate(9);

                $seo = [
                    'image' => $group->image,
                    'title' => $group->name,
                    'description' => $group->description,
                ];
                return [
                    'menu' => $menu,
                    'list' => $list,
                    'seo' => $seo,
                    'group' => $group
                ];
            });
        }
        return view('pages.single-gallery', compact('data'));
    }
}

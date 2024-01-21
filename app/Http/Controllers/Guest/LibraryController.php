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
        if (Cache::has(CACHE_LIBRARY)) {
            $data = Cache::get(CACHE_LIBRARY);
        } else {
            $data = Cache::remember(CACHE_LIBRARY, CACHE_TIME, function () {
                $menu = Menu::ofCode('library')->first();
                $list = LibraryGroup::ofStatus(LibraryGroup::STATUS_ACTIVE)
                    ->orderBy('important', 'desc')->orderBy('created_at', 'desc')->paginate(6);
                return [
                    'menu' => $menu,
                    'list' => $list
                ];
            });
        }
        return view('pages.gallery', compact('data'));
    }

    public function detail($alias)
    {
        $group = LibraryGroup::ofSlug($alias)->ofStatus(LibraryGroup::STATUS_ACTIVE)->firstOrFail();
        if (Cache::has(CACHE_LIBRARY . '-' . $group->id)) {
            $data = Cache::get(CACHE_LIBRARY . '-' . $group->id);
        } else {
            $data = Cache::remember(CACHE_LIBRARY . '-' . $group->id, CACHE_TIME, function () use ($group) {
                $menu = Menu::ofCode('library')->first();
                $list = Library::groupId($group->id)->ofStatus(Library::STATUS_ACTIVE)
                    ->orderBy('important', 'desc')->orderBy('created_at', 'desc')->paginate(8);
                return [
                    'menu' => $menu,
                    'list' => $list
                ];
            });
        }
        $data['group'] = $group;
        return view('pages.single-gallery', compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LibraryGroup\LibraryGroupDeleteRequest;
use App\Http\Requests\User\LibraryGroup\LibraryGroupInsertRequest;
use App\Http\Requests\User\LibraryGroup\LibraryGroupUpdateRequest;
use App\Http\Requests\User\LibraryGroup\LibraryGroupViewRequest;
use App\Models\LibraryGroup;
use Illuminate\Support\Facades\DB;

class LibraryGroupController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/library_group';
    }

    /**
     * Display the library group index page.
     *
     * @param LibraryGroupViewRequest $request
     * @return void
     */
    public function index(LibraryGroupViewRequest $request)
    {
        $list = LibraryGroup::query();
        $data = [
            'status' => LibraryGroup::get_status(),
            'important' => LibraryGroup::get_important(),
            'seasons' => LibraryGroup::get_season(),
            // tổng danh mục
            'total' => $list->clone()->count(),
            // tổng hot
            'hot' => $list->clone()->ofHot(1)->count(),
            // tổng là của khách
            'guest' => $list->clone()->ofGuest(1)->count(),
            'total_mua_xua' => $list->clone()->ofSeason(LibraryGroup::SEASON_XUAN)->count(),
            'total_mua_ha' => $list->clone()->ofSeason(LibraryGroup::SEASON_HA)->count(),
            'total_mua_thu' => $list->clone()->ofSeason(LibraryGroup::SEASON_THU)->count(),
            'total_mua_dong' => $list->clone()->ofSeason(LibraryGroup::SEASON_DONG)->count(),
        ];
        return view('user.pages.library.group.index', compact('data'));
    }

    /**
     * Display a listing of the library groups.
     *
     * @param LibraryGroupViewRequest $request
     * @return void
     */
    public function list(LibraryGroupViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');
            $important = request('important', '');
            $guest = request('guest', '');
            $hot = request('hot', '');
            $tour_group_id = request('tour_group_id', '');
            $season = request('season', '');

            $list = LibraryGroup::withCount('libraries');
            $list = $tour_group_id != '' ? $list->tourGroupId($tour_group_id) : $list;
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $important != '' ? $list->ofImportant($important) : $list;
            $list = $guest != '' ? $list->ofGuest($guest) : $list;
            $list = $hot != '' ? $list->ofHot($hot) : $list;
            $list = $season != '' ? $list->ofSeason($season) : $list;
            $list = $list->orderBy('numering', 'desc')->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.library.group.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    /**
     * Insert a new library group.
     *
     * @param LibraryGroupInsertRequest $request
     * @return void
     */
    public function insert(LibraryGroupInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('background')) {
                $file = request()->file('background');
                $data['background'] = store_file($file, $this->dir, false, 1500);
            }
            $data['important'] = isset($data['important']) && $data['important'] == LibraryGroup::IMPORTANT ? LibraryGroup::IMPORTANT : LibraryGroup::NONE_IMPORTANT;
            $data['guest'] = isset($data['guest']) && $data['guest'] == LibraryGroup::GUEST ? LibraryGroup::GUEST : LibraryGroup::NONE_GUEST;
            $data['hot'] = isset($data['hot']) && $data['hot'] == LibraryGroup::HOT ? LibraryGroup::HOT : LibraryGroup::NONE_HOT;
            $new = LibraryGroup::create($data);
            save_log("Danh mục thư viện #$new->name vừa mới được tạo", $data);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Tạo mới thành công',
                'type' => 'success',
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xãy ra!',
                'type' => 'error',
            ]);
        }
    }

    /**
     * Update an existing library group.
     *
     * @param LibraryGroupUpdateRequest $request
     * @return void
     */
    public function update(LibraryGroupUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['important'] = isset($data['important']) && $data['important'] == LibraryGroup::IMPORTANT ? LibraryGroup::IMPORTANT : LibraryGroup::NONE_IMPORTANT;
            $data['guest'] = isset($data['guest']) && $data['guest'] == LibraryGroup::GUEST ? LibraryGroup::GUEST : LibraryGroup::NONE_GUEST;
            $data['hot'] = isset($data['hot']) && $data['hot'] == LibraryGroup::HOT ? LibraryGroup::HOT : LibraryGroup::NONE_HOT;
            $data['status'] = isset($data['status']) && $data['status'] == LibraryGroup::STATUS_ACTIVE ? LibraryGroup::STATUS_ACTIVE : LibraryGroup::STATUS_BLOCKED;
            $new = LibraryGroup::findOrFail(request('id'));
            if (request()->hasFile('image')) {
                delete_file($new->image);
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('background')) {
                delete_file($new->background);
                $file = request()->file('background');
                $data['background'] = store_file($file, $this->dir, false, 1500);
            }
            $new->update($data);
            save_log("Danh mục thư viện #$new->name vừa mới được cập nhật", $data);
            DB::commit();
            if (request()->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Cập nhật thành công',
                    'type' => 'success',
                ]);
            }
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            if (request()->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Có lỗi xãy ra!',
                    'type' => 'error',
                ]);
            }
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    /**
     * Delete an existing library group.
     *
     * @param LibraryGroupDeleteRequest $request
     * @return void
     */
    public function delete(LibraryGroupDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = LibraryGroup::withCount('libraries')->findOrFail(request('id'));
            if ($new->libraries_count == 0) {
                $new->delete();
                save_log("Danh mục thư viện #$new->name vừa mới bị xóa", $new);
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Xóa thành công',
                    'type' => 'success',
                ]);
            }
        } catch (\Throwable $th) {
            showLog($th);
        }
        DB::rollBack();
        return response()->json([
            'status' => false,
            'message' => 'Có lỗi xãy ra!',
            'type' => 'error',
        ]);
    }

    /**
     * View details of a library group.
     *
     * @param [type] $id
     * @param LibraryGroupViewRequest $request
     * @return void
     */
    public function detail($id, LibraryGroupViewRequest $request)
    {
        $data = LibraryGroup::withCount('libraries')->findOrFail($id);
        $seasons = LibraryGroup::get_season();
        if (request()->ajax()) {
            return view('user.pages.library.group.show', compact('data', 'seasons'))->render();
        }
        $status = LibraryGroup::get_status($data->status);
        return view('user.pages.library.group.detail', compact('data', 'seasons', 'status'));
    }
}

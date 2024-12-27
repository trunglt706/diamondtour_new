<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Tour\TourDeleteRequest;
use App\Http\Requests\User\Tour\TourInsertRequest;
use App\Http\Requests\User\Tour\TourUpdateRequest;
use App\Http\Requests\User\Tour\TourViewRequest;
use App\Models\Library;
use App\Models\Schedule;
use App\Models\Tour;
use App\Models\TourGroupDetail;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/tour';
    }

    public function index(TourViewRequest $request)
    {
        $tours = Tour::query();
        $data = [
            'status' => Tour::get_status(),
            'seasons' => Tour::get_season(),
            'total_tours' => $tours->clone()->ofType(Tour::IS_TOUR)->count(),
            'total_landtours' => $tours->clone()->ofType(Tour::IS_LANDTOUR)->count(),
            'total_designs' => $tours->clone()->ofDesign(Tour::IS_DESIGN)->count(),
            'total_bundle1' => $tours->clone()->ofBundle(1)->count(),
            'total_bundle2' => $tours->clone()->ofBundle(2)->count(),
            'total_bundle3' => $tours->clone()->ofBundle(3)->count(),
            'total_mua_xua' => $tours->clone()->ofSeason(Tour::SEASON_XUAN)->count(),
            'total_mua_ha' => $tours->clone()->ofSeason(Tour::SEASON_HA)->count(),
            'total_mua_thu' => $tours->clone()->ofSeason(Tour::SEASON_THU)->count(),
            'total_mua_dong' => $tours->clone()->ofSeason(Tour::SEASON_DONG)->count(),
        ];
        return view('user.pages.tour.index', compact('data'));
    }

    public function list(TourViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');
            $group_id = request('group_id', '');
            $country_id = request('country_id', '');
            $province_id = request('province_id', '');
            $important = request('important', '');
            $type = request('type', '');
            $season = request('season', '');

            $list = Tour::with('withCountry');
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $group_id != '' ? $list->groupId($group_id) : $list;
            $list = $country_id != '' ? $list->countryId($country_id) : $list;
            $list = $province_id != '' ? $list->provinceId($province_id) : $list;
            $list = $important != '' ? $list->ofImportant($important) : $list;
            $list = $season != '' ? $list->ofSeason($season) : $list;
            $list = $list->orderBy('important', 'desc')->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(TourInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('location_img')) {
                $file = request()->file('location_img');
                $data['location_img'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('background')) {
                $file = request()->file('background');
                $data['background'] = store_file($file, $this->dir, false, 1500);
            }
            if (request()->hasFile('images')) {
                $album = [];
                foreach (request()->file('images') as $file) {
                    array_push($album, store_file($file, $this->dir, false, 1500));
                }
                $data['images'] = json_encode($album);
            }
            $data['tags'] = isset($data['tags']) ? json_encode(explode(',', $data['tags'])) : json_encode([]);
            // $data['important'] = isset($data['important']) && $data['important'] == 1 ? 1 : 0;
            $new = Tour::create($data);
            if (isset($data['group_ids'])) {
                foreach ($data['group_ids'] as $id) {
                    TourGroupDetail::firstOrCreate([
                        'tour_id' => $new->id,
                        'group_id' => $id,
                    ]);
                }
            }
            save_log("Tour #$new->name vừa mới được tạo", $data);
            DB::commit();
            if (request()->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Tạo mới thành công',
                    'type' => 'success',
                ]);
            }
            return redirect()->back()->with('success', 'Tạo mới thành công');
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

    public function update(TourUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Tour::findOrFail(request('id'));
            if (request()->hasFile('image')) {
                delete_file($new->image);
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('location_img')) {
                delete_file($new->location_img);
                $file = request()->file('location_img');
                $data['location_img'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('background')) {
                delete_file($new->background);
                $file = request()->file('background');
                $data['background'] = store_file($file, $this->dir, false, 1500);
            }
            if (request()->hasFile('images')) {
                $album = [];
                foreach (request()->file('images') as $file) {
                    array_push($album, store_file($file, $this->dir, false, 1500));
                }
                $old_album = $new->album ? json_decode($new->album) : [];
                foreach ($old_album as $old) {
                    delete_file($old);
                }
                $data['images'] = json_encode($album);
            }
            $data['tags'] = isset($data['tags']) ? json_encode(explode(',', $data['tags'])) : json_encode([]);
            // $data['important'] = isset($data['important']) && $data['important'] == 1 ? 1 : 0;
            $new->update($data);

            if (isset($data['group_ids'])) {
                foreach ($data['group_ids'] as $id) {
                    TourGroupDetail::firstOrCreate([
                        'tour_id' => $new->id,
                        'group_id' => $id,
                    ]);
                }
                TourGroupDetail::tourId($new->id)->whereNotIn('group_id', $data['group_ids'])->delete();
            }
            save_log("Tour #$new->name vừa mới được cập nhật", $data);
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

    public function delete(TourDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Tour::findOrFail(request('id'));
            $new->delete();
            save_log("Tour #$new->name vừa mới bị xóa", $new);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Xóa thành công',
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

    public function detail($id, TourViewRequest $request)
    {
        $data = Tour::findOrFail($id);
        $report = [
            'albums' => Library::type(Library::TYPE_TOUR)->groupId($data->id)->count(),
            'schedules' => Schedule::tourId($data->id)->count(),
        ];
        return view('user.pages.tour.detail', compact('data', 'report'));
    }

    public function edit($id, TourViewRequest $request)
    {
        $data = Tour::with('groups', 'groups.group')->findOrFail($id);
        $other = [
            'status' => Tour::get_status(),
            'seasons' => Tour::get_season(),
        ];
        return view('user.pages.tour.edit', compact('data', 'other'));
    }

    public function create()
    {
        $data = [
            'status' => Tour::get_status(),
            'seasons' => Tour::get_season(),
        ];
        return view('user.pages.tour.create', compact('data'));
    }
}

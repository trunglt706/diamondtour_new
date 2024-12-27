<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Destination\DestinationDeleteRequest;
use App\Http\Requests\User\Destination\DestinationInsertRequest;
use App\Http\Requests\User\Destination\DestinationUpdateRequest;
use App\Http\Requests\User\Destination\DestinationViewRequest;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\TourGroup;
use Illuminate\Support\Facades\DB;

class DestinationController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/destination';
    }

    public function index(DestinationViewRequest $request)
    {
        $destinations = Destination::query();
        $data = [
            'status' => Destination::get_status(),
            'type' => Destination::get_type(),
            // tổng điểm đến
            'total' => $destinations->clone()->count(),
            // điểm đến theo quốc gia
            'country' => $destinations->clone()->ofType(Destination::TYPE_NATIONAL)->count(),
            // điểm đến theo khu vực
            'province' => $destinations->clone()->ofType(Destination::TYPE_LOCAL)->count(),
        ];
        return view('user.pages.destination.index', compact('data'));
    }

    public function list(DestinationViewRequest $request)
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
            $tour_group_id = request('tour_group_id', '');

            $list = Destination::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $tour_group_id != '' ? $list->tourGroupId($tour_group_id) : $list;
            $list = $group_id != '' ? $list->groupId($group_id) : $list;
            $list = $province_id != '' ? $list->provinceId($province_id) : $list;
            $list = $important != '' ? $list->ofImportant($important) : $list;
            if ($type != '') {
                $list = $list->ofType($type);
                if ($type == 'local') {
                    $list = $country_id != '' ? $list->countryId($country_id) : $list;
                }
            }
            $list = $list->orderBy('important', 'desc')->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.destination.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(DestinationInsertRequest $request)
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
            if (request()->hasFile('image_description')) {
                $file = request()->file('image_description');
                $data['image_description'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('image_content')) {
                $file = request()->file('image_content');
                $data['image_content'] = store_file($file, $this->dir, false, 900);
            }
            if (isset($data['plan'])) {
                $data['plan'] = json_encode([
                    'content' => $data['plan'],
                    'images' => []
                ]);
            }
            if ($data['type'] == Destination::TYPE_NATIONAL) {
                unset($data['province_id']);
            } else {
                unset($data['country_id']);
                unset($data['tour_group_id']);
            }
            if (request()->hasFile('album')) {
                $album = [];
                foreach (request()->file('album') as $file) {
                    array_push($album, store_file($file, $this->dir, false, 1500));
                }
                $data['album'] = json_encode($album);
            }
            $data['tags'] = isset($data['tags']) ? json_encode(explode(',', $data['tags'])) : json_encode([]);
            $data['tour_group_ids'] = isset($data['tour_group_ids']) ? json_encode($data['tour_group_ids']) : json_encode([]);
            $data['tours'] = isset($data['tours']) ? json_encode($data['tours']) : json_encode([]);
            // $data['important'] = isset($data['important']) && $data['important'] == 1 ? 1 : 0;
            $new = Destination::create($data);
            save_log("Điểm đến #$new->name vừa mới được tạo", $data);
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

    public function update(DestinationUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Destination::findOrFail(request('id'));
            if ($data['type'] == Destination::TYPE_NATIONAL) {
                unset($data['province_id']);
            } else {
                unset($data['country_id']);
                unset($data['tour_group_id']);
            }
            $data['tags'] = isset($data['tags']) ? json_encode(explode(',', $data['tags'])) : json_encode([]);
            $data['tour_group_ids'] = isset($data['tour_group_ids']) ? json_encode($data['tour_group_ids']) : json_encode([]);
            $data['tours'] = isset($data['tours']) ? json_encode($data['tours']) : json_encode([]);
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
            if (request()->hasFile('image_description')) {
                delete_file($new->image_description);
                $file = request()->file('image_description');
                $data['image_description'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('image_content')) {
                delete_file($new->image_content);
                $file = request()->file('image_content');
                $data['image_content'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('album')) {
                $album = [];
                foreach (request()->file('album') as $file) {
                    array_push($album, store_file($file, $this->dir, false, 1500));
                }
                $old_album = $new->album ? json_decode($new->album) : [];
                foreach ($old_album as $old) {
                    delete_file($old);
                }
                $data['album'] = json_encode($album);
            }
            if (isset($data['plan'])) {
                $data['plan'] = json_encode([
                    'content' => $data['plan'],
                    'images' => []
                ]);
            }
            // $data['important'] = isset($data['important']) && $data['important'] == 1 ? 1 : 0;
            $new->update($data);
            save_log("Điểm đến #$new->name vừa mới được cập nhật", $data);
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

    public function updateAlbum()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Destination::findOrFail(request('id'));
            $data = json_decode($new->album, 1);
            $temp = $data[request('draggedIndex')];
            $data[request('draggedIndex')] = $data[request('targetIndex')];
            $data[request('targetIndex')] = $temp;

            $new->album = json_encode($data);
            $new->save();

            save_log("Điểm đến #$new->name vừa mới cập nhật thứ tự của Album", $data);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thành công',
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

    public function delete(DestinationDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Destination::findOrFail(request('id'));
            $new->delete();
            save_log("Điểm đến #$new->name vừa mới bị xóa", $new);
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

    public function detail($id, DestinationViewRequest $request)
    {
        $data = Destination::findOrFail($id);
        $list = null;
        if ($data->type == Destination::TYPE_NATIONAL) {
            $list = Destination::leftJoin('provinces', 'destinations.province_id', '=', 'provinces.id')->ofType(Destination::TYPE_LOCAL)
                ->where('provinces.country_id', $data->country_id)
                ->select('destinations.name', 'destinations.id', 'provinces.name as province_name')->get();
        }
        return view('user.pages.destination.detail', compact('data', 'list'));
    }

    public function edit($id, DestinationViewRequest $request)
    {
        $data = Destination::findOrFail($id);
        $tours = $data->tours ? json_decode($data->tours) : [];
        $tour_groups = $data->tour_group_ids ? json_decode($data->tour_group_ids) : [];
        $other = [
            'status' => Destination::get_status(),
            'type' => Destination::get_type(),
            'tours' => Tour::ofStatus(Tour::STATUS_ACTIVE)->whereIn('id', $tours)->select('id', 'name')->get(),
            'tour_groups' => TourGroup::ofStatus(TourGroup::STATUS_ACTIVE)->whereIn('id', $tour_groups)->select('id', 'name')->get(),
        ];
        return view('user.pages.destination.edit', compact('data', 'other'));
    }

    public function create()
    {
        $data = [
            'status' => Destination::get_status(),
            'type' => Destination::get_type(),
        ];
        return view('user.pages.destination.create', compact('data'));
    }
}

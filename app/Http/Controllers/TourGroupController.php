<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\TourGroup\TourGroupDeleteRequest;
use App\Http\Requests\User\TourGroup\TourGroupInsertRequest;
use App\Http\Requests\User\TourGroup\TourGroupUpdateRequest;
use App\Http\Requests\User\TourGroup\TourGroupViewRequest;
use App\Models\Destination;
use App\Models\LibraryGroup;
use App\Models\Tour;
use App\Models\TourGroup;
use Illuminate\Support\Facades\DB;

class TourGroupController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/tour_group';
    }

    public function index(TourGroupViewRequest $request)
    {
        $data['status'] = TourGroup::get_status();
        return view('user.pages.tour.group.index', compact('data'));
    }

    public function list(TourGroupViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = TourGroup::withCount('tours');
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->orderBy('numering', 'desc')->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.group.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(TourGroupInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $new = TourGroup::create($data);
            save_log("Danh mục tour #$new->name vừa mới được tạo", $data);
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

    public function update(TourGroupUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['status'] = isset($data['status']) && $data['status'] == TourGroup::STATUS_ACTIVE ? TourGroup::STATUS_ACTIVE : TourGroup::STATUS_BLOCKED;
            $new = TourGroup::findOrFail(request('id'));
            if (request()->hasFile('image')) {
                delete_file($new->image);
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $data['status'] = isset($data['status']) && $data['status'] == TourGroup::STATUS_ACTIVE ? TourGroup::STATUS_ACTIVE : TourGroup::STATUS_BLOCKED;
            $new->update($data);
            save_log("Danh mục tour #$new->name vừa mới được cập nhật", $data);
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

    public function delete(TourGroupDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = TourGroup::withCount('tours')->findOrFail(request('id'));
            if ($new && $new->tours_count == 0) {
                $new->delete();
                save_log("Danh mục tour #$new->name vừa mới bị xóa", $new);
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

    public function detail($id, TourGroupViewRequest $request)
    {
        $data = TourGroup::withCount('tours')->findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.tour.group.show', compact('data'));
        }
        $list = Destination::leftJoin('countries', 'destinations.country_id', '=', 'countries.id')
            ->ofType(Destination::TYPE_NATIONAL)->where(function ($q) use ($data) {
                $q->whereJsonContains('tour_group_ids', (string)$data->id)
                    ->orWhere('tour_group_id', $data->id);
            })
            ->select('countries.name as country_name', 'destinations.id', 'destinations.name')->get();

        $group_id = $data->id;
        $report = [
            // tổng số tour
            'total_tours' => Tour::groupId($group_id)->count(),
            // tổng điểm đến quốc gia
            'total_destinations' => $list->count(),
            // tổng danh mục thư viện ảnh
            'total_albums' => LibraryGroup::tourGroupId($group_id)->count(),
        ];
        return view('user.pages.tour.group.detail', compact('data', 'list', 'report'));
    }
}

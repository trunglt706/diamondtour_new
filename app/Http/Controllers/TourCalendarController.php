<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourCalendar\TourCalendarCreateRequest;
use App\Http\Requests\TourCalendar\TourCalendarDeleteRequest;
use App\Http\Requests\TourCalendar\TourCalendarUpdateRequest;
use App\Http\Requests\TourCalendar\TourCalendarViewRequest;
use App\Models\TourCalendar;
use Illuminate\Support\Facades\DB;

class TourCalendarController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function index(TourCalendarViewRequest $request)
    {
        $data['status'] = TourCalendar::get_status();
        return view('user.pages.tour.calendar.index', compact('data'));
    }

    public function list(TourCalendarViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');
            $tour_id = request('tour_id', '');

            $list = TourCalendar::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $tour_id != '' ? $list->tourId($tour_id) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.calendar.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(TourCalendarCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['status'] = isset($data['status']) && $data['status'] == TourCalendar::STATUS_ACTIVE ? TourCalendar::STATUS_ACTIVE : TourCalendar::STATUS_BLOCKED;
            $data['display'] = isset($data['display']) && $data['display'] == 1 ? 1 : 0;
            $new = TourCalendar::create($data);
            save_log("Lịch khởi hành #$new->name vừa mới được tạo", $data);
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

    public function update(TourCalendarUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourCalendar::findOrFail(request('id'));
            $data['status'] = isset($data['status']) && $data['status'] == TourCalendar::STATUS_ACTIVE ? TourCalendar::STATUS_ACTIVE : TourCalendar::STATUS_BLOCKED;
            $data['display'] = isset($data['display']) && $data['display'] == 1 ? 1 : 0;
            $new->update($data);
            save_log("Lịch khởi hành #$new->name vừa mới được cập nhật", $data);
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

    public function delete(TourCalendarDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = TourCalendar::findOrFail(request('id'));
            $new->delete();
            save_log("Lịch khởi hành #$new->name vừa mới bị xóa", $new);
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

    public function detail($id, TourCalendarViewRequest $request)
    {
        $data = TourCalendar::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.tour.calendar.show', compact('data'));
        }
        return view('user.pages.tour.calendar.detail', compact('data'));
    }
}

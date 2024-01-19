<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Schedule\ScheduleDeleteRequest;
use App\Http\Requests\User\Schedule\ScheduleInsertRequest;
use App\Http\Requests\User\Schedule\ScheduleUpdateRequest;
use App\Http\Requests\User\Schedule\ScheduleViewRequest;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function index(ScheduleViewRequest $request)
    {
        return view('user.pages.tour.schedule.index');
    }

    public function list(ScheduleViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');
            $tour_id = request('tour_id', '');

            $list = Schedule::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $tour_id != '' ? $list->tourId($tour_id) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.schedule.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(ScheduleInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Schedule::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(ScheduleUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Schedule::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(ScheduleDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Schedule::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, ScheduleViewRequest $request)
    {
        $data = Schedule::findOrFail($id);
        return view('user.pages.tour.schedule.detail', compact('data'));
    }
}

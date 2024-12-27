<?php

namespace App\Http\Controllers;

use App\Models\ScheduleDetal;
use Illuminate\Support\Facades\DB;

class ScheduleDetailController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function list()
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');
            $schedule_id = request('schedule_id', 0);

            $list = ScheduleDetal::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $schedule_id != '' ? $list->scheduleId($schedule_id) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.schedule.detail.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = ScheduleDetal::create($data);
            save_log("Chi tiết lịch trình #$new->name vừa mới được tạo", $data);
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

    public function update()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = ScheduleDetal::findOrFail(request('id'));
            $new->update($data);
            save_log("Chi tiết lịch trình #$new->name vừa mới được cập nhật", $data);
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

    public function delete()
    {
        DB::beginTransaction();
        try {
            $new = ScheduleDetal::findOrFail(request('id'));
            $new->delete();
            save_log("Chi tiết lịch trình #$new->name vừa mới bị xóa", $new);
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

    public function detail($id)
    {
        $data = ScheduleDetal::findOrFail($id);
        return view('user.pages.tour.schedule.detail.show', compact('data'))->render();
    }
}

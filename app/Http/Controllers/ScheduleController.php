<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Schedule\ScheduleDeleteRequest;
use App\Http\Requests\User\Schedule\ScheduleInsertRequest;
use App\Http\Requests\User\Schedule\ScheduleUpdateRequest;
use App\Http\Requests\User\Schedule\ScheduleViewRequest;
use App\Models\Schedule;
use App\Models\ScheduleDetal;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/schedule';
    }

    /**
     * Display the index page of the resource.
     *
     * @param ScheduleViewRequest $request
     * @return void
     */
    public function index(ScheduleViewRequest $request)
    {
        $id = request('id', 0);
        $data = [
            'status' => Schedule::get_status(),
            'tour' => Tour::select('id', 'name')->find($id),
        ];
        return view('user.pages.tour.schedule.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param ScheduleViewRequest $request
     * @return void
     */
    public function list(ScheduleViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');
            $tour_id = request('tour_id', 0);

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

    /**
     * Insert a newly created resource in storage.
     *
     * @param ScheduleInsertRequest $request
     * @return void
     */
    public function insert(ScheduleInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $new = Schedule::create($data);
            save_log("Lịch trình #$new->name vừa mới được tạo", $data);
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
     * Update the specified resource in storage.
     *
     * @param ScheduleUpdateRequest $request
     * @return void
     */
    public function update(ScheduleUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Schedule::findOrFail(request('id'));
            if (request()->hasFile('image')) {
                delete_file($new->image);
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $new->update($data);
            save_log("Lịch trình #$new->name vừa mới được cập nhật", $data);
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
     * Remove the specified resource from storage.
     *
     * @param ScheduleDeleteRequest $request
     * @return void
     */
    public function delete(ScheduleDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Schedule::findOrFail(request('id'));
            $new->delete();
            save_log("Lịch trình #$new->name vừa mới bị xóa", $new);
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

    /**
     * Display the specified resource.
     *
     * @param [type] $id
     * @param ScheduleViewRequest $request
     * @return void
     */
    public function detail($id, ScheduleViewRequest $request)
    {
        $data = Schedule::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.tour.schedule.show', compact('data'));
        }
        $status = Schedule::get_status($data->status);
        $status_detail = ScheduleDetal::get_status();
        return view('user.pages.tour.schedule.detail', compact('data', 'status', 'status_detail'));
    }
}

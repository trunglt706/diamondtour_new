<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourService\TourServiceDeleteRequest;
use App\Http\Requests\TourService\TourServiceInsertRequest;
use App\Http\Requests\TourService\TourServiceUpdateRequest;
use App\Http\Requests\TourService\TourServiceViewRequest;
use App\Models\TourService;
use Illuminate\Support\Facades\DB;

class TourServiceController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function index(TourServiceViewRequest $request)
    {
        $data['status'] = TourService::get_status();
        return view('user.pages.tour.service.index', compact('data'));
    }

    public function list(TourServiceViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = TourService::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.service.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(TourServiceInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourService::create($data);
            save_log("Dịch vụ tour #$new->name vừa mới được tạo", $data);
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

    public function update(TourServiceUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourService::findOrFail(request('id'));
            $data['status'] = isset($data['status']) && $data['status'] == TourService::STATUS_ACTIVE ? TourService::STATUS_ACTIVE : TourService::STATUS_BLOCKED;
            $new->update($data);
            save_log("Dịch vụ tour #$new->name vừa mới được cập nhật", $data);
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

    public function delete(TourServiceDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = TourService::findOrFail(request('id'));
            $new->delete();
            save_log("Dịch vụ tour #$new->name vừa mới bị xóa", $new);
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

    public function detail($id, TourServiceViewRequest $request)
    {
        $data = TourService::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.tour.service.show', compact('data'))->render();
        }
        return view('user.pages.tour.service.detail', compact('data'));
    }
}

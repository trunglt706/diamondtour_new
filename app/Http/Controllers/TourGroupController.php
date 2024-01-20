<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\TourGroup\TourGroupDeleteRequest;
use App\Http\Requests\User\TourGroup\TourGroupInsertRequest;
use App\Http\Requests\User\TourGroup\TourGroupUpdateRequest;
use App\Http\Requests\User\TourGroup\TourGroupViewRequest;
use App\Models\TourGroup;
use Illuminate\Support\Facades\DB;

class TourGroupController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
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

            $list = TourGroup::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
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
            $new = TourGroup::create($data);
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
            $new = TourGroup::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(TourGroupDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = TourGroup::findOrFail(request('id'));
            $new->delete();
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

    public function detail($id, TourGroupViewRequest $request)
    {
        $data = TourGroup::findOrFail($id);
        return view('user.pages.tour.group.detail', compact('data'));
    }
}

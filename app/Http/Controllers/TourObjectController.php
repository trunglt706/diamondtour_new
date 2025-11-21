<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourObject\TourObjectDeleteRequest;
use App\Http\Requests\TourObject\TourObjectInsertRequest;
use App\Http\Requests\TourObject\TourObjectUpdateRequest;
use App\Http\Requests\TourObject\TourObjectViewRequest;
use App\Models\TourObject;
use Illuminate\Support\Facades\DB;

class TourObjectController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    /**
     * Display the index page of the resource.
     *
     * @param TourObjectViewRequest $request
     * @return void
     */
    public function index(TourObjectViewRequest $request)
    {
        $data['status'] = TourObject::get_status();
        return view('user.pages.tour.object.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param TourObjectViewRequest $request
     * @return void
     */
    public function list(TourObjectViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');

            $list = TourObject::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.object.table', compact('list'))->render(),
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
     * Store a newly created resource in storage.
     *
     * @param TourObjectInsertRequest $request
     * @return void
     */
    public function insert(TourObjectInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourObject::create($data);
            save_log("Đối tượng đi cùng tour #$new->name vừa mới được tạo", $data);
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
     * @param TourObjectUpdateRequest $request
     * @return void
     */
    public function update(TourObjectUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourObject::findOrFail(request('id'));
            $data['status'] = isset($data['status']) && $data['status'] == TourObject::STATUS_ACTIVE ? TourObject::STATUS_ACTIVE : TourObject::STATUS_BLOCKED;
            $new->update($data);
            save_log("Đối tượng đi cùng tour #$new->name vừa mới được cập nhật", $data);
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
     * @param TourObjectDeleteRequest $request
     * @return void
     */
    public function delete(TourObjectDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = TourObject::findOrFail(request('id'));
            $new->delete();
            save_log("Đối tượng đi cùng tour #$new->name vừa mới bị xóa", $new);
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
     * @param TourObjectViewRequest $request
     * @return void
     */
    public function detail($id, TourObjectViewRequest $request)
    {
        $data = TourObject::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.tour.object.show', compact('data'))->render();
        }
        return view('user.pages.tour.object.detail', compact('data'));
    }
}

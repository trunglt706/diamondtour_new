<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourAge\TourAgeDeleteRequest;
use App\Http\Requests\TourAge\TourAgeInsertRequest;
use App\Http\Requests\TourAge\TourAgeUpdateRequest;
use App\Http\Requests\TourAge\TourAgeViewRequest;
use App\Models\TourAge;
use Illuminate\Support\Facades\DB;

class TourAgeController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    /**
     * Display the index page of the resource.
     *
     * @param TourAgeViewRequest $request
     * @return void
     */
    public function index(TourAgeViewRequest $request)
    {
        $data['status'] = TourAge::get_status();
        return view('user.pages.tour.age.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param TourAgeViewRequest $request
     * @return void
     */
    public function list(TourAgeViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');

            $list = TourAge::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.age.table', compact('list'))->render(),
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
     * @param TourAgeInsertRequest $request
     * @return void
     */
    public function insert(TourAgeInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourAge::create($data);
            save_log("Độ tuổi #$new->name vừa mới được tạo", $data);
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
     * @param TourAgeUpdateRequest $request
     * @return void
     */
    public function update(TourAgeUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourAge::findOrFail(request('id'));
            $data['status'] = isset($data['status']) && $data['status'] == TourAge::STATUS_ACTIVE ? TourAge::STATUS_ACTIVE : TourAge::STATUS_BLOCKED;
            $new->update($data);
            save_log("Độ tuổi #$new->name vừa mới được cập nhật", $data);
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
     * @param TourAgeDeleteRequest $request
     * @return void
     */
    public function delete(TourAgeDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = TourAge::findOrFail(request('id'));
            $new->delete();
            save_log("Độ tuổi #$new->name vừa mới bị xóa", $new);
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
     * @param TourAgeViewRequest $request
     * @return void
     */
    public function detail($id, TourAgeViewRequest $request)
    {
        $data = TourAge::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.tour.age.show', compact('data'));
        }
        return view('user.pages.tour.age.detail', compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourStyle\TourStyleCreateRequest;
use App\Http\Requests\TourStyle\TourStyleDeleteRequest;
use App\Http\Requests\TourStyle\TourStyleUpdateRequest;
use App\Http\Requests\TourStyle\TourStyleViewRequest;
use App\Models\TourStyle;
use Illuminate\Support\Facades\DB;

class TourStyleController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    /**
     * Display the index page of the resource.
     *
     * @param TourStyleViewRequest $request
     * @return void
     */
    public function index(TourStyleViewRequest $request)
    {
        $data['status'] = TourStyle::get_status();
        return view('user.pages.tour.style.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param TourStyleViewRequest $request
     * @return void
     */
    public function list(TourStyleViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');

            $list = TourStyle::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.style.table', compact('list'))->render(),
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
     * @param TourStyleCreateRequest $request
     * @return void
     */
    public function insert(TourStyleCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourStyle::create($data);
            save_log("Phong cách tour #$new->name vừa mới được tạo", $data);
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
     * @param TourStyleUpdateRequest $request
     * @return void
     */
    public function update(TourStyleUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourStyle::findOrFail(request('id'));
            $data['status'] = isset($data['status']) && $data['status'] == TourStyle::STATUS_ACTIVE ? TourStyle::STATUS_ACTIVE : TourStyle::STATUS_BLOCKED;
            $new->update($data);
            save_log("Phong cách tour #$new->name vừa mới được cập nhật", $data);
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
     * @param TourStyleDeleteRequest $request
     * @return void
     */
    public function delete(TourStyleDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = TourStyle::findOrFail(request('id'));
            $new->delete();
            save_log("Phong cách tour #$new->name vừa mới bị xóa", $new);
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
     * @param TourStyleViewRequest $request
     * @return void
     */
    public function detail($id, TourStyleViewRequest $request)
    {
        $data = TourStyle::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.tour.style.show', compact('data'))->render();
        }
        return view('user.pages.tour.style.detail', compact('data'));
    }
}

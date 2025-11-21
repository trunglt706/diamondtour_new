<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourBalance\TourBalanceDeleteRequest;
use App\Http\Requests\TourBalance\TourBalanceInsertRequest;
use App\Http\Requests\TourBalance\TourBalanceUpdateRequest;
use App\Http\Requests\TourBalance\TourBalanceViewRequest;
use App\Models\TourBalance;
use Illuminate\Support\Facades\DB;

class TourBalanaceController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    /**
     * Display the index page of the resource.
     *
     * @param TourBalanceViewRequest $request
     * @return void
     */
    public function index(TourBalanceViewRequest $request)
    {
        $data['status'] = TourBalance::get_status();
        return view('user.pages.tour.balance.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param TourBalanceViewRequest $request
     * @return void
     */
    public function list(TourBalanceViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');

            $list = TourBalance::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.balance.table', compact('list'))->render(),
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
     * @param TourBalanceInsertRequest $request
     * @return void
     */
    public function insert(TourBalanceInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourBalance::create($data);
            save_log("Ngân sách #$new->name vừa mới được tạo", $data);
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
     * @param TourBalanceUpdateRequest $request
     * @return void
     */
    public function update(TourBalanceUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourBalance::findOrFail(request('id'));
            $data['status'] = isset($data['status']) && $data['status'] == TourBalance::STATUS_ACTIVE ? TourBalance::STATUS_ACTIVE : TourBalance::STATUS_BLOCKED;
            $new->update($data);
            save_log("Ngân sách #$new->name vừa mới được cập nhật", $data);
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
     * @param TourBalanceDeleteRequest $request
     * @return void
     */
    public function delete(TourBalanceDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = TourBalance::findOrFail(request('id'));
            $new->delete();
            save_log("Ngân sách #$new->name vừa mới bị xóa", $new);
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
     * @param TourBalanceViewRequest $request
     * @return void
     */
    public function detail($id, TourBalanceViewRequest $request)
    {
        $data = TourBalance::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.tour.balance.show', compact('data'));
        }
        return view('user.pages.tour.balance.detail', compact('data'));
    }
}

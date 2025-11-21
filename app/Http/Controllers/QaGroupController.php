<?php

namespace App\Http\Controllers;

use App\Http\Requests\QaGroup\QaGroupDeleteRequest;
use App\Http\Requests\QaGroup\QaGroupInsertRequest;
use App\Http\Requests\QaGroup\QaGroupUpdateRequest;
use App\Http\Requests\QaGroup\QaGroupViewRequest;
use App\Models\QaGroup;
use Illuminate\Support\Facades\DB;

class QaGroupController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    /**
     * Display the index page of the resource.
     *
     * @param QaGroupViewRequest $request
     * @return void
     */
    public function index(QaGroupViewRequest $request)
    {
        $data['status'] = QaGroup::get_status();
        return view('user.pages.qa.group.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param QaGroupViewRequest $request
     * @return void
     */
    public function list(QaGroupViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');

            $list = QaGroup::withCount('qas');
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.qa.group.table', compact('list'))->render(),
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
     * @param QaGroupInsertRequest $request
     * @return void
     */
    public function insert(QaGroupInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['important'] = isset($data['important']) && $data['important'] == QaGroup::IS_IMPORTANT ? QaGroup::IS_IMPORTANT : QaGroup::IS_NOT_IMPORTANT;
            $new = QaGroup::create($data);
            save_log("Danh mục câu hỏi #$new->name vừa mới được tạo", $data);
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
     * @param QaGroupUpdateRequest $request
     * @return void
     */
    public function update(QaGroupUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = QaGroup::findOrFail(request('id'));
            $data['status'] = isset($data['status']) && $data['status'] == QaGroup::STATUS_ACTIVE ? QaGroup::STATUS_ACTIVE : QaGroup::STATUS_BLOCKED;
            $data['important'] = isset($data['important']) && $data['important'] == QaGroup::IS_IMPORTANT ? QaGroup::IS_IMPORTANT : QaGroup::IS_NOT_IMPORTANT;
            $new->update($data);
            save_log("Danh mục câu hỏi #$new->name vừa mới được cập nhật", $data);
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
     * @param QaGroupDeleteRequest $request
     * @return void
     */
    public function delete(QaGroupDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = QaGroup::withCount('qas')->findOrFail(request('id'));
            if ($new->qas_count == 0) {
                $new->delete();
                save_log("Danh mục câu hỏi #$new->name vừa mới bị xóa", $new);
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Xóa thành công',
                    'type' => 'success',
                ]);
            }
        } catch (\Throwable $th) {
            showLog($th);
        }
        DB::rollBack();
        return response()->json([
            'status' => false,
            'message' => 'Có lỗi xãy ra!',
            'type' => 'error',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param [type] $id
     * @param QaGroupViewRequest $request
     * @return void
     */
    public function detail($id, QaGroupViewRequest $request)
    {
        $data = QaGroup::withCount('qas')->findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.qa.group.show', compact('data'))->render();
        }
        return view('user.pages.qa.group.detail', compact('data'));
    }
}

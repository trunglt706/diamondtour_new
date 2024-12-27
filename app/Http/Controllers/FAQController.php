<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Qa\QaDeleteRequest;
use App\Http\Requests\User\Qa\QaInsertRequest;
use App\Http\Requests\User\Qa\QaUpdateRequest;
use App\Http\Requests\User\Qa\QaViewRequest;
use App\Models\Qa;
use Illuminate\Support\Facades\DB;

class FAQController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function index(QaViewRequest $request)
    {
        $data['status'] = Qa::get_status();
        return view('user.pages.qa.index', compact('data'));
    }

    public function list(QaViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');
            $group_id = request('group_id', '');

            $list = Qa::with('group');
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $group_id != '' ? $list->groupId($group_id) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.qa.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(QaInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Qa::create($data);
            save_log("Câu hỏi #$new->name vừa mới được tạo", $data);
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

    public function update(QaUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['status'] = isset($data['status']) && $data['status'] == Qa::STATUS_ACTIVE ? Qa::STATUS_ACTIVE : Qa::STATUS_BLOCKED;
            $new = Qa::findOrFail(request('id'));
            $new->update($data);
            save_log("Câu hỏi #$new->name vừa mới được cập nhật", $data);
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

    public function delete(QaDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Qa::findOrFail(request('id'));
            $new->delete();
            save_log("Câu hỏi #$new->name vừa mới bị xóa", $new);
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

    public function detail($id, QaViewRequest $request)
    {
        $data = Qa::with('group')->findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.qa.show', compact('data'))->render();
        }
        return view('user.pages.qa.detail', compact('data'));
    }
}

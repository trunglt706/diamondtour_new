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
    public function index(QaViewRequest $request)
    {
        return view('user.pages.qa.index');
    }

    public function list(QaViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = Qa::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
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
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(QaUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Qa::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(QaDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Qa::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, QaViewRequest $request)
    {
        $data = Qa::findOrFail($id);
        return view('user.pages.qa.detail', compact('data'));
    }
}

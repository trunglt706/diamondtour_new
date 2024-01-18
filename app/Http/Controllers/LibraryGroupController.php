<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LibraryGroup\LibraryGroupDeleteRequest;
use App\Http\Requests\User\LibraryGroup\LibraryGroupInsertRequest;
use App\Http\Requests\User\LibraryGroup\LibraryGroupUpdateRequest;
use App\Http\Requests\User\LibraryGroup\LibraryGroupViewRequest;
use App\Models\LibraryGroup;
use Illuminate\Support\Facades\DB;

class LibraryGroupController extends Controller
{
    public function index(LibraryGroupViewRequest $request)
    {
        return view('user.pages.library.group.index');
    }

    public function list(LibraryGroupViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = LibraryGroup::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.library.group.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(LibraryGroupInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = LibraryGroup::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(LibraryGroupUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = LibraryGroup::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(LibraryGroupDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = LibraryGroup::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, LibraryGroupViewRequest $request)
    {
        $data = LibraryGroup::findOrFail($id);
        return view('user.pages.library.group.detail', compact('data'));
    }
}

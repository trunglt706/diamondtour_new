<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Library\LibraryDeleteRequest;
use App\Http\Requests\User\Library\LibraryInsertRequest;
use App\Http\Requests\User\Library\LibraryUpdateRequest;
use App\Http\Requests\User\Library\LibraryViewRequest;
use App\Models\Library;
use Illuminate\Support\Facades\DB;

class LibraryController extends Controller
{
    public function index(LibraryViewRequest $request)
    {
        return view('user.pages.library.index');
    }

    public function list(LibraryViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = Library::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.library.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(LibraryInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Library::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(LibraryUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Library::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(LibraryDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Library::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, LibraryViewRequest $request)
    {
        $data = Library::findOrFail($id);
        return view('user.pages.library.detail', compact('data'));
    }
}

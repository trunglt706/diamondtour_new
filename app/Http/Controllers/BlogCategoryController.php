<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\BlogCategory\BlogCategoryDeleteRequest;
use App\Http\Requests\User\BlogCategory\BlogCategoryInsertRequest;
use App\Http\Requests\User\BlogCategory\BlogCategoryUpdateRequest;
use App\Http\Requests\User\BlogCategory\BlogCategoryViewRequest;
use App\Models\PostGroup;
use Illuminate\Support\Facades\DB;

class BlogCategoryController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function index(BlogCategoryViewRequest $request)
    {
        $data['status'] = PostGroup::get_status();
        return view('user.pages.blog.group.index', compact('data'));
    }

    public function list(BlogCategoryViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = PostGroup::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.blog.group.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(BlogCategoryInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = PostGroup::create($data);
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

    public function update(BlogCategoryUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = PostGroup::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(BlogCategoryDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = PostGroup::findOrFail(request('id'));
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

    public function detail($id, BlogCategoryViewRequest $request)
    {
        $data = PostGroup::findOrFail($id);
        return view('user.pages.blog.group.detail', compact('data'));
    }
}

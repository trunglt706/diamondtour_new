<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Blog\BlogDeleteRequest;
use App\Http\Requests\User\Blog\BlogInsertRequest;
use App\Http\Requests\User\Blog\BlogUpdateRequest;
use App\Http\Requests\User\Blog\BlogViewRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function index(BlogViewRequest $request)
    {
        $data['status'] = Post::get_status();
        return view('user.pages.blog.index', compact('data'));
    }

    public function list(BlogViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');
            $group_id = request('group_id', '');
            $important = request('important', '');

            $list = Post::query();
            $list = $group_id != '' ? $list->groupId($group_id) : $list;
            $list = $important != '' ? $list->ofImportant($important) : $list;
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.blog.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(BlogInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Post::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(BlogUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Post::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(BlogDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Post::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, BlogViewRequest $request)
    {
        $data = Post::findOrFail($id);
        return view('user.pages.blog.detail', compact('data'));
    }
}

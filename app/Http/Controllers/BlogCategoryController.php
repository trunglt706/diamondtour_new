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
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/blog_group';
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

            $list = PostGroup::withCount('blogs');
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->orderBy('numering', 'desc')->latest()->paginate($limit);
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
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $new = PostGroup::create($data);
            save_log("Danh mục blog #$new->name vừa mới được tạo", $data);
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
            $data['status'] = isset($data['status']) && $data['status'] == PostGroup::STATUS_ACTIVE ? PostGroup::STATUS_ACTIVE : PostGroup::STATUS_BLOCKED;
            $new = PostGroup::findOrFail(request('id'));
            if (request()->hasFile('image')) {
                delete_file($new->image);
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $new->update($data);
            save_log("Danh mục blog #$new->name vừa mới được cập nhật", $data);
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

    public function delete(BlogCategoryDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = PostGroup::withCount('blogs')->findOrFail(request('id'));
            if ($new && $new->blogs_count == 0) {
                $new->delete();
                save_log("Danh mục blog #$new->name vừa mới bị xóa", $new);
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

    public function detail($id, BlogCategoryViewRequest $request)
    {
        $data = PostGroup::withCount('blogs')->findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.blog.group.show', compact('data'))->render();
        }
        return view('user.pages.blog.group.detail', compact('data'));
    }
}

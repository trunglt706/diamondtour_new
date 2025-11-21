<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Blog\BlogDeleteRequest;
use App\Http\Requests\User\Blog\BlogInsertRequest;
use App\Http\Requests\User\Blog\BlogUpdateRequest;
use App\Http\Requests\User\Blog\BlogViewRequest;
use App\Models\Post;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/blog';
    }

    /**
     * Display index page of the resource.
     *
     * @param BlogViewRequest $request
     * @return void
     */
    public function index(BlogViewRequest $request)
    {
        $data['status'] = Post::get_status();
        $blogs = Post::query();
        $report = [
            // tổng bài viết
            'total' => $blogs->clone()->count(),
            // được yêu thích
            'like' => $blogs->clone()->where('like_total', '>', 0)->count(),
            // tiêu đểm
            'tieu_diem' => $blogs->clone()->where('tieu_diem', Post::IS_IMPORTANT)->count(),
            // hot
            'hot' => $blogs->clone()->where('hot', Post::IS_HOT)->count(),
        ];
        return view('user.pages.blog.index', compact('data', 'report'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param BlogViewRequest $request
     * @return void
     */
    public function list(BlogViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');
            $group_id = request('group_id', '');
            $important = request('important', '');
            $hot = request('hot', '');
            $tieu_diem = request('tieu_diem', '');

            $list = Post::query();
            $list = $group_id != '' ? $list->groupId($group_id) : $list;
            $list = $important != '' ? $list->ofImportant($important) : $list;
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $hot != '' ? $list->ofHot($hot) : $list;
            $list = $tieu_diem != '' ? $list->ofTieuDiem($tieu_diem) : $list;
            $list = $list->orderBy('important', 'desc')->latest()->paginate($limit);
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

    /**
     * Insert a newly created resource in storage.
     *
     * @param BlogInsertRequest $request
     * @return void
     */
    public function insert(BlogInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('background')) {
                $file = request()->file('background');
                $data['background'] = store_file($file, $this->dir, false, 1500);
            }
            if (request()->hasFile('album')) {
                $album = [];
                foreach (request()->file('album') as $file) {
                    array_push($album, store_file($file, $this->dir, false, 1500));
                }
                $data['album'] = json_encode($album);
            }
            $data['tags'] = isset($data['tags']) ? json_encode(explode(',', $data['tags'])) : json_encode([]);
            $data['tours'] = isset($data['tours']) ? json_encode($data['tours']) : json_encode([]);
            $data['hot'] = isset($data['hot']) && $data['hot'] == Post::IS_HOT ? Post::IS_HOT : Post::IS_NOT_HOT;
            $data['tieu_diem'] = isset($data['tieu_diem']) && $data['tieu_diem'] == Post::IS_IMPORTANT ? Post::IS_IMPORTANT : Post::IS_NOT_IMPORTANT;
            $data['like_total'] = isset($data['like_total']) && $data['like_total'] == 1 ? 1 : 0;
            $new = Post::create($data);
            save_log("Blog #$new->name vừa mới được tạo", $data);
            DB::commit();
            if (request()->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Tạo mới thành công',
                    'type' => 'success',
                ]);
            }
            return redirect()->back()->with('success', 'Tạo mới thành công');
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
     * Update the specified resource in storage.
     *
     * @param BlogUpdateRequest $request
     * @return void
     */
    public function update(BlogUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Post::findOrFail(request('id'));
            if (request()->hasFile('image')) {
                delete_file($new->image);
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('background')) {
                delete_file($new->background);
                $file = request()->file('background');
                $data['background'] = store_file($file, $this->dir, false, 1500);
            }
            if (request()->hasFile('album')) {
                $album = [];
                foreach (request()->file('album') as $file) {
                    array_push($album, store_file($file, $this->dir, false, 1500));
                }
                $old_album = $new->album ? json_decode($new->album) : [];
                foreach ($old_album as $old) {
                    delete_file($old);
                }
                $data['album'] = json_encode($album);
            }
            $data['tags'] = isset($data['tags']) ? json_encode(explode(',', $data['tags'])) : json_encode([]);
            $data['tours'] = isset($data['tours']) ? json_encode($data['tours']) : json_encode([]);
            $data['hot'] = isset($data['hot']) && $data['hot'] == Post::IS_HOT ? Post::IS_HOT : Post::IS_NOT_HOT;
            $data['tieu_diem'] = isset($data['tieu_diem']) && $data['tieu_diem'] == Post::IS_IMPORTANT ? Post::IS_IMPORTANT : Post::IS_NOT_IMPORTANT;
            $data['like_total'] = isset($data['like_total']) && $data['like_total'] == 1 ? 1 : 0;
            $new->update($data);
            save_log("Blog #$new->name vừa mới được cập nhật", $data);
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
     * Update the specified resource in storage.
     *
     * @return void
     */
    public function updateAlbum()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Post::findOrFail(request('id'));
            $data = json_decode($new->album, 1);
            $temp = $data[request('draggedIndex')];
            $data[request('draggedIndex')] = $data[request('targetIndex')];
            $data[request('targetIndex')] = $temp;

            $new->album = json_encode($data);
            $new->save();

            save_log("Blog #$new->name vừa mới cập nhật thứ tự của Album", $data);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thành công',
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
     * Remove the specified resource from storage.
     *
     * @param BlogDeleteRequest $request
     * @return void
     */
    public function delete(BlogDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Post::findOrFail(request('id'));
            $new->delete();
            save_log("Blog #$new->name vừa mới bị xóa", $new);
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
     * @param BlogViewRequest $request
     * @return void
     */
    public function detail($id, BlogViewRequest $request)
    {
        $data = Post::findOrFail($id);
        $status = Post::get_status($data->status);
        return view('user.pages.blog.detail', compact('data', 'status'));
    }

    /**
     * Display the specified resource for editing.
     *
     * @param [type] $id
     * @param BlogViewRequest $request
     * @return void
     */
    public function edit($id, BlogViewRequest $request)
    {
        $data = Post::findOrFail($id);
        $tours = $data->tours ? json_decode($data->tours) : [];
        $other = [
            'status' => Post::get_status(),
            'tours' => Tour::ofStatus(Tour::STATUS_ACTIVE)->whereIn('id', $tours)->select('id', 'name')->get(),
        ];
        return view('user.pages.blog.edit', compact('data', 'other'));
    }

    /**
     * Insert a newly created resource in storage.
     *
     * @return void
     */
    public function create()
    {
        $data['status'] = Post::get_status();
        return view('user.pages.blog.create', compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TourGroup;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/video';
    }

    public function index()
    {
        $data['video_status'] = TourGroup::get_status();
        return view('user.pages.video.index', compact('data'));
    }

    public function list()
    {
        try {
            $limit = request('limit', 10);
            $video_status = request('video_status', '');
            $search = request('search', '');

            $list = TourGroup::query();
            $list = $video_status != '' ? $list->where('video_status', $video_status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->select('id', 'name', 'video_image', 'video_name', 'video_status', 'video_url')->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.video.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function update()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['video_status'] = isset($data['video_status']) && $data['video_status'] == TourGroup::STATUS_ACTIVE ? TourGroup::STATUS_ACTIVE : TourGroup::STATUS_BLOCKED;
            $new = TourGroup::findOrFail(request('id'));
            if (request()->hasFile('video_image')) {
                delete_file($new->video_image);
                $file = request()->file('video_image');
                $data['video_image'] = store_file($file, $this->dir, false, 900);
            }
            $new->update($data);
            save_log("Danh mục tour #$new->name vừa mới cập nhật thước phim yêu thích", $data);
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

    public function detail($id)
    {
        $data = TourGroup::select('id', 'video_name', 'video_image', 'video_url', 'video_status')->findOrFail($id);
        return view('user.pages.video.show', compact('data'));
    }
}

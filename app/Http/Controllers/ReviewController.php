<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{

    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/review';
    }

    /**
     * Display the index page of the resource.
     *
     * @return void
     */
    public function index()
    {
        $review = Review::query();
        $data = [
            'status' => Review::get_status(),
            // tổng số review
            'total' => $review->clone()->count(),
            // tổng review từ trang chủ
            'home' => $review->clone()->whereNull('destination_id')->count(),
            // tổng review điểm đến
            'destination' => $review->clone()->whereNotNull('destination_id')->count(),
        ];
        return view('user.pages.destination.review.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function list()
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');
            $destination_id = request('destination_id', '');

            $list = Review::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $destination_id != '' ? $list->destinationId($destination_id) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.destination.review.table', compact('list'))->render(),
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
     * @return void
     */
    public function insert()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('user_avatar')) {
                $file = request()->file('user_avatar');
                $data['user_avatar'] = store_file($file, $this->dir, false, 100);
            }
            $data['important'] = isset($data['important']) && $data['important'] == Review::IMPORTANT_YES ? Review::IMPORTANT_YES : Review::IMPORTANT_NO;
            $new = Review::create($data);
            save_log("Review #$new->code vừa mới được tạo", $data);
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
     * @return void
     */
    public function update()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Review::findOrFail(request('id'));
            if (request()->hasFile('user_avatar')) {
                delete_file($new->user_avatar);
                $file = request()->file('user_avatar');
                $data['user_avatar'] = store_file($file, $this->dir, false, 100);
            }
            $data['status'] = isset($data['status']) && $data['status'] == Review::STATUS_ACTIVE ? Review::STATUS_ACTIVE : Review::STATUS_BLOCKED;
            $data['important'] = isset($data['important']) && $data['important'] == Review::IMPORTANT_YES ? Review::IMPORTANT_YES : Review::IMPORTANT_NO;
            $data['destination_id'] = isset($data['destination_id']) ? $data['destination_id'] : null;
            $new->update($data);
            save_log("Review #$new->code vừa mới được cập nhật", $data);
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
     * @return void
     */
    public function delete()
    {
        DB::beginTransaction();
        try {
            $new = Review::findOrFail(request('id'));
            $new->delete();
            save_log("Review #$new->code vừa mới bị xóa", $new);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Xóa thành công',
                'type' => 'success',
            ]);
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
     * @return void
     */
    public function detail($id)
    {
        $data = Review::with('destination')->findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.destination.review.show', compact('data'))->render();
        }
        $status = Review::get_status($data->status);
        return view('user.pages.destination.review.detail', compact('data', 'status'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;

class TourLibraryController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/library';
    }

    /**
     * Display the index page of the resource.
     *
     * @return void
     */
    public function index()
    {
        $data = [
            'status' => Library::get_status(),
            'tour' => Tour::select('id', 'name')->find(request('id')),
        ];
        return view('user.pages.tour.library.index', compact('data'));
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
            $group_id = request('group_id', '');

            $list = Library::type(Library::TYPE_TOUR);
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $group_id != '' ? $list->groupId($group_id) : $list;
            $list = $list->orderBy('numering', 'asc')->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.library.table', compact('list'))->render(),
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
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function insert()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $new = Library::create($data);
            save_log("Thư viện #$new->name vừa mới được tạo", $data);
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
            $new = Library::type(Library::TYPE_TOUR)->findOrFail(request('id'));
            if (request()->hasFile('image')) {
                delete_file($new->image);
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $data['status'] = isset($data['status']) && $data['status'] == Library::STATUS_ACTIVE ? Library::STATUS_ACTIVE : Library::STATUS_BLOCKED;
            $new->update($data);
            save_log("Thư viện #$new->name vừa mới được cập nhật", $data);
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
     * @return void
     */
    public function delete()
    {
        DB::beginTransaction();
        try {
            $new = Library::type(Library::TYPE_TOUR)->findOrFail(request('id'));
            $new->delete();
            save_log("Thư viện #$new->name vừa mới bị xóa", $new);
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
     * @return void
     */
    public function detail($id)
    {
        $data = Library::type(Library::TYPE_TOUR)->findOrFail($id);
        return view('user.pages.tour.library.show', compact('data'))->render();
    }
}

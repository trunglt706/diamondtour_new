<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DestinationGroup\DestinationGroupDeleteRequest;
use App\Http\Requests\User\DestinationGroup\DestinationGroupInsertRequest;
use App\Http\Requests\User\DestinationGroup\DestinationGroupUpdateRequest;
use App\Http\Requests\User\DestinationGroup\DestinationGroupViewRequest;
use App\Models\DestinationGroup;
use Illuminate\Support\Facades\DB;

class DestinationGroupController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/destination_group';
    }

    public function index(DestinationGroupViewRequest $request)
    {
        $data['status'] = DestinationGroup::get_status();
        return view('user.pages.destination.group.index', compact('data'));
    }

    public function list(DestinationGroupViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = DestinationGroup::withCount('destinations');
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->orderBy('numering', 'desc')->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.destination.group.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(DestinationGroupInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $new = DestinationGroup::create($data);
            save_log("Danh mục điểm đến #$new->name vừa mới được tạo", $data);
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

    public function update(DestinationGroupUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            unset($data['type']);
            $data['status'] = isset($data['status']) && $data['status'] == DestinationGroup::STATUS_ACTIVE ? DestinationGroup::STATUS_ACTIVE : DestinationGroup::STATUS_BLOCKED;
            $new = DestinationGroup::findOrFail(request('id'));
            if (request()->hasFile('image')) {
                delete_file($new->image);
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $new->update($data);
            save_log("Danh mục điểm đến #$new->name vừa mới được cập nhật", $data);
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

    public function delete(DestinationGroupDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = DestinationGroup::withCount('destinations')->findOrFail(request('id'));
            if ($new && $new->destinations_count == 0) {
                $new->delete();
                save_log("Danh mục điểm đến #$new->name vừa mới bị xóa", $new);
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

    public function detail($id, DestinationGroupViewRequest $request)
    {
        $data = DestinationGroup::withCount('destinations')->findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.destination.group.show', compact('data'))->render();
        }
        return view('user.pages.destination.group.detail', compact('data'));
    }
}

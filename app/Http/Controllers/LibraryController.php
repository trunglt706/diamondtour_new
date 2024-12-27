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
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/library';
    }

    public function index(LibraryViewRequest $request)
    {
        $data = [
            'status' => Library::get_status(),
            'important' => Library::get_important(),
        ];
        return view('user.pages.library.index', compact('data'));
    }

    public function list(LibraryViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');
            $group_id = request('group_id', '');
            $important = request('important', '');

            $list = Library::type(Library::TYPE_LIBRARY);
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $group_id != '' ? $list->groupId($group_id) : $list;
            $list = $important != '' ? $list->ofImportant($important) : $list;
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
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 1500);
            }
            $data['important'] = isset($data['important']) && $data['important'] == 1 ? 1 : 0;
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

    public function update(LibraryUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Library::type(Library::TYPE_LIBRARY)->findOrFail(request('id'));
            if (request()->hasFile('image')) {
                delete_file($new->image);
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 1500);
            }
            $data['status'] = isset($data['status']) && $data['status'] == Library::STATUS_ACTIVE ? Library::STATUS_ACTIVE : Library::STATUS_BLOCKED;
            $data['important'] = isset($data['important']) && $data['important'] == 1 ? 1 : 0;
            $new->update($data);
            save_log("Thư viện #$new->name vừa mới được cập nhật", $data);
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

    public function delete(LibraryDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Library::type(Library::TYPE_LIBRARY)->findOrFail(request('id'));
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

    public function detail($id, LibraryViewRequest $request)
    {
        $data = Library::type(Library::TYPE_LIBRARY)->findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.library.show', compact('data'))->render();
        }
        return view('user.pages.library.detail', compact('data'));
    }
}

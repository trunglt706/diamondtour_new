<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Services;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/service';
    }

    public function index()
    {
        $data['status'] = Services::get_status();
        return view('user.pages.service.index', compact('data'));
    }

    public function list()
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = Services::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->orderBy('numering', 'desc')->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.service.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $new = Services::create($data);
            DB::commit();
            if (request()->hasFile('backgrounds')) {
                foreach (request()->file('backgrounds') as $file) {
                    Images::create([
                        'table' => 'services',
                        'table_id' => $new->id,
                        'code' => 'services',
                        'url' => store_file($file, $this->dir, false, 1500)
                    ]);
                }
            }
            save_log("Dịch vụ #$new->name vừa mới được tạo", $data);
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

    public function update()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['status'] = isset($data['status']) && $data['status'] == Services::STATUS_ACTIVE ? Services::STATUS_ACTIVE : Services::STATUS_BLOCKED;
            $new = Services::findOrFail(request('id'));
            if (request()->hasFile('image')) {
                delete_file($new->image);
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            if (request()->hasFile('backgrounds')) {
                foreach (request()->file('backgrounds') as $file) {
                    Images::create([
                        'table' => 'services',
                        'table_id' => $new->id,
                        'code' => 'services',
                        'url' => store_file($file, $this->dir, false, 1500)
                    ]);
                }
            }
            $new->update($data);
            save_log("Dịch vụ #$new->name vừa mới được cập nhật", $data);
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

    public function delete()
    {
        DB::beginTransaction();
        try {
            $new = Services::findOrFail(request('id'));
            if ($new) {
                $new->delete();
                save_log("Dịch vụ #$new->name vừa mới bị xóa", $new);
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

    public function detail($id)
    {
        $data = Services::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.service.show', compact('data'))->render();
        }
        return view('user.pages.service.detail', compact('data'));
    }
}

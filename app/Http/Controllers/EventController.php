<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Event\EventCreateRequest;
use App\Http\Requests\User\Event\EventDeleteRequest;
use App\Http\Requests\User\Event\EventUpdateRequest;
use App\Http\Requests\User\Event\EventViewRequest;
use App\Models\Events;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/event';
    }

    public function index(EventViewRequest $request)
    {
        $data['status'] = Events::get_status();
        return view('user.pages.event.index', compact('data'));
    }

    public function list(EventViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');
            $important = request('important', '');
            $date = request('date', '');

            $list = Events::query();
            $list = $date != '' ? $list->ofDate($date) : $list;
            $list = $important != '' ? $list->ofImportant($important) : $list;
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->orderBy('important', 'desc')->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.event.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(EventCreateRequest $request)
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
            $data['important'] = isset($data['important']) && $data['important'] == 1 ? 1 : 0;
            $data['home'] = isset($data['home']) && $data['home'] == 1 ? 1 : 0;
            $new = Events::create($data);
            save_log("Sự kiện #$new->name vừa mới được tạo", $data);
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

    public function update(EventUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Events::findOrFail(request('id'));
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
            $data['important'] = isset($data['important']) && $data['important'] == 1 ? 1 : 0;
            $data['home'] = isset($data['home']) && $data['home'] == 1 ? 1 : 0;
            $new->update($data);
            save_log("Sự kiện #$new->name vừa mới được cập nhật", $data);
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

    public function delete(EventDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Events::findOrFail(request('id'));
            $new->delete();
            save_log("Sự kiện #$new->name vừa mới bị xóa", $new);
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

    public function detail($id, EventViewRequest $request)
    {
        $data = Events::findOrFail($id);
        return view('user.pages.event.detail', compact('data'));
    }

    public function edit($id, EventViewRequest $request)
    {
        $data = Events::findOrFail($id);
        $other = [
            'status' => Events::get_status(),
        ];
        return view('user.pages.event.edit', compact('data', 'other'));
    }

    public function create()
    {
        $data['status'] = Events::get_status();
        return view('user.pages.event.create', compact('data'));
    }
}

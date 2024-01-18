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
    public function index(DestinationGroupViewRequest $request)
    {
        return view('user.pages.destination.group.index');
    }
    public function list(DestinationGroupViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = DestinationGroup::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
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
            $new = DestinationGroup::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(DestinationGroupUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = DestinationGroup::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(DestinationGroupDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = DestinationGroup::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, DestinationGroupViewRequest $request)
    {
        $data = DestinationGroup::findOrFail($id);
        return view('user.pages.destination.group.detail', compact('data'));
    }
}

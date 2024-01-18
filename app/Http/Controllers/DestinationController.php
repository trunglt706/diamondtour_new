<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Destination\DestinationDeleteRequest;
use App\Http\Requests\User\Destination\DestinationInsertRequest;
use App\Http\Requests\User\Destination\DestinationUpdateRequest;
use App\Http\Requests\User\Destination\DestinationViewRequest;
use App\Models\Destination;
use Illuminate\Support\Facades\DB;

class DestinationController extends Controller
{
    public function index(DestinationViewRequest $request)
    {
        return view('user.pages.destination.index');
    }

    public function list(DestinationViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');
            $group_id = request('group_id', '');
            $country_id = request('country_id', '');
            $province_id = request('province_id', '');
            $important = request('important', '');

            $list = Destination::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $group_id != '' ? $list->groupId($group_id) : $list;
            $list = $country_id != '' ? $list->countryId($country_id) : $list;
            $list = $province_id != '' ? $list->provinceId($province_id) : $list;
            $list = $important != '' ? $list->ofImportant($important) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.destination.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(DestinationInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Destination::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(DestinationUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Destination::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(DestinationDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Destination::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, DestinationViewRequest $request)
    {
        $data = Destination::findOrFail($id);
        return view('user.pages.destination.detail', compact('data'));
    }
}

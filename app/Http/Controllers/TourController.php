<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Tour\TourDeleteRequest;
use App\Http\Requests\User\Tour\TourInsertRequest;
use App\Http\Requests\User\Tour\TourUpdateRequest;
use App\Http\Requests\User\Tour\TourViewRequest;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{
    public function index(TourViewRequest $request)
    {
        return view('user.pages.tour.index');
    }

    public function list(TourViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = Tour::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(TourInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Tour::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(TourUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Tour::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(TourDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Tour::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, TourViewRequest $request)
    {
        $data = Tour::findOrFail($id);
        return view('user.pages.tour.detail', compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Booking\BookingDeleteRequest;
use App\Http\Requests\User\Booking\BookingInsertRequest;
use App\Http\Requests\User\Booking\BookingUpdateRequest;
use App\Http\Requests\User\Booking\BookingViewRequest;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(BookingViewRequest $request)
    {
        return view('user.pages.booking.index');
    }

    public function list(BookingViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = Booking::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.booking.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(BookingInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Booking::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(BookingUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Booking::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(BookingDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Booking::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, BookingViewRequest $request)
    {
        $data = Booking::findOrFail($id);
        return view('user.pages.booking.detail', compact('data'));
    }
}

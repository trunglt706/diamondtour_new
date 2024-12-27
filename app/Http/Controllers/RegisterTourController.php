<?php

namespace App\Http\Controllers;

use App\Exports\RegisterTourExport;
use App\Models\RegisterTour;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RegisterTourController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function index()
    {
        $data['status'] = RegisterTour::get_status();
        return view('user.pages.register_tour.index', compact('data'));
    }

    public function list()
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');
            $export = request('export', '');

            $list = RegisterTour::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            if ($export == 1) {
                return Excel::download(new RegisterTourExport($list->latest()->get()), 'register-tour');
            }
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.register_tour.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function update()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = RegisterTour::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            save_log("Thông tin đăng ký tour #$new->code vừa mới được cập nhật", $data);
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            $new = RegisterTour::findOrFail(request('id'));
            if ($new) {
                $new->delete();
                save_log("Thông tin đăng ký tour #$new->code vừa mới bị xóa", $new);
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
        $data = RegisterTour::findOrFail($id);
        return view('user.pages.register_tour.detail', compact('data'));
    }

    public function accept()
    {
        DB::beginTransaction();
        try {
            $new = RegisterTour::findOrFail(request('id'));
            if ($new) {
                $new->status = RegisterTour::STATUS_ACTIVE;
                $new->save();
                save_log("Thông tin đăng ký tour #$new->code vừa mới được duyệt", $new);
                DB::commit();
                return redirect()->back()->with('success', 'Duyệt dữ liệu thành công');
            }
        } catch (\Throwable $th) {
            showLog($th);
        }
        DB::rollBack();
        return redirect()->back()->with('error', 'Duyệt dữ liệu thất bại!');
    }
}

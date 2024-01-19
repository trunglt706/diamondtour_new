<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\TourDesign\TourDesignDeleteRequest;
use App\Http\Requests\User\TourDesign\TourDesignUpdateRequest;
use App\Http\Requests\User\TourDesign\TourDesignViewRequest;
use App\Models\TourDesign;
use Illuminate\Support\Facades\DB;

class TourDesignController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function index(TourDesignViewRequest $request)
    {
        $data['status'] = TourDesign::get_status();
        return view('user.pages.tour.design.index', compact('data'));
    }

    public function list(TourDesignViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = TourDesign::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.design.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function update(TourDesignUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = TourDesign::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(TourDesignDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = TourDesign::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, TourDesignViewRequest $request)
    {
        $data = TourDesign::findOrFail($id);
        return view('user.pages.tour.design', compact('data'));
    }
}

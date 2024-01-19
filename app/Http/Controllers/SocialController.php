<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Social\SocialDeleteRequest;
use App\Http\Requests\User\Social\SocialInsertRequest;
use App\Http\Requests\User\Social\SocialUpdateRequest;
use App\Http\Requests\User\Social\SocialViewRequest;
use App\Models\Social;
use Illuminate\Support\Facades\DB;

class SocialController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function index(SocialViewRequest $request)
    {
        $data['status'] = Social::get_status();
        return view('user.pages.setting.social.index', compact('data'));
    }

    public function list(SocialViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = Social::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.setting.social.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(SocialInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Social::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(SocialUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Social::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(SocialDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Social::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, SocialViewRequest $request)
    {
        $data = Social::findOrFail($id);
        return view('user.pages.setting.social.detail', compact('data'));
    }
}

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
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/social';
    }

    /**
     * Display the index page of the resource.
     *
     * @param SocialViewRequest $request
     * @return void
     */
    public function index(SocialViewRequest $request)
    {
        $data['status'] = Social::get_status();
        return view('user.pages.setting.social.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param SocialViewRequest $request
     * @return void
     */
    public function list(SocialViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');

            $list = Social::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest('numering')->paginate($limit);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param SocialInsertRequest $request
     * @return void
     */
    public function insert(SocialInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('icon')) {
                $file = request()->file('icon');
                $data['icon'] = store_file($file, $this->dir, false, 200);
            }
            $new = Social::create($data);
            save_log("Mạng xã hội #$new->name vừa mới được tạo", $data);
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

    /**
     * Update the specified resource in storage.
     *
     * @param SocialUpdateRequest $request
     * @return void
     */
    public function update(SocialUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['status'] = isset($data['status']) && $data['status'] == Social::STATUS_ACTIVE ? Social::STATUS_ACTIVE : Social::STATUS_BLOCKED;
            $new = Social::findOrFail(request('id'));
            if (request()->hasFile('icon')) {
                delete_file($new->icon);
                $file = request()->file('icon');
                $data['icon'] = store_file($file, $this->dir, false, 200);
            }
            $new->update($data);
            save_log("Mạng xã hội #$new->name vừa mới được cập nhật", $data);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param SocialDeleteRequest $request
     * @return void
     */
    public function delete(SocialDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Social::findOrFail(request('id'));
            $new->delete();
            save_log("Mạng xã hội #$new->name vừa mới bị xóa", $new);
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

    /**
     * Display the specified resource.
     *
     * @param [type] $id
     * @param SocialViewRequest $request
     * @return void
     */
    public function detail($id, SocialViewRequest $request)
    {
        $data = Social::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.setting.social.show', compact('data'));
        }
        return view('user.pages.setting.social.detail', compact('data'));
    }
}

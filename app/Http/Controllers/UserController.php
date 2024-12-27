<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserDeleteRequest;
use App\Http\Requests\User\UserInsertRequest;
use App\Http\Requests\User\UserUpdateAccountRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\UserViewRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function index(UserViewRequest $request)
    {
        $data['status'] = User::get_status();
        return view('user.pages.user.index', compact('data'));
    }

    public function list(UserViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = User::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.user.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function insert(UserInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->only('name', 'email', 'phone', 'password');
            $data['password'] = Hash::make($data['password']);
            $new = User::create($data);
            save_log("Nhân viên #$new->name vừa mới được tạo", $data);
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

    public function update(UserUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->only('name', 'email', 'phone', 'status');
            $new = User::findOrFail(request('id'));
            $new->update($data);
            save_log("Nhân viên #$new->name vừa mới được cập nhật", $data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update_account(UserUpdateAccountRequest $request)
    {
        DB::beginTransaction();
        try {
            $password = trim(request('password'));
            $new = User::findOrFail(auth()->user()->id);
            $new->password = Hash::make($password);
            $new->save();
            save_log("Tài khoản nhân viên #$new->name vừa mới được cập nhật", $request->all());
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(UserDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = User::where('id', '<>', auth()->user()->id)->findOrFail(request('id'));
            if ($new) {
                $new->delete();
                save_log("Nhân viên #$new->name vừa mới bị xóa", $new);
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
            'message' => 'Không thể xóa tài khoản này!',
            'type' => 'error',
        ]);
    }

    public function detail($id, UserViewRequest $request)
    {
        $user = User::findOrFail($id);
        $tab = request('tab', 'info');
        $data['status'] = User::get_status();
        return view('user.pages.user.detail.index', compact('data', 'user', 'tab'));
    }

    public function updateStatus()
    {
        try {
            DB::beginTransaction();
            $id = request('id', '');
            $status = request('status', User::STATUS_ACTIVE);
            $user = User::findOrFail($id);
            if ($user) {
                $user->status = $status;
                $user->save();
                $msg = $status ==  User::STATUS_ACTIVE ? 'được kích hoạt' : 'bị khóa';
                save_log("Nhân viên #$user->name vừa mới $msg", request()->all());
                DB::commit();
                return redirect()->back()->with('success', "Trạng thái của nhân viên đã $msg");
            }
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
        }
        return redirect()->back()->with('error', "Không thể cập nhật trạng thái!");
    }
}

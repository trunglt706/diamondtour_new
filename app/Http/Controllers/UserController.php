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
    public function index(UserViewRequest $request)
    {
        return view('user.pages.user.index');
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
            $data = request()->all();
            $new = User::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(UserUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = User::findOrFail(request('id'));
            $new->update($data);
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
            $new = User::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, UserViewRequest $request)
    {
        $data = User::findOrFail($id);
        return view('user.pages.user.detail', compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);
        $tab = request('tab', 'info');
        $data['status'] = User::get_status();
        return view('user.pages.user.profile.index', compact('data', 'user', 'tab'));
    }

    public function update_account()
    {
        DB::beginTransaction();
        try {
            $password = trim(request('password'));
            $new = User::findOrFail(auth()->user()->id);
            $new->password = Hash::make($password);
            $new->save();
            save_log("Thông tin tài khoản của bạn vừa mới được cập nhật", request()->all());
            DB::commit();
            Auth::logout();
            return redirect()->route('login.index')->with('success', 'Đăng xuất thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }
}

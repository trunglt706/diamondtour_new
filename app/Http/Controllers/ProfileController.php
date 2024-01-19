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
        $data = User::findOrFail(auth()->user()->id);
        return view('user.pages.profile.index', compact('data'));
    }

    public function update_account()
    {
        DB::beginTransaction();
        try {
            $password = trim(request('password'));
            $new = User::findOrFail(auth()->user()->id);
            $new->password = Hash::make($password);
            $new->save();
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

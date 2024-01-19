<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Auth\LoginSubmitRequest;
use App\Http\Requests\User\Auth\LoginViewRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginViewRequest $request)
    {
        return view('user.pages.authen.login');
    }

    public function postLogin(LoginSubmitRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::ofEmail(request('email'))->active()->first();
            if ($user && Hash::check(request('password'), $user->password)) {
                Auth::login($user);
                $user->last_login = now();
                $user->save();
                DB::commit();
                return redirect()->route('user.index')->with('success', 'Đăng nhập thành công');
            }
        } catch (\Throwable $th) {
            showLog($th);
        }
        return redirect()->back()->with('error', 'Đăng nhập thất bại!');
    }
}

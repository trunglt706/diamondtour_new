<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Post;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::count(),
            'blogs' => Post::count(),
            'destinations' => Destination::count(),
            'tours' => Tour::count(),
        ];
        return view('user.pages.index', compact('data'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index')->with('success', 'Đăng xuất thành công');
    }

    public function get_data_select2(Request $request)
    {
        $lstCol = $request->input('lstCol');
        $data = DB::table($request->input('table'))->select($lstCol);
        if ($request->has('search') && $request->search != '') {
            $search = $lstCol[1];
            $search = Str::before($search, ' as');
            $data = $data->where($search, 'LIKE', '%' . $request->search . '%');
        }
        $wheres = request('where', '');
        if ($wheres != '') {
            foreach ($wheres as $key => $value) {
                $data = $data->where($key, $value);
            }
        }
        return $data->get()->toArray();
    }

    public function upload_editor()
    {
        return view('user.editor.index');
    }
}

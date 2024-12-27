<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Destination;
use App\Models\Images;
use App\Models\LogAction;
use App\Models\Post;
use App\Models\RegisterPromo;
use App\Models\RegisterTour;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $key = request('key', '');
        if ($key != '') {
            Artisan::call("app:resize-$key");
        }
        $data = [
            'users' => User::count(),
            'blogs' => Post::count(),
            'destinations' => Destination::count(),
            'tours' => Tour::count(),
        ];
        return view('user.pages.home.index', compact('data'));
    }

    public function logout()
    {
        $user = auth()->user();
        Auth::logout();
        save_log("Nhân viên #$user->name vừa mới đăng xuất khỏi hệ thống", $user);
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
        return view('user.pages.editor');
    }

    public function load_log_action()
    {
        $list = LogAction::limit(20)->latest()->select('id', 'description', 'created_at')->get();
        return view('user.pages.home.log_action', compact('list'))->render();
    }

    public function load_contact()
    {
        $list = Contact::limit(20)->latest()->select('id', 'name', 'phone', 'created_at')->get();
        return view('user.pages.home.contact', compact('list'))->render();
    }

    public function load_register_promo()
    {
        $list = RegisterPromo::limit(20)->latest()->select('id', 'name', 'phone', 'created_at')->get();
        return view('user.pages.home.register_promo', compact('list'))->render();
    }

    public function load_register_tour()
    {
        $list = RegisterTour::limit(20)->latest()->select('id', 'name', 'phone', 'created_at')->get();
        return view('user.pages.home.register_tour', compact('list'))->render();
    }

    public function delete_image()
    {
        $id = request('id', '');
        Images::where('id', $id)->delete();
        return response()->json([
            'status' => true,
        ]);
    }
}

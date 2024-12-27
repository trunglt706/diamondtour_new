<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactCreateRequest;
use App\Models\Contact;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $key = CACHE_CONTACT . '-index';
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $data = Cache::remember($key, CACHE_TIME, function () {
                $menu = Menu::ofCode('contact')->first();
                $seo = [
                    'image' => $menu->background,
                    'title' => $menu->name,
                    'description' => $menu->description,
                ];
                return [
                    'menu' => $menu,
                    'seo' => $seo
                ];
            });
        }
        return view('pages.contact', compact('data'));
    }

    public function create(ContactCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only('name', 'email', 'phone', 'comment');
            // chỉ cho phép gửi liên hệ 1 lần trong ngày từ email hoặc số ĐT
            $date = now()->format('Y-m-d');
            if (isset($data['phone'])) {
                $check = Contact::ofPhone($data['phone'])->whereDate('created_at', $date)->count();
                if ($check > 0) {
                    return redirect()->back()->with('error', 'Bạn đã gửi liên hệ trước đó!');
                }
            }
            $check = Contact::ofEmail($data['email'])->whereDate('created_at', $date)->count();
            if ($check > 0) {
                return redirect()->back()->with('error', 'Bạn đã gửi liên hệ trước đó!');
            }
            Contact::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Gửi thông tin liên hệ thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            showLog($th);
            return redirect()->back()->with('error', 'Gửi thông tin liên hệ thất bại!');
        }
    }
}

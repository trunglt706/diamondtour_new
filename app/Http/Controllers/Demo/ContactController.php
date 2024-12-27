<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    /**
     * Trang liên hệ
     */
    public function index()
    {
        if (Cache::has('demo_contact')) {
            $data = Cache::get('demo_contact');
        } else {
            $data = Cache::remember('demo_contact', CACHE_TIME, function () {
                $menu = Menu::ofCode('contact')->select('background', 'name', 'description', 'name_en', 'name_ch', 'description_en', 'description_ch')->first();
                return [
                    'type' => Contact::get_type(),
                    'menu' => $menu
                ];
            });
        }
        return view('guest.contact.index', compact('data'));
    }

    /**
     * Gửi thông tin liên hệ
     */
    public function create()
    {
        try {
            $data = request()->only('email', 'phone', 'comment', 'question');
            $requestCount = session()->get('contact_request_count', 0);
            if ($requestCount >= 1) {
                return redirect()->back()->with('error', 'Rất tiết, bạn đã vượt quá số lượng gửi yêu cầu trong ngày!');
            }
            $first_name = request('first_name', '');
            $data['name'] = $first_name ? $first_name . ' ' . request('last_name', '') : request('last_name', '');
            Contact::create($data);
            session()->put('contact_request_count', $requestCount + 1);
            return redirect()->back()->with('success', 'Gửi thông tin thành công');
        } catch (\Throwable $th) {
            showLog($th);
            return redirect()->back()->with('error', 'Gửi thông tin thất bại!');
        }
    }
}

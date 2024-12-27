<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Services;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    /**
     * Trang dịch vụ
     */
    public function index()
    {
        if (Cache::has('demo_service')) {
            $data = Cache::get('demo_service');
        } else {
            $data = Cache::remember('demo_service', CACHE_TIME, function () {
                $menu = Menu::ofCode('service')->select('background', 'name', 'description', 'name_en', 'name_ch', 'description_en', 'description_ch')->first();
                return [
                    'services' => Services::ofStatus(Services::STATUS_ACTIVE)->orderBy('numering', 'desc')->orderBy('created_at', 'desc')->select('image', 'id', 'backgrounds', 'name_en', 'name_ch', 'description_en', 'description_ch', 'name', 'description', 'link')->get(),
                    'menu' => $menu,
                ];
            });
        }
        return view('guest.service.index', compact('data'));
    }
    /**
     * Trang thanh toán
     */
    public function payment()
    {
        return view('guest.service.payment.index');
    }

    /**
     * Đăng ký dịch vụ
     */
    public function register() {}
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Auth\LoginSubmitRequest;
use App\Http\Requests\User\Auth\LoginViewRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Menu;
use App\Models\Module;
use App\Models\Setting;
use App\Models\SettingGroup;
use App\Models\Social;
use App\Models\UserMenu;

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

    public function sync()
    {
        $key = request('key', '');
        if ($key == 'diamontour') {
            //================= menu
            Menu::truncate();

            Menu::create([
                'code' => 'dashboard',
                'name' => 'Trang chủ',
                'link' => route('index'),
                'active' => '/'
            ]);
            Menu::create([
                'code' => 'about',
                'name' => 'Giới thiệu',
                'link' => route('about'),
                'active' => 'about'
            ]);
            Menu::create([
                'code' => 'destination',
                'name' => 'Điểm đến',
                'link' => route('destination.index'),
                'active' => 'destination*'
            ]);
            Menu::create([
                'code' => 'tour',
                'name' => 'Tour',
                'link' => route('tour.index'),
                'active' => 'tour*'
            ]);
            Menu::create([
                'code' => 'blog',
                'name' => 'Blog',
                'link' => route('blog.index'),
                'active' => 'blog*'
            ]);
            Menu::create([
                'code' => 'library',
                'name' => 'Thư viện',
                'link' => route('library.index'),
                'active' => 'library*'
            ]);

            //======================== module
            Module::truncate();

            Module::create([
                'code' => 'blog',
                'name' => 'Blog',
                'icon' => '<i class="fas fa-file-alt"></i>'
            ]);
            Module::create([
                'code' => 'destination',
                'name' => 'Điểm đến',
                'icon' => '<i class="fas fa-street-view"></i>'
            ]);
            Module::create([
                'code' => 'user',
                'name' => 'Quản trị viên',
                'icon' => '<i class="fas fa-user-circle"></i>'
            ]);
            Module::create([
                'code' => 'setting',
                'name' => 'Cài đặt',
                'icon' => '<i class="fas fa-tools"></i>'
            ]);
            Module::create([
                'code' => 'tour',
                'name' => 'Tour',
                'icon' => '<i class="fas fa-plane-departure"></i>'
            ]);
            Module::create([
                'code' => 'social',
                'name' => 'Social',
                'icon' => '<i class="fas fa-share-alt-square"></i>'
            ]);
            Module::create([
                'code' => 'review',
                'name' => 'Review',
                'icon' => '<i class="far fa-comments"></i>'
            ]);
            Module::create([
                'code' => 'newllter',
                'name' => 'Newllter',
                'icon' => '<i class="fas fa-mail-bulk"></i>'
            ]);
            Module::create([
                'code' => 'library',
                'name' => 'Thư viện',
                'icon' => '<i class="far fa-images"></i>'
            ]);
            Module::create([
                'code' => 'log_action',
                'name' => 'Nhật ký',
                'icon' => '<i class="fas fa-history"></i>'
            ]);
            Module::create([
                'code' => 'qa',
                'name' => 'Câu hỏi thường gặp',
                'icon' => '<i class="fas fa-question-circle"></i>'
            ]);
            Module::create([
                'code' => 'contact',
                'name' => 'Liên hệ',
                'icon' => '<i class="fas fa-file-signature"></i>'
            ]);
            Module::create([
                'code' => 'schedule',
                'name' => 'Lịch trình',
                'icon' => '<i class="far fa-calendar-check"></i>'
            ]);

            //====================== setting
            SettingGroup::truncate();
            Setting::truncate();

            //============= seo
            $seo = SettingGroup::create([
                'code' => 'seo',
                'name' => 'Tổng quan',
                'icon' => '<i class="fas fa-cog"></i>'
            ]);
            Setting::create([
                'group_id' => $seo->id,
                'code' => 'seo-logo',
                'name' => 'Logo website',
                'type' => Setting::TYPE_FILE,
                'value' => asset('assets/images/logo.png')
            ]);
            Setting::create([
                'group_id' => $seo->id,
                'code' => 'seo-favico',
                'name' => 'Favico website',
                'type' => Setting::TYPE_FILE,
                'value' => asset('assets/images/favico.png')
            ]);
            Setting::create([
                'group_id' => $seo->id,
                'code' => 'seo-name',
                'name' => 'Tên website',
                'value' => 'Diamontour'
            ]);
            Setting::create([
                'group_id' => $seo->id,
                'code' => 'seo-description',
                'name' => 'Mô tả website',
                'value' => 'Trang chủ Diamondtour Vinh hạnh mang đến trải nghiệm khác biệt trên mỗi hành trình!'
            ]);

            //============= other
            $other = SettingGroup::create([
                'code' => 'other',
                'name' => 'Khác',
                'icon' => '<i class="fas fa-th-list"></i>'
            ]);
            Setting::create([
                'group_id' => $other->id,
                'code' => 'copyright',
                'name' => 'Bản quyền',
                'value' => 'Copyright © 2023. Diamond Tour All rights reserved'
            ]);
            Setting::create([
                'group_id' => $other->id,
                'code' => 'google-map',
                'name' => 'Địa chỉ google map',
                'type' => Setting::TYPE_TEXT_AREA,
                'value' => '<iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14901.728939011884!2d105.776639!3d20.975304!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134532c18a3d7bb%3A0x361fc6ae597b821a!2zMTUgUGjhu5EgUGhhbiBIdXkgQ2jDuiwgUC4gWeG6v3QgS2nDqnUsIEjDoCDEkMO0bmcsIEjDoCBO4buZaSwgVmlldG5hbQ!5e0!3m2!1sen!2sus!4v1704746143770!5m2!1sen!2sus"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>'
            ]);
            Setting::create([
                'group_id' => $other->id,
                'code' => 'footer-info',
                'name' => 'Thông tin footer',
                'type' => Setting::TYPE_EDITOR,
                'value' => '<p>CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ PHÁT TRIỂN DU LỊCH KIM CƯƠNG (DIAMONDTOUR)<br>Địa chỉ: Số 15 ngõ 1, phố Phan Huy Chú, Yết Kiêu, Hà Đông, Hà Nội<br>Hotline:&nbsp;<b>0912 11 5515&nbsp; &nbsp; &nbsp; &nbsp;</b>Email: <strong>info@diamondtour.vn</strong><br>Số GPKD: 0107878502 do <span style="font-weight: 400;">Sở KH&amp;ĐT</span> Thành Phố Hà Nội cấp lần hai ngày 11/01/2019<br>Giấy phép lữ hành Quốc tế số: 01-931/2019/TCDL-GP LHQT cấp lần hai ngày 28/01/2019</p>'
            ]);

            //=================== social
            Social::truncate();

            Social::create([
                'code' => 'facebook',
                'name' => 'Facebook',
                'icon' => '<i class="fa-brands fa-square-facebook"></i>',
                'link' => 'https://www.facebook.com/diamondtourvn'
            ]);
            Social::create([
                'code' => 'instagram',
                'name' => 'Instagram',
                'icon' => '<i class="fa-brands fa-instagram"></i>'
            ]);
            Social::create([
                'code' => 'youtube',
                'name' => 'Youtube',
                'icon' => '<i class="fa-brands fa-youtube"></i>'
            ]);

            //==================== user menu
            UserMenu::truncate();

            UserMenu::create([
                'code' => 'dashboard',
                'name' => 'Trang chủ',
                'link' => route('user.index'),
                'active' => json_encode([
                    USER_PREFIX_ROUTE
                ]),
                'icon' => '<i class="fas fa-home"></i>'
            ]);
            UserMenu::create([
                'code' => 'user',
                'name' => 'Quản trị viên',
                'link' => route('user.user.index'),
                'active' => json_encode([
                    USER_PREFIX_ROUTE . '/user*',
                    USER_PREFIX_ROUTE . '/log_action*',
                    USER_PREFIX_ROUTE . '/profile*'
                ]),
                'icon' => '<i class="fas fa-user-circle"></i>'
            ]);
            UserMenu::create([
                'code' => 'tour',
                'name' => 'Tour',
                'link' => route('user.tour.index'),
                'active' => json_encode([
                    USER_PREFIX_ROUTE . '/tour*',
                    USER_PREFIX_ROUTE . '/tour_group*',
                    USER_PREFIX_ROUTE . '/tour_design*'
                ]),
                'icon' => '<i class="fas fa-plane-departure"></i>'
            ]);
            UserMenu::create([
                'code' => 'blog',
                'name' => 'Blog',
                'link' => route('user.blog.index'),
                'active' => json_encode([
                    USER_PREFIX_ROUTE . '/blog*',
                    USER_PREFIX_ROUTE . '/blog_group*'
                ]),
                'icon' => '<i class="fas fa-file-alt"></i>'
            ]);
            UserMenu::create([
                'code' => 'destination',
                'name' => 'Destination',
                'link' => route('user.destination.index'),
                'active' => json_encode([
                    USER_PREFIX_ROUTE . '/destination*',
                    USER_PREFIX_ROUTE . '/destination_group*'
                ]),
                'icon' => '<i class="fas fa-map-marker-alt"></i>'
            ]);
            UserMenu::create([
                'code' => 'setting',
                'name' => 'Cài đặt',
                'link' => route('user.setting.index'),
                'active' => json_encode([
                    USER_PREFIX_ROUTE . '/setting*',
                    USER_PREFIX_ROUTE . '/social*',
                    USER_PREFIX_ROUTE . '/qa*'
                ]),
                'icon' => '<i class="fas fa-tools"></i>'
            ]);

            //=================== user
            DB::table('log_actions')->delete();
            DB::table('users')->delete();

            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'status' => User::STATUS_ACTIVE
            ]);

            return 'Đồng bộ thành công';
        }
        return 'Lỗi xác thực!';
    }
}

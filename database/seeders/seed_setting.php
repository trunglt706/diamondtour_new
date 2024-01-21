<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\SettingGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seed_setting extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->delete();
        DB::table('setting_groups')->delete();

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
    }
}

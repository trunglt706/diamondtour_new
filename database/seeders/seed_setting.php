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

        //============= contact
        $contact = SettingGroup::create([
            'code' => 'contact',
            'name' => 'Trang liên hệ',
            'icon' => '<i class="far fa-id-badge"></i>'
        ]);
        Setting::create([
            'group_id' => $contact->id,
            'code' => 'contact-company',
            'name' => 'Tên công ty',
            'value' => 'CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ PHÁT TRIỂN DU LỊCH KIM CƯƠNG (DIAMONDTOUR)'
        ]);
        Setting::create([
            'group_id' => $contact->id,
            'code' => 'contact-address',
            'name' => 'Địa chỉ',
            'value' => 'Số 15 ngõ 1, phố Phan Huy Chú, Yết Kiêu, Hà Đông, Hà Nội'
        ]);
        Setting::create([
            'group_id' => $contact->id,
            'code' => 'contact-phone',
            'name' => 'Điện thoại',
            'value' => '0912 11 5515'
        ]);
        Setting::create([
            'group_id' => $contact->id,
            'code' => 'contact-email',
            'name' => 'Email',
            'value' => 'info@diamondtour.vn'
        ]);
        Setting::create([
            'group_id' => $contact->id,
            'code' => 'contact-more',
            'name' => 'Thông tin khác',
            'value' => 'Số GPKD: 0107878502'
        ]);

        //============= about
        $about = SettingGroup::create([
            'code' => 'about',
            'name' => 'Trang giới thiệu',
            'icon' => '<i class="fas fa-info-circle"></i>'
        ]);
        Setting::create([
            'group_id' => $about->id,
            'code' => 'contact-value',
            'name' => 'Giá trị khác biệt',
            'value' => 'Chúng tôi cùng phấn đấu để tạo ra sự khác biệt rõ ràng giữa Diamondtour và các công ty du lịch khác ở những điểm',
            'type' => Setting::TYPE_TEXT_AREA
        ]);
        Setting::create([
            'group_id' => $about->id,
            'code' => 'about-video-design-tour',
            'name' => 'Video giới thiệu',
            'value' => '<iframe width="1320px" height="650px"
                        src="https://www.youtube.com/embed/8GFuxiE3He4?autoplay=1&mute=1&loop=1&controls=0"
                        title="South East Asia - 1 Year around Asia | 4K Cinematic Travel Video" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>',
            'type' => Setting::TYPE_TEXT_AREA
        ]);
        Setting::create([
            'group_id' => $about->id,
            'code' => 'about-images',
            'name' => 'Hình ảnh giới thiệu',
            'value' => json_encode([
                asset('assets/images/about-us-image-1.jpg'),
                asset('assets/images/about-us-image-2.jpg'),
                asset('assets/images/about-us-image-3.jpg')
            ]),
            'description' => 'Số lượng ảnh là 3 ảnh',
            'data' => 3,
            'type' => Setting::TYPE_IMAGES
        ]);
        Setting::create([
            'group_id' => $about->id,
            'code' => 'about-content',
            'name' => 'Nội dung giới thiệu',
            'value' => '<p>Diamondtour là thương hiệu trực thuộc Công ty cổ phần đầu tư và phát triển du lịch Kim
                                    Cương. Thành lập kể từ tháng 6 năm 2017, Diamondtour luôn bám vững theo tiêu chí đặt
                                    khách hàng là trung tâm, minh bạch và đề cao chất lượng dịch vụ.</p>
                                <p>Với mục tiêu vươn cao và vươn xa hơn nữa trong ngành du lịch, Diamondtour vô cùng mong
                                    muốn được đón nhận niềm tin của quý khách hàng gửi trao, để chúng tôi vinh dự được phấn
                                    đấu và đồng hành cùng quý vị trên khắp các nẻo đường tới những nôi văn hóa, nền văn minh
                                    của nhân loại trên khắp thế giới, thả lòng thưởng ngoạn tiên cảnh chốn nhân gian, thể
                                    nghiệm cuộc sống khác mình ở những miền đất lạ, tìm ra những giá trị chân thực trong
                                    những chuyến đi… Đi thật xa để biết thật nhiều, để sống tốt và cống hiến nhiều hơn cho
                                    xã hội.</p>
                                <p>Chúng tôi tự hào là đơn vị tổ chức tour chuyên nghiệp, tâm huyết, luôn hướng tới những
                                    giá trị đẹp đẽ sâu sắc không chỉ về cảnh quan mà còn về văn hóa lịch sử trên mỗi hành
                                    trình, đem lại những trải nghiệm khó quên nhất cho du khách tại cả những địa điểm quen
                                    thuộc hay khác biệt.</p>
                                <p>Các dịch vụ nổi bật của chúng tôi gồm có:</p>
                                <ul>
                                    <li>Tour du lịch Hành hương</li>
                                    <li>Tour du lịch Người cao tuổi</li>
                                    <li>Tour du lịch VIP</li>
                                    <li>Tour Trekking, trải nghiệm…</li>
                                    <li>Tư vấn thiết kế chương trình theo yêu cầu</li>
                                    <li>Dịch vụ vé máy bay</li>
                                    <li>Dịch vụ Visa</li>
                                    <li>Và các dịch vụ lẻ khác (phòng khách sạn, xe du lịch…)</li>
                                </ul>',
            'type' => Setting::TYPE_EDITOR
        ]);
        Setting::create([
            'group_id' => $about->id,
            'code' => 'about-author',
            'name' => 'Giới thiệu tác giả',
            'value' => '<div class="row row-cols-1 row-cols-sm-2 align-items-center">
                <div class="col">
                    <div class="-image">
                    <img src="http://127.0.0.1:8000/assets/images/founder.jpg" class="img-fluid" alt="Image">
                    </div>
                    <div class="-content">
                    <h2>Mr. Trần Anh Tuấn (Đạo Liên)</h2>
                    <p>20+ năm kinh nghiệm trong lĩnh vực du lịch</p>
                    </div>
                </div>
                <div class="col">
                    <div class="-quote">
                    “Với chúng tôi, thành công không tính bằng lợi nhuận mà tính bằng giá trị trải nghiệm của Khách hàng trên mỗi hành trình!”
                    </div>
                </div>
                </div>',
            'type' => Setting::TYPE_EDITOR,
            'description' => 'Kích thước hình ảnh tác giả gợi ý: 960 x 600px'
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

        //============= destination
        $destination = SettingGroup::create([
            'code' => 'destination',
            'name' => 'Điểm đến',
            'icon' => '<i class="fas fa-map-marker-alt"></i>'
        ]);
        Setting::create([
            'group_id' => $destination->id,
            'code' => 'destination-country',
            'name' => 'Tên điểm đến theo quốc gia',
            'value' => 'Điểm đến theo quốc gia'
        ]);
        Setting::create([
            'group_id' => $destination->id,
            'code' => 'destination-province',
            'name' => 'Tên điểm đến theo khu vực',
            'value' => 'Điểm đến theo khu vực'
        ]);
        Setting::create([
            'group_id' => $destination->id,
            'code' => 'destination-image-1',
            'name' => 'Hình ảnh 1 (giá trị khác biệt)',
            'value' => asset('assets/images/other-image-distinctive-1.jpg'),
            'description' => 'Kích thước gợi ý: 839 × 350 px',
            'type' => Setting::TYPE_FILE,
        ]);
        Setting::create([
            'group_id' => $destination->id,
            'code' => 'destination-image-2',
            'name' => 'Hình ảnh 2 (giá trị khác biệt)',
            'value' => asset('assets/images/other-image-distinctive-2.jpg'),
            'description' => 'Kích thước gợi ý: 398 × 350 px',
            'type' => Setting::TYPE_FILE,
        ]);

        //============= dong_hanh
        $dong_hanh = SettingGroup::create([
            'code' => 'dong_hanh',
            'name' => 'Đồng hành cùng',
            'icon' => '<i class="fas fa-th-large"></i>'
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-title',
            'name' => 'Tiêu đề',
            'value' => 'Đồng hành cùng Diamondtour'
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-description',
            'name' => 'Mô tả',
            'value' => 'Lợi ích của khách hàng khi lựa chọn Diamondtour'
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-title_1',
            'name' => 'Tiêu đề 1',
            'value' => 'Dịch vụ Tour có chất lượng cao, tiêu chuẩn quốc tế'
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-content_1',
            'name' => 'Nội dung 1',
            'value' => 'Diamond Tour luôn có sự khảo sát địa điểm kỹ càng, cẩn thận, kết nối với đơn vị bản địa uy tín. Luôn bám sát và quan tâm đến nhu cầu và mong muốn của khách hàng. Đảm bảo sự an toàn và thoải mái trong mọi chuyến hành trình.',
            'type' => Setting::TYPE_TEXT_AREA
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-title_2',
            'name' => 'Tiêu đề 2',
            'value' => 'Hiệu quả và tiết kiệm chi phí'
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-content_2',
            'name' => 'Nội dung 2',
            'value' => 'Chúng tôi mang đến những trải nghiệm đặc biệt với chi phí hợp lý, phù hợp với khả năng của khách hàng.',
            'type' => Setting::TYPE_TEXT_AREA
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-title_3',
            'name' => 'Tiêu đề 3',
            'value' => 'Thoả mãn nhiều nhu cầu của quý khách hàng'
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-content_3',
            'name' => 'Nội dung 3',
            'value' => 'Với đội ngũ nhân sự nhiệt huyết và hiểu biết sâu sắc các nền văn hoá, các trải nghiệm đa quốc gia, chúng tôi có thể thiết kế các hành trình riêng theo nhu cầu của quý khách.',
            'type' => Setting::TYPE_TEXT_AREA
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-title_4',
            'name' => 'Tiêu đề 4',
            'value' => 'Minh bạch mọi dịch vụ'
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-content_4',
            'name' => 'Nội dung 4',
            'value' => 'Chi phí chúng tôi đưa ra minh bạch và rõ ràng',
            'type' => Setting::TYPE_TEXT_AREA
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-background',
            'name' => 'Hình ảnh',
            'value' => asset('assets/images/companion_banner_main.jpg'),
            'description' => 'Kích thước gợi ý: 839 × 924 px',
            'type' => Setting::TYPE_FILE,
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-thum-video-1',
            'name' => 'Ảnh đại diện video 1',
            'value' => asset('assets/images/companion_banner_video_1.jpg'),
            'description' => 'Kích thước gợi ý: 236 × 130 px',
            'type' => Setting::TYPE_FILE,
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-thum-video-2',
            'name' => 'Ảnh đại diện video 2',
            'value' => asset('assets/images/companion_banner_video_2.jpg'),
            'description' => 'Kích thước gợi ý: 236 × 130 px',
            'type' => Setting::TYPE_FILE,
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-video_1',
            'name' => 'Video 1',
            'value' => 'https://www.youtube.com/watch?v=4FUnXaq_VWk',
            'description' => 'Lấy đường dẫn từ youtube'
        ]);
        Setting::create([
            'group_id' => $dong_hanh->id,
            'code' => 'dong_hanh-video_2',
            'name' => 'Video 2',
            'value' => 'https://www.youtube.com/watch?v=4FUnXaq_VWk',
            'description' => 'Lấy đường dẫn từ youtube'
        ]);
    }
}

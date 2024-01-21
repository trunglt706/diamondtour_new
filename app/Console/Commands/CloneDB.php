<?php

namespace App\Console\Commands;

use App\Models\PostGroup;
use Illuminate\Console\Command;

class CloneDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clone-d-b';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //=============================== post
        $nhatky = PostGroup::create([
            'slug' => 'nhat-ky',
            'name' => 'Nhật ký hành trình',
            'image' => 'https://diamondtour.vn/wp-content/uploads/2020/05/8-co-lung-ta-tay-tang-565x380.jpg',
        ]);
        $link_group_nhat_ky = 'https://diamondtour.vn/nhat-ky/';
        $link_post_nhat_ky = [
            'https://diamondtour.vn/nhat-ky/an-do-tay-tang-va-cau-chuyen-cua-hinh-anh-phan-2/',
            'https://diamondtour.vn/nhat-ky/an-do-tay-tang-va-hinh-anh/',
            'https://diamondtour.vn/nhat-ky/cuu-trai-cau-cung-duong-vat-qua-hai-mua-thu-dong/',
            'https://diamondtour.vn/nhat-ky/nhat-ky-chuyen-di-thanh-ho-lhamulha/',
            'https://diamondtour.vn/nhat-ky/giang-sinh-yeu-thuong-noi-mien-tuyet-trang/',
            'https://diamondtour.vn/nhat-ky/i-miss-you-somuch-tibet/',
            'https://diamondtour.vn/nhat-ky/ladakh-tieu-tay-tang-tren-dat-an/',
            'https://diamondtour.vn/nhat-ky/ho-lo-co-vien-ngoc-giua-son-coc-2/',
            'https://diamondtour.vn/tin-tuc/du-lich-tay-tang-vao-mua-le-hoi-tai-sao-khong/',
            'https://diamondtour.vn/nhat-ky/tim-lai-chon-xua-tro-ve-nguon-coi/',
            'https://diamondtour.vn/nhat-ky/tay-tang-25-4-muon-ke-nhieu-hon-nua/',
            'https://diamondtour.vn/nhat-ky/chuyen-hanh-trinh-day-cam-xuc-khi-dat-chan-den-kailash/'
        ];

        $nhatky = PostGroup::create([
            'slug' => 'cam-nang',
            'name' => 'Cẩm nang kinh nghiệm',
            'image' => 'https://diamondtour.vn/wp-content/uploads/2023/07/z4392822083463_d13e706f21a7a73ff1ff15e9cc2b4472-565x380.jpg',
        ]);
        $link_group_hanh_trinh = 'https://diamondtour.vn/kinh-nghiem/';
        $link_post_hanh_trinh = [
            'https://diamondtour.vn/kinh-nghiem/nhung-dieu-can-luu-y-truoc-khi-den-tay-tang/',
            'https://diamondtour.vn/tin-tuc/bat-mi-bi-mat-dao-thanh-a-dinh-cua-ngo-nhan-gian/',
            'https://diamondtour.vn/tin-tuc/nhung-diem-den-khong-the-bo-lo-khi-toi-lhasa-tay-tang/',
            'https://diamondtour.vn/tin-tuc/du-lich-tay-tang-va-kham-pha-truyen-thuyet-ve-loai-hoa-tuyet-lien-hoa/',
            'https://diamondtour.vn/kinh-nghiem/ngoi-tau-len-lhasa/',
            'https://diamondtour.vn/kinh-nghiem/doc-dao-cac-tap-tuc-mai-tang-cua-nguoi-tay-tang/',
            'https://diamondtour.vn/kinh-nghiem/tong-quan-thoi-tiet-o-tay-tang/',
            'https://diamondtour.vn/kinh-nghiem/top-10-mon-ngon-phai-thu-khi-du-lich-tay-tang/',
            'https://diamondtour.vn/kinh-nghiem/ngam-co-lungta-tren-duong-du-lich-tay-tang/',
            'https://diamondtour.vn/kinh-nghiem/cam-nang-du-lich-tay-tang/',
            'https://diamondtour.vn/tin-tuc/am-thuc-dac-trung-o-xu-so-hanh-phuc-bhutan/',
            'https://diamondtour.vn/tin-tuc/nhung-dieu-can-biet-khi-di-du-lich-bhutan/',
            'https://diamondtour.vn/kinh-nghiem/den-tang-vao-mua-le-shoton-le-hoi-truyen-thong-tay-tang/',
            'https://diamondtour.vn/kinh-nghiem/nhung-loi-ich-khi-di-du-lich/',
            'https://diamondtour.vn/kinh-nghiem/mang-gi-khi-di-du-lich/',
            'https://diamondtour.vn/kinh-nghiem/kinh-nghiem-phong-tranh-phan-ung-do-cao/'
        ];
    }
}

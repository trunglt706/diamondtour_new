<?php

namespace App\Console\Commands;

use App\Models\Destination;
use App\Models\Review;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncDestination extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-destination';

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
        DB::table('destination_groups')->delete();
        DB::table('destinations')->delete();

        $content = '<p>Chùa Drikung thil nằm ở huyện Đông Mặc Trúc Công Khả, ngôi tự viện chốn tổ phái Drikung kayu. Tòa kiến trúc như dải lụa màu bordeaux vắt ngang trên sườn núi, phía dưới là dòng sông Tuyết Nhung.</p>
<p>Chùa được xây dựng vào năm 1179, các bộ phận kiến trúc chủ yếu gồm Kinh đường, Phật điện, Tàng kinh lầu, Đàn thành, hộ pháp điện và hệ thống mật thất tu hành. Trong đó, tòa linh tháp cao ba tầng bên trong tôn thờ xá lợi của tổ.</p>
<p><img decoding="async" class="aligncenter wp-image-2511" src="https://diamondtour.vn/wp-content/uploads/2020/05/toan-canh-chua-drikung.jpg" alt="" width="850" height="638" srcset="https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/toan-canh-chua-drikung.jpg 2048w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/toan-canh-chua-drikung-300x225.jpg 300w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/toan-canh-chua-drikung-1024x768.jpg 1024w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/toan-canh-chua-drikung-768x576.jpg 768w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/toan-canh-chua-drikung-1536x1152.jpg 1536w" sizes="(max-width: 850px) 100vw, 850px"></p>
<p>Tổ khai sáng là Nhân Khâm Bối (<strong>1143-1217</strong>) tên tiếng Phạn là Drigung Kyobpa Jikten Gönpo Rinchen Päl. Theo thống kê năm 2010 có khoảng 205 vị Lạt ma đang tu tập tại đây. Tổng diện tích toàn khu khoảng 3000m2.</p>
<p>Hàng năm, nhằm ngày 25 tháng 4 theo lịch Tây Tạng là ngày kỵ của tổ khai sáng tông phái.</p>
<p>Hiện nay, Mật giáo ở Việt Nam có rất nhiều hành giả thuộc hệ phái Drikung. Hàng năm, thường tổ chức các chuyến hành hương về chốn tổ nơi đây. Trong chùa cũng có hệ thống cư xá cho các hành giả phương xa về tu tập lưu trú. Tuy nhiên, để được lưu trú trực tiếp trong tự viên Drikung Thil phải đăng ký trước.</p>
<p>Trên thế giới có hai đài thiên táng nổi tiếng, một ở bên Ấn Độ và còn lại chính là đài thiên táng trên đỉnh núi chùa Drikung thil.</p>
<p><strong>Giao thông</strong>: Ngôi bảo sái cách trung tâm Lhasa 150km. Hàng ngày từ chùa Đại Chiêu đều có xe buyt khởi hành lúc 7:00. Đi về trong ngày sẽ mất 6h – 8h; giá vé 40 tệ. Thuê xe riêng khoảng 500 nhân dân tệ.</p>
<p><strong>Giá vé vào chùa</strong>: 50 tệ.</p>
<p><img decoding="async" loading="lazy" class="aligncenter wp-image-2510" src="https://diamondtour.vn/wp-content/uploads/2020/05/thung-lung-ben-duoi-chua-drikung.jpg" alt="" width="850" height="638" srcset="https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/thung-lung-ben-duoi-chua-drikung.jpg 2048w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/thung-lung-ben-duoi-chua-drikung-300x225.jpg 300w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/thung-lung-ben-duoi-chua-drikung-1024x768.jpg 1024w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/thung-lung-ben-duoi-chua-drikung-768x576.jpg 768w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/thung-lung-ben-duoi-chua-drikung-1536x1152.jpg 1536w" sizes="(max-width: 850px) 100vw, 850px"></p>
<p><img decoding="async" loading="lazy" class="aligncenter wp-image-2505" src="https://diamondtour.vn/wp-content/uploads/2020/05/canh-sac-ben-ngoai-chua-drikung.jpg" alt="" width="850" height="638" srcset="https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/canh-sac-ben-ngoai-chua-drikung.jpg 2048w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/canh-sac-ben-ngoai-chua-drikung-300x225.jpg 300w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/canh-sac-ben-ngoai-chua-drikung-1024x768.jpg 1024w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/canh-sac-ben-ngoai-chua-drikung-768x576.jpg 768w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/canh-sac-ben-ngoai-chua-drikung-1536x1152.jpg 1536w" sizes="(max-width: 850px) 100vw, 850px"></p>
<p><img decoding="async" loading="lazy" class="aligncenter wp-image-2506" src="https://diamondtour.vn/wp-content/uploads/2020/05/chua-drikung-05.jpg" alt="" width="850" height="638" srcset="https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/chua-drikung-05.jpg 2048w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/chua-drikung-05-300x225.jpg 300w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/chua-drikung-05-1024x768.jpg 1024w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/chua-drikung-05-768x576.jpg 768w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/chua-drikung-05-1536x1152.jpg 1536w" sizes="(max-width: 850px) 100vw, 850px"></p>
<p><img decoding="async" loading="lazy" class="aligncenter wp-image-2508" src="https://diamondtour.vn/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-scaled.jpg" alt="" width="850" height="1133" srcset="https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-scaled.jpg 1920w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-225x300.jpg 225w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-768x1024.jpg 768w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-1152x1536.jpg 1152w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-1536x2048.jpg 1536w" sizes="(max-width: 850px) 100vw, 850px"></p>
<p><img decoding="async" loading="lazy" class="aligncenter wp-image-2509" src="https://diamondtour.vn/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-2.jpg" alt="" width="850" height="638" srcset="https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-2.jpg 2048w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-2-300x225.jpg 300w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-2-1024x768.jpg 1024w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-2-768x576.jpg 768w, https://dev-diamondtour.pantheonsite.io/wp-content/uploads/2020/05/mot-loi-di-len-chua-drikung-2-1536x1152.jpg 1536w" sizes="(max-width: 850px) 100vw, 850px"></p>
<p>&nbsp;</p>';

        //==================
        $taytang = Destination::create([
            'name' => 'Tây Tạng',
            'image' => asset('assets/images/destination-home-pv-1.jpg'),
            'type' => Destination::TYPE_NATIONAL,
            'description' => 'Chùa Drikung thil nằm ở huyện Đông Mặc Trúc Công Khả, ngôi tự viện chốn tổ phái Drikung kayu. Tòa kiến trúc như dải lụa màu bordeaux vắt ngang trên sườn núi, phía dưới là dòng sông Tuyết Nhung.',
            'content' => $content,
            'status' => Destination::STATUS_ACTIVE,
            'why' => json_encode([
                [
                    'title' => 'Reason 1',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 2',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 3',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 4',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 5',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ]
            ]),
            'plan' => json_encode([
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.',
                'images' => [
                    asset('assets/images/slider.png'),
                    asset('assets/images/slider1.png'),
                ]
            ])
        ]);
        for ($j = 0; $j < 4; $j++) {
            Review::create([
                'name' => 'Designation',
                'destination_id' => $taytang->id,
                'user_name' => 'Louna Daniel',
                'user_avatar' => asset('assets/images/testimonial-item.jpg'),
                'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis'
            ]);
        }

        //==================
        $trungquoc = Destination::create([
            'name' => 'Trung Quốc',
            'image' => asset('assets/images/destination-home-pv-2.jpg'),
            'type' => Destination::TYPE_NATIONAL,
            'description' => 'Chùa Drikung thil nằm ở huyện Đông Mặc Trúc Công Khả, ngôi tự viện chốn tổ phái Drikung kayu. Tòa kiến trúc như dải lụa màu bordeaux vắt ngang trên sườn núi, phía dưới là dòng sông Tuyết Nhung.',
            'content' => $content,
            'status' => Destination::STATUS_ACTIVE,
            'why' => json_encode([
                [
                    'title' => 'Reason 1',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 2',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 3',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 4',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 5',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ]
            ]),
            'plan' => json_encode([
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.',
                'images' => [
                    asset('assets/images/slider.png'),
                    asset('assets/images/slider1.png'),
                ]
            ])
        ]);
        for ($j = 0; $j < 4; $j++) {
            Review::create([
                'name' => 'Designation',
                'destination_id' => $trungquoc->id,
                'user_name' => 'Louna Daniel',
                'user_avatar' => asset('assets/images/testimonial-item.jpg'),
                'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis'
            ]);
        }

        //==================
        $ando = Destination::create([
            'name' => 'Ấn Độ',
            'image' => asset('assets/images/destination-home-pv-3.jpg'),
            'type' => Destination::TYPE_NATIONAL,
            'description' => 'Chùa Drikung thil nằm ở huyện Đông Mặc Trúc Công Khả, ngôi tự viện chốn tổ phái Drikung kayu. Tòa kiến trúc như dải lụa màu bordeaux vắt ngang trên sườn núi, phía dưới là dòng sông Tuyết Nhung.',
            'content' => $content,
            'status' => Destination::STATUS_ACTIVE,
            'why' => json_encode([
                [
                    'title' => 'Reason 1',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 2',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 3',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 4',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 5',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ]
            ]),
            'plan' => json_encode([
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.',
                'images' => [
                    asset('assets/images/slider.png'),
                    asset('assets/images/slider1.png'),
                ]
            ])
        ]);
        for ($j = 0; $j < 4; $j++) {
            Review::create([
                'name' => 'Designation',
                'destination_id' => $ando->id,
                'user_name' => 'Louna Daniel',
                'user_avatar' => asset('assets/images/testimonial-item.jpg'),
                'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis'
            ]);
        }

        //==================
        $pakistan = Destination::create([
            'name' => 'Pakistan',
            'image' => asset('assets/images/destination-home-pv-4.jpg'),
            'type' => Destination::TYPE_NATIONAL,
            'description' => 'Chùa Drikung thil nằm ở huyện Đông Mặc Trúc Công Khả, ngôi tự viện chốn tổ phái Drikung kayu. Tòa kiến trúc như dải lụa màu bordeaux vắt ngang trên sườn núi, phía dưới là dòng sông Tuyết Nhung.',
            'content' => $content,
            'status' => Destination::STATUS_ACTIVE,
            'why' => json_encode([
                [
                    'title' => 'Reason 1',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 2',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 3',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 4',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 5',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ]
            ]),
            'plan' => json_encode([
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.',
                'images' => [
                    asset('assets/images/slider.png'),
                    asset('assets/images/slider1.png'),
                ]
            ])
        ]);
        for ($j = 0; $j < 4; $j++) {
            Review::create([
                'name' => 'Designation',
                'destination_id' => $pakistan->id,
                'user_name' => 'Louna Daniel',
                'user_avatar' => asset('assets/images/testimonial-item.jpg'),
                'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis'
            ]);
        }

        //==================
        $nepan = Destination::create([
            'name' => 'Nepan',
            'image' => asset('assets/images/destination-home-pv-5.jpg'),
            'type' => Destination::TYPE_NATIONAL,
            'description' => 'Chùa Drikung thil nằm ở huyện Đông Mặc Trúc Công Khả, ngôi tự viện chốn tổ phái Drikung kayu. Tòa kiến trúc như dải lụa màu bordeaux vắt ngang trên sườn núi, phía dưới là dòng sông Tuyết Nhung.',
            'content' => $content,
            'status' => Destination::STATUS_ACTIVE,
            'why' => json_encode([
                [
                    'title' => 'Reason 1',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 2',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 3',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 4',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 5',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ]
            ]),
            'plan' => json_encode([
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.',
                'images' => [
                    asset('assets/images/slider.png'),
                    asset('assets/images/slider1.png'),
                ]
            ])
        ]);
        for ($j = 0; $j < 4; $j++) {
            Review::create([
                'name' => 'Designation',
                'destination_id' => $nepan->id,
                'user_name' => 'Louna Daniel',
                'user_avatar' => asset('assets/images/testimonial-item.jpg'),
                'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis'
            ]);
        }

        //==================
        $bhutan = Destination::create([
            'name' => 'Phutan',
            'image' => asset('assets/images/destination-home-pv-6.jpg'),
            'type' => Destination::TYPE_NATIONAL,
            'description' => 'Chùa Drikung thil nằm ở huyện Đông Mặc Trúc Công Khả, ngôi tự viện chốn tổ phái Drikung kayu. Tòa kiến trúc như dải lụa màu bordeaux vắt ngang trên sườn núi, phía dưới là dòng sông Tuyết Nhung.',
            'content' => $content,
            'status' => Destination::STATUS_ACTIVE,
            'why' => json_encode([
                [
                    'title' => 'Reason 1',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 2',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 3',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 4',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ], [
                    'title' => 'Reason 5',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.'
                ]
            ]),
            'plan' => json_encode([
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.',
                'images' => [
                    asset('assets/images/slider.png'),
                    asset('assets/images/slider1.png'),
                ]
            ])
        ]);
        for ($j = 0; $j < 4; $j++) {
            Review::create([
                'name' => 'Designation',
                'destination_id' => $bhutan->id,
                'user_name' => 'Louna Daniel',
                'user_avatar' => asset('assets/images/testimonial-item.jpg'),
                'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis'
            ]);
        }

        Destination::create([
            'name' => 'Chùa Samuye',
            'image' => asset('assets/images/tour_home_1.png'),
            'type' => Destination::TYPE_LOCAL,
            'description' => 'Chùa Drikung thil nằm ở huyện Đông Mặc Trúc Công Khả, ngôi tự viện chốn tổ phái Drikung kayu. Tòa kiến trúc như dải lụa màu bordeaux vắt ngang trên sườn núi, phía dưới là dòng sông Tuyết Nhung.',
            'content' => $content,
            'status' => Destination::STATUS_ACTIVE,
            'address' => 'Tây Tạng'
        ]);
        Destination::create([
            'name' => 'Thiên phật động',
            'image' => asset('assets/images/tour_home_1.png'),
            'type' => Destination::TYPE_LOCAL,
            'description' => 'Chùa Drikung thil nằm ở huyện Đông Mặc Trúc Công Khả, ngôi tự viện chốn tổ phái Drikung kayu. Tòa kiến trúc như dải lụa màu bordeaux vắt ngang trên sườn núi, phía dưới là dòng sông Tuyết Nhung.',
            'content' => $content,
            'status' => Destination::STATUS_ACTIVE,
            'address' => 'Tang Cương'
        ]);
        Destination::create([
            'name' => 'Chùa Drukpa',
            'image' => asset('assets/images/tour_home_1.png'),
            'type' => Destination::TYPE_LOCAL,
            'description' => 'Chùa Drikung thil nằm ở huyện Đông Mặc Trúc Công Khả, ngôi tự viện chốn tổ phái Drikung kayu. Tòa kiến trúc như dải lụa màu bordeaux vắt ngang trên sườn núi, phía dưới là dòng sông Tuyết Nhung.',
            'content' => $content,
            'status' => Destination::STATUS_ACTIVE,
            'address' => 'Tây Tạng'
        ]);
        Destination::create([
            'name' => 'Cung điện Potala',
            'image' => asset('assets/images/tour_home_1.png'),
            'type' => Destination::TYPE_LOCAL,
            'description' => 'Chùa Drikung thil nằm ở huyện Đông Mặc Trúc Công Khả, ngôi tự viện chốn tổ phái Drikung kayu. Tòa kiến trúc như dải lụa màu bordeaux vắt ngang trên sườn núi, phía dưới là dòng sông Tuyết Nhung.',
            'content' => $content,
            'status' => Destination::STATUS_ACTIVE,
            'address' => 'Lhasa'
        ]);
    }
}

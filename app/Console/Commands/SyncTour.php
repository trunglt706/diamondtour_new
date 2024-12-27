<?php

namespace App\Console\Commands;

use App\Models\Countries;
use App\Models\Schedule;
use App\Models\ScheduleDetal;
use App\Models\Tour;
use App\Models\TourGroup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncTour extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-tour';

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
        DB::table('tours')->delete();
        DB::table('tour_groups')->delete();

        for ($i = 0; $i < 4; $i++) {
            $group = TourGroup::create([
                'name' => 'Danh mục tour ' . $i,
                'image' => asset('assets/images/blog-mansory-2.png'),
                'description' => 'Cùng Diamondtour tiếp tục sứ mệnh khắc họa rõ nét bức tranh trên tấm bản đồ Cung đường giao lưu văn hóa Đông - Tây vĩ đại nhất trong lịch sử! Từ Tây An, Đôn Hoàng, Lạc Dương, Tân Cương sang các quốc gia Trung Á và Tây Á'
            ]);
            for ($j = 0; $j < 10; $j++) {
                $tour = Tour::create([
                    'slug' => generateRandomString(),
                    'group_id' => $group->id,
                    'name' => 'Tour mẫu ' . $j,
                    'image' => asset('assets/images/blog-mansory-2.png'),
                    'status' => Tour::STATUS_ACTIVE,
                    'description' => 'Vùng đất Giang Nam từ cổ chí kim đã được mệnh danh là thánh địa văn chương, vườn địa đàng của tình yêu đôi lứa. Chốn Giang Nam yên bình, tình tứ đẹp tựa như bóng hình người thiếu nữ bước ra từ những bộ phim cổ trang đằm thắm. Để miêu tả cảnh sắc đẹp tựa giấc mơ, trong tác phẩm “Ngô Quận Chí”, Phạm Thành Đại đời Tống đã viết rằng: “Trên có thiên đàng, dưới có Tô – Hàng”. Cảnh vật yên bình ấy dường như còn có sức hút mãnh liệt khiến Vua Càn Long đời Thanh thường xuyên “trốn” việc triều chính để về đây an dưỡng, nghỉ ngơi',
                    'content' => '<p>Vùng đất Giang Nam từ cổ chí kim đã được mệnh danh là thánh địa văn chương, vườn địa đàng của tình yêu đôi lứa. Chốn Giang Nam yên bình, tình tứ đẹp tựa như bóng hình người thiếu nữ bước ra từ những bộ phim cổ trang đằm thắm. Để miêu tả cảnh sắc đẹp tựa giấc mơ, trong tác phẩm “Ngô Quận Chí”, Phạm Thành Đại đời Tống đã viết rằng: “Trên có thiên đàng, dưới có Tô – Hàng”. Cảnh vật yên bình ấy dường như còn có sức hút mãnh liệt khiến Vua Càn Long đời Thanh thường xuyên “trốn” việc triều chính để về đây an dưỡng, nghỉ ngơi.</p><p>Diamondtour lên chương trình khởi duyên Nam Giang – Hoàng Sơn, hành trình tìm về áng văn bất hủ “Phong Kiều dạ bạc” với ánh trăng tà lung linh mặt nước và khung cảnh hùng vĩ của ngọn Hoàng Sơn – nơi được mệnh danh là “thiên hạ đệ nhất kì sơn”, một kỳ tích mà tạo hóa ban tặng cho đất nước Trung Hoa.</p>',
                    'include' => '<p>- Khách sạn 4 sao tiêu chuẩn địa phương theo chương trình (2 người/phòng. Nếu lẻ ở ghép 3 người/phòng).<br>- Các bữa ăn theo chương trình.<br>- Xe: Ô tô tiện nghi phục vụ suốt hành trình.<br>- Vé máy bay theo chương trình.<br>- Vé thắng cảnh vào cửa tham quan lần 1 trong chương trình.<br>- Visa đoàn nhập cảnh vào Trung Quốc.<br>- Hướng dẫn viên song ngữ Trung – Việt suốt hành trình.<br>- TIP cho HDV và lái xe 8USD/pax/ngày.<br>- Không vào các cửa hàng mua sắm theo tour thông thường (chi phí đã bù shop 500 tệ/người).<br>- Bảo hiểm du lịch mức tối đa 30.000USD/người/hành trình.<br>- Mỗi khách mỗi ngày 2 chai nước.</p>',
                    'exclude' => '<p>- Chi phí phòng đơn.<br>- Chi phí check in sớm/check out muộn.<br>- Chi phí cá nhân: Giặt là, đồ uống, điện thoại,…<br>- Thuế VAT.<br>- Các chi phí không nêu trong phần bao gồm trên.</p>',
                    'term' => '<p><strong>Điều kiện đăng ký tour:</strong><br>- Quý khách có đầy đủ sức khỏe tham gia chương trình.<br>- Đặt cọc 15 triệu/1 khách khi đăng kí chương trình.<br>- Thanh toán toàn bộ số tiền trước 20 ngày khởi hành.<br>- Hộ chiếu đảm bảo còn thời hạn trên 6 tháng tính đến ngày về.</p><p><strong>Các điều kiện huỷ tour:</strong><br>- Ngay sau khi đặt cọc: Không hoàn lại số tiền đă đặt cọc.<br>- Trước ngày khởi hành 20 ngày: Phí hủy là 60% tiền tour.<br>- Từ trước 8 – 20 ngày trước ngày khởi hành: Phí hủy là 85% tiền tour.<br>- Từ trước 4 – 7 ngày khởi hành: Phí hủy là 90% tiền tour.<br>- Trước 03 ngày khởi hành: Chúng tôi sẽ hoàn lại khách hàng nhiều nhất có thể sau khi trừ đi chi phí thực tế khách bị charge khi không tham gia tour.</p>',
                    'notice' => '<p>- Khi đăng ký tour du lịch, Quý khách vui lòng đọc kỹ chương trình, giá tour, các khoản bao gồm cũng như không bao gồm trong chương trình, các điều kiện hủy tour. Trong trường hợp Quý khách không trực tiếp đến đăng ký tour mà do người khác đến đăng ký thì Quý khách vui lòng tìm hiểu kỹ chương trình từ người đăng ký cho mình.<br>- Trong trường hợp quý khách chưa tiêm phòng 2 mũi vacxin Covid 19, cần tự test PCR và lấy chứng nhận bản song ngữ trước khi bay.<br>- Do các chuyến bay phụ thuộc vào các hãng hàng không nên trong một số trường hợp giờ bay có thể thay đổi mà không được báo trước.<br>- Tùy vào tình hình thực tế, thứ tự các điểm tham quan trong chương trình có thể thay đổi nhưng vẫn đảm bảo đầy đủ các điểm thăm quan như chương trình lúc đầu.<br>- Trong trường hợp xảy ra thiên tai: bão lụt, hạn hán, động đất…; Sự cố về an ninh: khủng bố, biểu tình; Sự cố về hàng không: trục trặc kỹ thuật, an ninh, dời, hủy, hoãn chuyến bay, chúng tôi sẽ xem xét để hoàn trả chi phí không thăm quan cho khách trong điều kiện có thể (Sau khi đã trừ lại các dịch vụ đã thực hiện như phí làm visa. Và không chịu trách nhiệm bồi thường thêm bất kỳ chi phí nào khác).</p>',
                    'price' => 2000000,
                    'currency' => 'VND',
                    'from' => now()->format('Y-m-d'),
                    'to' => now()->addMonth()->format('Y-m-d'),
                    'country_id' => Countries::first()->id,
                    'duration' => '2N1Đ',
                    'images' => json_encode([
                        [
                            'id' => 1,
                            'image' => asset('assets/images/jelusalem1.jpg'),
                            'name' => 'Biển chết'
                        ], [
                            'id' => 2,
                            'image' => asset('assets/images/jelusalem2.jpg'),
                            'name' => 'Biển chết'
                        ], [
                            'id' => 3,
                            'image' => asset('assets/images/jelusalem3.jpg'),
                            'name' => 'Biển chết'
                        ], [
                            'id' => 4,
                            'image' => asset('assets/images/jelusalem4.jpg'),
                            'name' => 'Biển chết'
                        ], [
                            'id' => 5,
                            'image' => asset('assets/images/jelusalem5.jpg'),
                            'name' => 'Biển chết'
                        ], [
                            'id' => 6,
                            'image' => asset('assets/images/jelusalem6.jpg'),
                            'name' => 'Biển chết'
                        ],
                    ])
                ]);
                $schedule = Schedule::create([
                    'name' => 'Ngày 1',
                    'description' => 'VIỆT NAM - NAZARETH',
                    'tour_id' => $tour->id,
                    'image' => asset('assets/images/jelusalem5.jpg')
                ]);
                ScheduleDetal::create([
                    'schedule_id' => $schedule->id,
                    'name' => 'Jordan',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                                do eiusmod tempor incididunt ut labore et dolore magna
                                                                aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                                                ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                Duis aute irure dolor in reprehenderit.'
                ]);
                ScheduleDetal::create([
                    'schedule_id' => $schedule->id,
                    'name' => 'Nhà thờ truyền tin',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                                do eiusmod tempor incididunt ut labore et dolore magna
                                                                aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                                                ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                Duis aute irure dolor in reprehenderit.'
                ]);
            }
        }
    }
}

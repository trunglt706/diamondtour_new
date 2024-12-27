<?php

namespace App\Console\Commands;

use App\Models\Qa;
use App\Models\QaGroup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncQa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-qa';

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
        DB::table('qas')->delete();
        DB::table('qa_groups')->delete();

        //======================
        $group1 = QaGroup::create([
            'name' => 'I - CÂU HỎI CHUNG'
        ]);
        Qa::create([
            'group_id' => $group1->id,
            'name' => '1. Làm Thế Nào Để Đặt Tour Du Lịch Của Diamondtour?',
            'description' => 'Để có thể đặt tour du lịch của chúng tôi nhanh chóng và thuận tiện, Quý khách có thể đăng kí trực tiếp qua website: diamondtour.vn theo hướng dẫn đặt mua tour du lịch online và điền theo form mẫu. Chúng tôi sẽ xác nhận và gửi thư liên hệ qua email. Quý khách có thể liên hệ trực tiếp qua Facebook Diamond Tour hoặc Hotline/Zalo 0905 615 666 để được tư vấn nhanh nhất.'
        ]);
        Qa::create([
            'group_id' => $group1->id,
            'name' => '2. Nếu Có Nhu Cầu Tham Gia, Tôi Cần Đăng Ký Tour Trước Khoảng Bao Lâu?',
            'description' => 'Tùy vào tính chất tour Quý khách đăng ký tham gia, hạn cuối đăng ký sẽ dao động trong khoảng từ 10 - 20 ngày trước ngày khởi hành. Diamondtour khuyến khích Quý khách nên đặt tour càng sớm càng tốt để thuận tiện trong việc giải quyết các vấn đề thủ tục phát sinh.'
        ]);
        Qa::create([
            'group_id' => $group1->id,
            'name' => '3. Nếu Muốn Nhận Được Tư Vấn, Hỗ Trợ, Tôi Có Thể Liên Lạc Cho Ai?',
            'description' => 'Quý khách vui lòng liên hệ số Hotline 0905 615 666 hoặc nhắn tin qua Facebook Diamond Tour để được tư vấn và hỗ trợ nhanh nhất.'
        ]);
        Qa::create([
            'group_id' => $group1->id,
            'name' => '4. Chính Sách Hoàn Hủy Của Diamondtour Như Thế Nào?',
            'description' => '
                                                    Diamondtour luôn khuyến khích Quý khách hàng cân nhắc thật kỹ (về lịch
                                                    trình, chi phí và điều khoản ghi trong chương trình) trước khi đăng ký
                                                    tham gia tour. Tuy nhiên trường hợp Quý khách đã đăng ký nhưng không thể
                                                    tham gia, chúng tôi có chính sách hoàn hủy như sau:
                                                    <ul>
                                                        <li>Ngay sau khi đặt cọc: Không hoàn lại số tiền đã đặt cọc.</li>
                                                        <li>Trước ngày khởi hành 20 ngày: Phí hủy là 60% chi phí tour.</li>
                                                        <li>Từ trước 8 – 20 ngày trước ngày khởi hành: Phí hủy là 85% chi
                                                            phí tour.</li>
                                                        <li>Từ trước 4 – 7 ngày khởi hành: Phí hủy là 90% chi phí tour.</li>
                                                        <li>Trước 03 ngày khởi hành: Chúng tôi sẽ hoàn lại khách hàng nhiều
                                                            nhất có thể sau khi trừ đi chi phí thực tế khách bị phụ thu khi
                                                            không tham gia tour</li>
                                                    </ul>'
        ]);
        Qa::create([
            'group_id' => $group1->id,
            'name' => '5. Tôi Có Thể Thay Đổi Các Thông Tin Khách Hàng Như: Tên Khách Đi Tour, Địa Chỉ Và Điện Thoại,… Được Không?',
            'description' => '
                                                    Có. Tuy nhiên còn tùy thuộc vào thời điểm Quý khách yêu cầu.
                                                    <ul>
                                                        <li>Trường hợp thay đổi thông tin khi chưa có booking dịch vụ, Quý
                                                            khách sẽ được hỗ trợ thay đổi miễn phí. </li>
                                                        <li>Trường hợp thay đổi khi đã có booking dịch vụ, Quý khách phải
                                                            chịu chi phí thay đổi thông tin theo quy định của Hãng hàng
                                                            không (vé máy bay) hoặc Tổng công ty đường sắt (vé tàu). </li>
                                                    </ul>
                                                    Vui lòng liên hệ Hotline 0905 615 666 để được hỗ trợ chi tiết và nhanh
                                                    chóng.'
        ]);
        Qa::create([
            'group_id' => $group1->id,
            'name' => '6. Tôi Ăn Chay Hoặc Có Chế Độ Ăn Đặc Biệt, Không Muốn Ăn Chung Với Đoàn Thì Thế Nào?',
            'description' => 'Quý khách có thể ăn tự túc, Diamondtour sẽ trừ chi phí các bữa ăn tương ứng mà Quý khách không sử dụng. Vui lòng báo trước cho nhân viên Diamondtour để chúng tôi sắp xếp và hỗ trợ tối đa cho Quý khách trong quá trình tham gia tour.'
        ]);
        Qa::create([
            'group_id' => $group1->id,
            'name' => '7. Công Ty Có Dịch Vụ Làm Visa Không?',
            'description' => '<ul>
                                                        <li>Hiện Diamondtour có dịch vụ tư vấn và hỗ trợ Quý khách làm visa
                                                            nhập cảnh hai nước Trung Quốc, Ấn Độ và xin giấy phép vào Tây
                                                            Tạng.</li>
                                                        <li>Ngoài ra, chúng tôi còn tư vấn và hỗ trợ làm visa nhập cảnh cho
                                                            người Đài Loan vào Việt Nam.</li>
                                                    </ul>'
        ]);
        Qa::create([
            'group_id' => $group1->id,
            'name' => '8. Thanh Toán Khi Đặt Tour Như Thế Nào?',
            'description' => '<ul>
                                                        <li>Diamondtour chấp nhận hình thức thanh toán bằng tiền mặt và
                                                            chuyển khoản.</li>
                                                        <li>Quý khách cần đặt cọc 50% chi phí tour tại thời điểm đăng ký
                                                            chương trình và thanh toán 100% chi phí tour trước 20 ngày khởi
                                                            hành.</li>
                                                    </ul>'
        ]);

        //======================
        $group2 = QaGroup::create([
            'name' => 'II - CÂU HỎI VỀ VISA'
        ]);
        Qa::create([
            'group_id' => $group2->id,
            'name' => '1. Làm Visa Trung Quốc Mất Bao Lâu? Thủ Tục Cần Chuẩn Bị Những Gì?',
            'description' => '<ul>
                                                        <li style="font-weight: 400"><span style="font-weight: 400">Kết
                                                                quả visa Trung Quốc sẽ có sau khoảng 3 - 5 ngày làm việc kể
                                                                từ ngày lấy vân tay tại Trung tâm Thị thực. Tùy thuộc vào
                                                                thời điểm xin visa, tổng thời gian mất khoảng 10 - 12 ngày
                                                                làm việc.</span></li>
                                                        <li style="font-weight: 400"><span style="font-weight: 400">Thủ
                                                                tục cơ bản cần chuẩn bị khi xin visa du lịch Trung
                                                                Quốc:</span></li>
                                                    </ul>
                                                    <ol>
                                                        <li><span style="font-weight: 400"> Hộ chiếu:</span></li>
                                                    </ol>
                                                    <p><span style="font-weight: 400">- Hộ chiếu bản gốc: thời hạn còn ít
                                                            nhất 6 tháng kể từ ngày nộp đơn, ít nhất 2 trang thị thực còn
                                                            trống.</span></p>
                                                    <p><span style="font-weight: 400">- Một bản photo các trang có thông
                                                            tin của hộ chiếu.</span></p>
                                                    <ol start="2">
                                                        <li><span style="font-weight: 400"> Ảnh:</span></li>
                                                    </ol>
                                                    <p><span style="font-weight: 400">- 01 file ảnh mềm, định dạng jpg., và
                                                            02 file ảnh cứng: yêu cầu chụp gần nhất, chính diện, ảnh màu,
                                                            phông nền trắng, không đội mũ, kích thước: 48mm × 33mm.</span>
                                                    </p>
                                                    <ol start="3">
                                                        <li><span style="font-weight: 400"> CCCD photo.</span></li>
                                                        <li><span style="font-weight: 400"> Thị thực Trung Quốc cũ được cấp
                                                                lần gần nhất (áp dụng cho trường hợp đã từng được cấp thị
                                                                thực Trung Quốc).</span></li>
                                                        <li><span style="font-weight: 400"> Thông tin người liên hệ khẩn
                                                                cấp tại Việt Nam: Họ và tên; Ngày tháng năm sinh; Nơi sinh,
                                                                Số điện thoại, Nơi ở hiện tại</span></li>
                                                    </ol>
                                                    <p><span style="font-weight: 400">- Đối với người chưa kết hôn: người
                                                            liên hệ khẩn cấp là bố và mẹ.</span></p>
                                                    <p><span style="font-weight: 400">- Đối với người đã kết hôn: người
                                                            liên hệ khẩn cấp là chồng hoặc vợ.</span></p>
                                                    <ul>
                                                        <li style="font-weight: 400"><span style="font-weight: 400">Ngoài
                                                                ra, đối với từng dạng visa khác sẽ cần thêm giấy tờ thủ tục
                                                                khác nhau. Vui lòng liên hệ Hotline 0905 615 666 để được tư
                                                                vấn thêm.</span></li>
                                                    </ul>'
        ]);
        Qa::create([
            'group_id' => $group2->id,
            'name' => '2. Làm Visa Ấn Độ Mất Bao Lâu? Thủ Tục Cần Chuẩn Bị Những Gì?',
            'description' => '<ul>
                                                        <li style="font-weight: 400"><span style="font-weight: 400">Visa
                                                                Ấn Độ được xin theo dạng visa điện tử (e-Visa), thời gian có
                                                                kết quả mất khoảng 3 ngày làm việc.</span></li>
                                                        <li style="font-weight: 400"><span style="font-weight: 400">Quý
                                                                khách vui lòng điền thông tin vào tờ khai có sẵn do
                                                                Diamondtour cung cấp theo đường link:
                                                                https://forms.gle/p2hoaFhTLu6qmUZW8</span></li>
                                                        <li style="font-weight: 400"><span style="font-weight: 400">01
                                                                file mềm ảnh chân dung 4x6 (Yêu cầu: nhân vật không mang,
                                                                đeo phụ kiện như kính, khuyên tai, khi chụp ngay ngắn, hở
                                                                đuôi tai, mặc áo có cổ). (Theo M01)</span></li>
                                                        <li style="font-weight: 400"><span style="font-weight: 400">Chụp
                                                                ảnh (Scan) mặt hộ chiếu trang 02 và 03, những trang có dấu
                                                                xuất nhập cảnh trong hộ chiếu. (mẫu 02)</span></li>
                                                        <li style="font-weight: 400"><span style="font-weight: 400">Gửi số
                                                                điện thoại cá nhân và số điện thoại người thân khi cần liên
                                                                lạc thay thế.</span></li>
                                                    </ul>'
        ]);
    }
}

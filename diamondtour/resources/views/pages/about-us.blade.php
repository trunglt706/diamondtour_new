@extends('index')
@section('content')
  <article>
    @include('pages.blocks.breadcrumb', [
      'background'  => asset('assets/images/breadcrumb-about-us.jpg'),
      'title'       => 'Về chúng tôi',
      'description' => 'Giá trị, cảm hứng và trải nghiệm du lịch khác biệt!',
    ])

    <section>
      <div class="box-wrapper-single-page">
        <div class="container">
          <div class="row row-cols-1 row-cols-lg-2 gx-4">
            <div class="col">
              <h2 class="single-page-head-title">Giới thiệu</h2>
              <div class="single-page-head-content">
                <p>Diamondtour là thương hiệu trực thuộc Công ty cổ phần đầu tư và phát triển du lịch Kim Cương. Thành lập kể từ tháng 6 năm 2017, Diamondtour luôn bám vững theo tiêu chí đặt khách hàng là trung tâm, minh bạch và đề cao chất lượng dịch vụ.</p>
                <p>Với mục tiêu vươn cao và vươn xa hơn nữa trong ngành du lịch, Diamondtour vô cùng mong muốn được đón nhận niềm tin của quý khách hàng gửi trao, để chúng tôi vinh dự được phấn đấu và đồng hành cùng quý vị trên khắp các nẻo đường tới những nôi văn hóa, nền văn minh của nhân loại trên khắp thế giới, thả lòng thưởng ngoạn tiên cảnh chốn nhân gian, thể nghiệm cuộc sống khác mình ở những miền đất lạ, tìm ra những giá trị chân thực trong những chuyến đi… Đi thật xa để biết thật nhiều, để sống tốt và cống hiến nhiều hơn cho xã hội.</p>
                <p>Chúng tôi tự hào là đơn vị tổ chức tour chuyên nghiệp, tâm huyết, luôn hướng tới những giá trị đẹp đẽ sâu sắc không chỉ về cảnh quan mà còn về văn hóa lịch sử trên mỗi hành trình, đem lại những trải nghiệm khó quên nhất cho du khách tại cả những địa điểm quen thuộc hay khác biệt.</p>
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
                </ul>
              </div>
            </div>
            @include('pages.blocks.tour-guide')
          </div>
        </div>
      </div>
      <div class="box-image-row-single-page">
        <div class="col-left" style="background-image: url({{ asset('assets/images/about-us-image-1.jpg') }})"></div>
        <div class="col-right" style="background-image: url({{ asset('assets/images/about-us-image-2.jpg') }})"></div>
      </div>
      <div class="box-image-row-single-page d-sm-block d-none">
        <div class="col-right-content">
          <div class="container-fluid">
            <div class="row row-cols-2 gx-4">
              <div class="col">
                <div class="-image-child-item">
                  <img src="{{ asset('assets/images/about-us-image-3.jpg') }}" class="img-fluid" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    @include('pages.blocks.distinctive-value')
    @include('pages.blocks.companion-private')
    @include('pages.blocks.companion')
    @include('pages.blocks.discovery')
  </article>
@endsection

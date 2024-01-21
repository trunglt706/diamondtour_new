@extends('index')
@section('content')
  <article>
    @include('pages.blocks.breadcrumb', [
      'background'  => asset('assets/images/bg_blog.png'),
      'title'       => 'Liên hệ',
      'description' => 'Liên hệ',
    ])

    <section>
        <div class="box-contact-page">
          <div class="block-contact-information">
            <div class="block-images">
              <img src="{{ asset('assets/images/gallery-group-5.jpg') }}" alt="" class="img-fluid">
            </div>
            <div class="block-article">
              <div class="-title">
                CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ PHÁT TRIỂN DU LỊCH KIM CƯƠNG (DIAMONDTOUR)
              </div>
              <div class="-content">
                <p><i class="fas fa-map-marker-alt"></i> Số 15 ngõ 1, phố Phan Huy Chú, Yết Kiêu, Hà Đông, Hà Nội</p>
                <p><i class="fas fa-phone"></i> ĐT: 0912 11 5515</p>
                <p><i class="fas fa-envelope"></i> Email:info@diamondtour.vn</p>
                <p><i class="fas fa-exclamation-circle"></i> Số GPKD: 0107878502</p>
              </div>
            </div>
          </div>
          <div class="block-contact-map">
            <div class="ratio ratio-16x9">
                {!! get_option('google-map') !!}
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="box-contact-form">
          <div class="container">
            <div class="contact-form-wrap">
              <div class="-form-images">
                <img src="{{ asset('assets/images/gallery-group-5.jpg') }}" alt="" class="img-fluid">
              </div>
              <div class="-form-content">
                <form>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="form_name" class="form-label">HỌ TÊN</label>
                        <input type="text" class="form-control" placeholder="Họ và tên" id="form_name">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="form_email" class="form-label">EMAIL</label>
                        <input type="email" class="form-control" placeholder="Địa chỉ email" id="form_email">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="form_subject" class="form-label">TIÊU ĐỀ</label>
                        <input type="text" class="form-control" placeholder="Tiêu đề" id="form_subject">
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="form_content" class="form-label">NỘI DUNG TIN NHẮN</label>
                    <textarea class="form-control" id="form_content" rows="5" placeholder="Vui lòng nhập nội dung tin nhắn"></textarea>
                  </div>
                  <div class="row align-items-center justify-content-center justify-content-sm-between my-1">
                    <div class="col-6 col-md-5 col-lg-3">
                      <button type="submit" class="btn w-100 btn-submit" name="button">Gửi email</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>


  </article>
@endsection

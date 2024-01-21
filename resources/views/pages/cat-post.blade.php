@extends('index')
@section('content')
  <article class="article-wrapper-tour">
    @include('pages.blocks.breadcrumb', [
      'background'  => asset('assets/images/bg-tour-list.png'),
      'title'       => 'Danh mục Blog',
      'description' => 'Nơi chia sẻ thông tin hành trình',
    ])

    <section>
      <div class="box-wrapper-tour">

        <div class="container">
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gx-3 gx-lg-5">
            <div class="col">
              <a href="#" class="cat-post-item">
                <div class="-image">
                  <img src="{{ asset('assets/images/gallery-group-1.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="-content">
                  <h2>Khám phá Ladkh</h2>
                </div>
              </a>
            </div>
            <div class="col">
              <a href="#" class="cat-post-item">
                <div class="-image">
                  <img src="{{ asset('assets/images/gallery-group-2.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="-content">
                  <h2>Cáp Nhĩ Tân</h2>
                </div>
              </a>
            </div>
            <div class="col">
              <a href="#" class="cat-post-item">
                <div class="-image">
                  <img src="{{ asset('assets/images/gallery-group-3.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="-content">
                  <h2>Chiêm Bái Thánh Tích Nam Hoa - Tại Quảng Châu</h2>
                </div>
              </a>
            </div>
            <div class="col">
              <a href="#" class="cat-post-item">
                <div class="-image">
                  <img src="{{ asset('assets/images/gallery-group-4.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="-content">
                  <h2>Khám phá Ladkh</h2>
                </div>
              </a>
            </div>
            <div class="col">
              <a href="#" class="cat-post-item">
                <div class="-image">
                  <img src="{{ asset('assets/images/gallery-group-5.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="-content">
                  <h2>Khám phá Ladkh</h2>
                </div>
              </a>
            </div>
            <div class="col">
              <a href="#" class="cat-post-item">
                <div class="-image">
                  <img src="{{ asset('assets/images/gallery-group-2.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="-content">
                  <h2>Cáp Nhĩ Tân</h2>
                </div>
              </a>
            </div>
          </div>
        </div>

        <div class="box-pagination">
          <nav>
            <ul class="pagination justify-content-center">
              <li class="disabled page-item"><span class="page-link"><i class="fa-solid fa-chevron-left"></i></span></li>
              <li class="active page-item"><a href="#" class="page-link">1</a></li>
              <li class="page-item"><a href="#" class="page-link">2</a></li>
              <li class="page-item"><a href="#" class="page-link">3</a></li>
              <li class="page-item"><a href="#" class="page-link"><i class="fa-solid fa-chevron-right"></i></a></li>
            </ul>
          </nav>
        </div>
      </div>
    </section>

    @include('pages.blocks.newsletter')

  </article>
@endsection

@extends('index')
@section('content')
  <article>
    @include('pages.blocks.breadcrumb', [
      'background'  => asset('assets/images/gallery-group-1.jpg'),
      'title'       => 'Thư viện ảnh',
      'description' => 'NGHỆ THUẬT KIẾN TRÚC KATHMANDU – NEPAL',
    ])

    <section>
      <div class="box-wrapper-gallery">
        <div class="container">
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 gx-3 gx-lg-4">
            <div class="col">
              <a href="{{ asset('assets/images/gallery-group-1.jpg') }}" data-fancybox="gallery" class="gallery-item">
                <div class="-image">
                  <img src="{{ asset('assets/images/gallery-group-1.jpg') }}" class="img-fluid" alt="gallery-group-1.jpg">
                  <div class="overlay-content">gallery-group-1.jpg</div>
                </div>
              </a>
            </div>
            <div class="col">
              <a href="{{ asset('assets/images/gallery-group-2.jpg') }}" data-fancybox="gallery" class="gallery-item">
                <div class="-image">
                  <img src="{{ asset('assets/images/gallery-group-2.jpg') }}" class="img-fluid" alt="gallery-group-2.jpg">
                  <div class="overlay-content">gallery-group-2.jpg</div>
                </div>
              </a>
            </div>
            <div class="col">
              <a href="{{ asset('assets/images/gallery-group-3.jpg') }}" data-fancybox="gallery" class="gallery-item">
                <div class="-image">
                  <img src="{{ asset('assets/images/gallery-group-3.jpg') }}" class="img-fluid" alt="gallery-group-3.jpg">
                  <div class="overlay-content">gallery-group-3.jpg</div>
                </div>
              </a>
            </div>
            <div class="col">
              <a href="{{ asset('assets/images/gallery-group-4.jpg') }}" data-fancybox="gallery" class="gallery-item">
                <div class="-image">
                  <img src="{{ asset('assets/images/gallery-group-4.jpg') }}" class="img-fluid" alt="gallery-group-4.jpg">
                  <div class="overlay-content">gallery-group-4.jpg</div>
                </div>
              </a>
            </div>
            <div class="col">
              <a href="{{ asset('assets/images/gallery-group-5.jpg') }}" data-fancybox="gallery" class="gallery-item">
                <div class="-image">
                  <img src="{{ asset('assets/images/gallery-group-5.jpg') }}" class="img-fluid" alt="gallery-group-5.jpg">
                  <div class="overlay-content">gallery-group-5.jpg</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    @include('pages.blocks.newsletter')

  </article>
@endsection

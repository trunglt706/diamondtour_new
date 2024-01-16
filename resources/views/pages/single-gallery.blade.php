@extends('index')
@section('content')
    <article>
        @include('pages.blocks.breadcrumb', [
            'background' => asset('assets/images/gallery-group-1.jpg'),
            'title' => 'Thư viện ảnh',
            'description' => 'NGHỆ THUẬT KIẾN TRÚC KATHMANDU – NEPAL',
        ])

        <section>
            <div class="box-wrapper-gallery">
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 gx-3 gx-lg-4">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="col">
                                <a href="{{ asset('assets/images/gallery-group-2.jpg') }}" data-fancybox="gallery"
                                    class="gallery-item">
                                    <div class="-image">
                                        <img src="{{ asset('assets/images/gallery-group-2.jpg') }}" class="img-fluid"
                                            alt="gallery-group-2.jpg">
                                        <div class="overlay-content">gallery-group-2.jpg</div>
                                    </div>
                                </a>
                            </div>
                        @endfor
                    </div>
                    <div class="box-pagination">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="disabled page-item"><span class="page-link"><i
                                            class="fa-solid fa-chevron-left"></i></span></li>
                                <li class="active page-item"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link"><i
                                            class="fa-solid fa-chevron-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        @include('pages.blocks.newsletter')
    </article>
@endsection

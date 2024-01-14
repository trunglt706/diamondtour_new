@extends('index')
@section('content')
    <article>
        @include('pages.blocks.breadcrumb', [
            'background' => asset('assets/images/breadcrumb-gallery.jpg'),
            'title' => 'Thư viện ảnh',
            'description' => 'Nơi lưu giữ hành trình của chúng tôi',
        ])

        <section>
            <div class="box-wrapper-gallery">
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gx-3 gx-lg-5">
                        @for ($i = 1; $i < 7; $i++)
                            <div class="col">
                                <a href="{{ route('library.detail', ['alias' => $i]) }}" class="gallery-group-item">
                                    <div class="-image">
                                        <img src="{{ asset('assets/images/gallery-group-1.jpg') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="-content">
                                        <h2>Nghệ thuật kiến trúc Kathamandu - Nepal</h2>
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

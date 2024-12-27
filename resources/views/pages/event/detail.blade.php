@extends('index')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}" />

    {!! $data['event']->script !!}
    <article class="article-contact-page">
        @include('pages.blocks.breadcrumb', [
            'background' => 'assets/images/bg_newsletter.png',
        ])
        <section>
            <div class="widget_slider">
                <div class="box-content">
                    <div class="widget_slider_banner">
                        <div>
                            <a href="/">
                                <img src="{{ get_url($data['event']->background) }}" alt="Image 1">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {!! $data['event']->content !!}
            @if ($data['event']->submitssionActive->count() > 0)
                <div class="widget_feedback_style_2">
                    <div class="container">
                        <div class="header-title">
                            <h3 class="header-feedback">Các bài dự thi mới nhất</h3>
                            <div class="box-arrow">
                                <button class="btn-prev">
                                    <i class="fa-solid fa-angle-left"></i>
                                </button>
                                <button class="btn-next">
                                    <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="list-item">
                                @foreach ($data['event']->submitssionActive as $item)
                                    <div class="item">
                                        <div class="description">
                                            <p>
                                                {{ $item->description }}
                                            </p>
                                        </div>
                                        <div class="user-info">
                                            <div class="avt">
                                                <img src="/assets/images/founder.jpg" alt="">
                                            </div>
                                            <div class="info">
                                                <p class="name">{{ $item->name }}</p>
                                                <p class="location">{{ $item->position }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- <div class="widget_qrcode_style_2">
                <div class="container">
                    <div class="box-content">
                        <div class="row">
                            <div class="col-md-7 col-12 row_1">
                                <div class="box-top">
                                    <h3 class="title">Nhận ngay 500k</h3>
                                    <p class="description">
                                        Khi Scan và nhấn “Quan tâm" Zalo OA Diamond tour
                                    </p>
                                </div>
                                <div class="box-bottom">
                                    <button class="btn scan">SCAN NOW</button>
                                    <button class="btn contact">LIÊN HỆ</button>
                                </div>

                            </div>
                            <div class="col-md-5 col-12 row_2">
                                <div class="qrcode-box">
                                    <div class="header-box">
                                        <p>QR Post code</p>
                                        <button class="btn"><i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                    <div class="img">
                                        <img src="/assets/images/qrcode.jpg" alt="" srcset="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </section>
    </article>
@endsection
@section('script_module')
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script>
        $(function() {
            $('.widget_feedback_style_2 .list-item').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true,
                fade: false,
                dots: false,
                infinite: true,
                autoplay: true,
                // prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-arrow-left"></i></i></button>',
                // nextArrow: '<button type="button" class="slick-next"<i class="fa-solid fa-arrow-right"></i></button>',
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });
            $('.widget_feedback_style_2 .btn-next').on('click', function() {
                $('.widget_feedback_style_2 .slick-next').trigger('click');
            })
            $('.widget_feedback_style_2 .btn-prev').on('click', function() {
                $('.widget_feedback_style_2 .slick-prev').trigger('click');
            })
        });
    </script>
@endsection

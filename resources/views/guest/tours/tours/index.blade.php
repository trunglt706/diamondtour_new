@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <style>
        .home .widget_post_style_1.js_widget_post_style_1_2 {
            padding-top: 20px;
        }

        .home .widget_post_style_1 {
            padding-top: 50px !important;
        }

        .slick-prev {
            left: 25px;
        }

        .slick-next {
            right: 25px;
        }

        .slick-prev:before,
        .slick-next:before {
            font-size: 40px;
        }

        .slick-prev,
        .slick-next {
            z-index: 1;
        }

        .banner-grid .banner {
            height: 495px;
        }

        .widget_question .accordion-button {
            font-family: 'Lora';
        }

        .widget_question .accordion-body,
        .widget_question .accordion-body p {
            font-family: 'Lora';
            text-align: justify;
        }

        @media (max-width: 932px) {

            .widget_banner_style_1 .content .top,
            .widget_banner_style_1 .content .footer-banner .left {
                display: none !important;
            }

            .widget_service .box-content #myTab .box-item {
                width: 100% !important;
            }

            .home .widget_post_style_1 {
                overflow: auto !important;
            }

            .main-content {
                padding-top: 50px !important;
            }

            .widget_banner_style_1 .banner img {
                height: 250px !important;
            }

            .banner-grid .banner {
                height: auto !important;
            }

            .widget_service .header-title .header,
            body .header-title.header-title-style-1 .header {
                font-size: 24px !important;
            }

            #myTab {
                justify-content: center !important;
            }

            #myTab .nav-item {
                width: 33% !important;
            }

            #myTab .nav-item .nav-link {
                width: 100% !important;
            }

            .widget_service .box-content #myTab .nav-link,
            .widget_service .box-content #myTab .nav-link.active {
                border: none !important;
            }
        }
    </style>
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home travel">
            {{-- start slider --}}
            @include('guest.tours.sliders')
            {{-- end slider --}}

            {{-- start blog --}}
            @include('guest.tours.blogs')
            {{-- end blog --}}

            {{-- start tour --}}
            @include('guest.tours.tours')
            {{-- end tour --}}

            {{-- start design --}}
            @include('guest.tours.design')
            {{-- end design --}}

            {{-- start seasonal tour --}}
            @include('guest.tours.seasonal_tours')
            {{-- end seasonal tour --}}

            {{-- start activity --}}
            @include('guest.tours.activity')
            {{-- end activity --}}

            {{-- start faq --}}
            @include('guest.tours.faq')
            {{-- end faq --}}
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('/style/js/home.js') }}"></script>
@endsection

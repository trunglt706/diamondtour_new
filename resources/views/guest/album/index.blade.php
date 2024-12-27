@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <style>
        .widget_post_style_1.js_widget_post_style_1_13 .content .description {
            font-size: 15px !important;
        }

        .slick-prev {
            left: 25px;
        }

        .slick-next {
            right: 23px;
        }

        .slick-prev:before,
        .slick-next:before {
            font-size: 40px;
        }

        .slick-prev,
        .slick-next {
            z-index: 1;
        }

        .widget_feedback_style_2 .feedbackContentSwiper .content p {
            height: 63px;
            overflow: hidden;
        }

        .widget_feedback_style_2 .feedbackAvaterSwiper.swiper {
            max-width: 120px !important;
        }

        .widget_feedback_style_2.js_widget_feedback_style_2_2 .title {
            margin-bottom: 0px !important;
        }

        .widget_feedback_style_2.js_widget_feedback_style_2_2 {
            padding-bottom: 150px !important;
        }

        .js_widget_slider_banner_1.widget_slider_banner_2 img {
            height: 495px !important;
        }

        @media (max-width: 932px) {

            .main-content {
                padding-top: 50px !important;
            }

            .js_widget_slider_banner_1.widget_slider_banner_2 img {
                height: 250px !important;
            }

            .widget_about_style_3 .content {
                align-items: center;
            }

            .widget_about_style_3 .content .date-time .time {
                display: none;
            }

            .main-content img {
                border-radius: 8px;
            }

            .js_widget_slider_banner_1.widget_slider_banner_2 img {
                border-radius: 0px !important;
            }

            .read-more {
                height: 38px !important;
            }

            .widget_feedback_style_2.js_widget_feedback_style_2_2 .title h5 {
                font-family: 'Montserrat' !important;
            }
        }
    </style>
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home album">
            {{-- start slider --}}
            @include('guest.album.sliders')
            {{-- end slider --}}

            {{-- start news --}}
            @include('guest.album.news')
            {{-- end news --}}

            {{-- start hot --}}
            @include('guest.album.hot')
            {{-- end hot --}}

            {{-- start important --}}
            @include('guest.album.important')
            {{-- end important --}}

            {{-- start like --}}
            @include('guest.album.like')
            {{-- end like --}}

            {{-- start guests --}}
            @include('guest.album.guests')
            {{-- end guests --}}

            {{-- start view --}}
            @include('guest.album.view')
            {{-- end view --}}
        </div>
    </section>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('/style/js/album.js') }}"></script>
    <script src="{{ asset('/style/js/list-album.js') }}"></script>
@endsection

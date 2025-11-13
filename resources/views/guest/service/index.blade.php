@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <style>
        .widget_item_style_3 .box-item {
            gap: 0px !important;
        }

        .widget_service_style_3 .box-content .description {
            text-align: justify !important;
        }

        .widget_item_style_3 .box-item {
            display: flex !important;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
        }

        .widget_item_style_3 .box-item a:nth-child(1),
        .widget_item_style_3 .box-item a:nth-child(2) {
            width: 50%;
        }

        .widget_item_style_3 .box-item a:nth-child(3),
        .widget_item_style_3 .box-item a:nth-child(4),
        .widget_item_style_3 .box-item a:nth-child(5) {
            width: 33%;
        }

        @media (max-width: 932px) {
            .main-content {
                padding-top: 0px !important;
            }

            .widget_banner.widget_banner_style_3 .box-content .title {
                font-size: 22px !important;
                line-height: 30.2px !important;
            }

            .widget_item_style_3 .box-item {
                grid-template-columns: 1fr 1fr !important;
            }

            .widget_service_style_3 .box-content,
            .widget_service_style_3 {
                padding: 12px !important;
            }

            .widget_item_style_3 .box-item .img img {
                max-height: 65px !important;
            }

            .widget_item_style_3 .box-item .item .title {
                font-size: 15px !important;
                line-height: 19px !important;
            }

            .widget_service_style_3 .box-content .header-title p {
                font-size: 22px !important;
            }

            .widget_form_contact_style_3 .title {
                font-size: 22px !important;
            }
        }
    </style>
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home service">
            {{-- start slider --}}
            @include('guest.service.sliders')
            {{-- end slider --}}

            {{-- start tools --}}
            @include('guest.service.tools')
            {{-- end tools --}}

            @if ($data['services']->count() > 0)
                <div class="widget_service_style_3">
                    <div class="container">
                        @foreach ($data['services'] as $key => $item)
                            <div class="box-{{ ++$key }} box" id="service-{{ $item->id }}">
                                <div class="row">
                                    <div class="col-md-6 col-12 box-image">
                                        <div class="box-slider-img">
                                            <div class="swiper">
                                                <div class="swiper-wrapper">
                                                    @php
                                                        $backgrounds = get_image_from_table('services', $item->id);
                                                    @endphp
                                                    @foreach ($backgrounds as $bg)
                                                        <div class="swiper-slide">
                                                            <div class="img">
                                                                <a href="#">
                                                                    <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ get_file($bg->url) }}" alt="Image"
                                                                        loading="lazy">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                {{-- <div class="swiper-pagination"></div> --}}
                                                {{-- <div class="swiper-button-prev"></div>
                                                <div class="swiper-button-next"></div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 box-content-service ">
                                        <div class="box-content">
                                            <div class="header-title">
                                                <img src="{{ get_file($item->image) }}" alt="Image">
                                                <p class="title">{{ get_data_lang($item, 'name') }}</p>
                                            </div>
                                            <p class="description">
                                                {{ get_data_lang($item, 'description') }}
                                            </p>
                                            <div>
                                                <a href="{{ $item->link }}" class="read-more">
                                                    <span>@lang('messages.menu.contact')</span><i
                                                        class="fa-solid fa-arrow-right-long"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- start contact --}}
            @include('guest.service.contact')
            {{-- end contact --}}
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('/style/js/service.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        $(function() {
            function initSwiper(container) {
                return new Swiper(container, {
                    autoplay: {
                        delay: 4000, // Thời gian giữa mỗi lần chuyển slide (ms)
                        disableOnInteraction: false, // Tiếp tục chạy sau khi người dùng tương tác
                    },
                    grabCursor: true,
                    speed: 500,
                    effect: "slide",
                    loop: true,
                    // mousewheel: {
                    //     invert: false,
                    //     sensitivity: 1,
                    // },
                    // pagination: {
                    //     el: ".swiper-pagination",
                    //     clickable: true,
                    // },
                    navigation: {
                        nextEl: `${container} .swiper-button-next`,
                        prevEl: `${container} .swiper-button-prev`,
                    },
                });
            }
            @foreach ($data['services'] as $key => $item)
                initSwiper(".widget_service_style_3 .box-{{ ++$key }} .swiper");
            @endforeach
        });

        $('.btn-submit').click(function() {
            let form = $(this).closest('form'); // Lấy form gần nhất
            let hasEmptyRequiredFields = false;
            form.find('input[required], select[required], textarea[required]').each(function() {
                if ($(this).val() === '') {
                    hasEmptyRequiredFields = true;
                }
            });
            if (!hasEmptyRequiredFields) {
                $(this).html(
                    `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status">Loading...</span>`
                );
            }
        });
    </script>
@endsection

@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/service/index.css') }}">
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
    </script>
@endsection

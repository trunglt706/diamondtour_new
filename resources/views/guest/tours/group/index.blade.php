@php
    $item = $data['group'];
@endphp
@extends('guest.layout')
@section('title', get_data_lang($item, 'name'))
@section('keywords', '')
@section('description', $item->description)
@section('image', asset($item->image))
@section('content')
    <style>
        .widget_tour_1 nav {
            justify-content: center;
            display: flex;
        }

        .widget_about_4 .list-item .item {
            margin-bottom: 5px;
        }

        .widget_about_4 .header-title .description {
            max-height: 180px;
            overflow: hidden;
        }

        .widget_about_4 {
            padding: 50px 0;
        }

        .widget_tour_1 {
            padding: 0px;
        }

        @media (max-width: 932px) {

            .main-content {
                padding-top: 20px !important;
            }

            .travel-detail .widget_about_4 .row-flex {
                display: block !important;
            }

            .widget_about_4 .row-flex .box-right {
                margin-top: 8px;
            }

            .widget_about_4 .list-item .item a {
                font-size: 16px !important;
            }

            .header-title-style-3.header-title,
            .widget_about_4 .list-item .item {
                justify-content: center !important;
            }

            .widget_about_4 .header-title .header {
                text-align: center !important;
            }
        }
    </style>
    <section class="main-content">
        @if ($item)
            <div class="wrapper home travel-detail">
                @if ($item->background)
                    <div class="widget_banner">
                        <div class="box-content">
                            <a href="#"><img src="{{ asset($item->background) }}" alt="Image 1"></a>
                        </div>
                    </div>
                @endif
                <div class="widget_about_4">
                    <div class="container">
                        <div class="row-flex">
                            <div class="box-left col-12 col-md-3">
                                <div class="header-title">
                                    <p class="header">{{ $item->name }}</p>
                                    <p class="description">
                                        {{ $item->description }}
                                    </p>
                                </div>
                                <div class="list-item">
                                    <div class="item">
                                        <div class="img">
                                            <img src="/style/images/icon/Message.png" alt="Image" srcset="">
                                        </div>
                                        <a href="#">info@diamondtour.vn</a>
                                    </div>
                                    <div class="item">
                                        <div class="img">
                                            <img src="/style/images/icon/Call.png" alt="Image" srcset="">
                                        </div>
                                        <a href="#">0905 615 666 / 0388 116 636</a>
                                    </div>
                                    <a href="https://maps.app.goo.gl/C5PMyWCUUuhrKuGU9"
                                        target="_blank">@lang('messages.tour.address_phong_giao_dich')</a>
                                </div>
                            </div>
                            <div class="box-right col-12 col-md-9">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        <div class="img swiper-slide">
                                            <img src="{{ $item->image ? asset($item->image) : asset('user/img/user/no-avatar.jpg') }}"
                                                alt="Image">
                                        </div>
                                        <div class="img swiper-slide">
                                            <img src="/style/images/post/poooo.png" alt="Image">
                                        </div>
                                        <div class="img swiper-slide">
                                            <img src="/style/images/post/v.png" alt="Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- start tours --}}
        @if ($item)
            @include('guest.tours.group.destinations')
        @else
            @include('guest.tours.group.tours')
        @endif
        {{-- end tours --}}

    </section>
@endsection

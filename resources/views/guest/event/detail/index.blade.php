@extends('guest.layout')
@section('title', $data->title)
@section('keywords', '')
@section('description', $data->description)
@section('image', $data->image)
@section('style')
    <style>
        .main-content .container {
            font-size: clamp(14px, 2vw, 18px);
        }

        .widget_about_style_1 .box-content {
            padding-top: 30px;
        }

        @media (max-width: 932px) {
            .main-content {
                padding-top: 50px !important;
            }

            .widget_about_style_1 {
                padding: 12px 0px !important;
                margin-bottom: 40px !important;
            }
        }
    </style>
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home competition">
            <div class="widget_slider">
                <div class="box-content">
                    <div class="widget_slider_banner">
                        <div>
                            <a href="#">
                                <img src="{{ asset('style/images/banner/default.jpg') }}" data-src="{{ $data->background ? asset($data->background) : '' }}" alt="Image 1" loading="lazy">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {!! $data->content !!}
            @if ($data->submitssionActive->count() > 0)
                <div class="widget_feedback_style_2">
                    <div class="container">
                        <div class="header-title">
                            <h3 class="header-feedback">@lang('messages.event.bai_du_thi')</h3>
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
                                @foreach ($data->submitssionActive as $item)
                                    <div class="item">
                                        <div class="description">
                                            <p>
                                                {{ $item->description }}
                                            </p>
                                        </div>
                                        <div class="user-info">
                                            <div class="avt">
                                                <img src="{{ asset('style/images/item/founder 1.png') }}" alt="Image">
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
                                    <h3 class="title">@lang('messages.event.get_500k')</h3>
                                    <p class="description">
                                        @lang('messages.event.get_500k_des')
                                    </p>
                                </div>
                                <div class="box-bottom">
                                    <button class="btn scan">@lang('messages.event.scan_now')</button>
                                    <button class="btn contact text-uppercase">@lang('messages.contact')</button>
                                </div>
                            </div>
                            <div class="col-md-5 col-12 row_2">
                                <div class="qrcode-box">
                                    <div class="header-box">
                                        <p>@lang('messages.event.qrpost')</p>
                                        <button class="btn"><i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                    <div class="img">
                                        <img src="{{ asset('style/images/icon/0998d669-0b87-405f-83ca-956971bf3476.webp') }}"
                                            alt="Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection

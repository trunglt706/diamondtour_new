@extends('guest.layout')
@section('title', __('messages.tour.list_tour_trai_nghiem'))
@section('keywords', '')
@section('description', __('messages.tour.list_tour_trai_nghiem'))
@section('image', '')
@section('content')
    <style>
        .widget_tour_1 {
            padding: 20px 0;
        }

        .header-title-style-3.header-title {
            justify-content: center;
        }

        @media (max-width: 932px) {

            .main-content {
                padding-top: 30px !important;
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
        <div class="widget_tour_1">
            <div class="container">
                <div class="header-title header-title-style-3">
                    @php
                        $text_tour = 'messages.tour.bundle' . $_GET['t'];
                    @endphp
                    <p class="header text-center">@lang($text_tour)</p>
                </div>
                <div class="row">
                    @foreach ($data['tours'] as $item)
                        @php
                            $_url = route('demo.tour.detail', ['slug' => $item->slug]);
                        @endphp
                        <div class="col-md-4 col-12">
                            <div class="tour-item">
                                <div class="img">
                                    <a href="{{ $_url }}">
                                        <img src="{{ $item->image ? asset($item->image) : asset('/style/images/post/butan.png') }}"
                                            alt="Image" title="" loading="lazy">
                                    </a>
                                </div>
                                <div class="title">
                                    <div class="list-icon-share justify-content-between">
                                        <a href="/">
                                            <i class="fas fa-calendar-week"></i>
                                            {{ $item->from ? date('d/m/Y', strtotime($item->from)) : __('messages.dang_cap_nhat') }}
                                        </a>
                                        <a href="/" class="vnd">
                                            {{ $item->price ? number_format($item->price) . 'Đ' : __('messages.dang_cap_nhat') }}
                                        </a>
                                    </div>
                                    <div class="top">
                                        <h3 class="header-tour-detail">
                                            <a href="{{ $_url }}">{{ get_data_lang($item, 'name') }}</a>
                                        </h3>
                                        <a class="btn-read-more" href="{{ $_url }}">@lang('messages.view_now') ></a>
                                    </div>
                                    <div class="list-icon-share">
                                        <a href="/">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $item->country_name ?? __('messages.dang_cap_nhat') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    {!! $pagination = $data['tours']->appends(request()->all())->links() !!}
                </div>
            </div>
        </div>
    </section>
@endsection

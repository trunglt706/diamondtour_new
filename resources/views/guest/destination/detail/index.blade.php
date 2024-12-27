@php
    $item = $data['destination'];
    $albums = $item->album ? json_decode($item->album) : [];
    $tags = $item->tags ? json_decode($item->tags) : [];
@endphp
@extends('guest.layout')
@section('title', get_data_lang($item, 'name'))
@section('keywords', '')
@section('description', stripHtml($item->description))
@section('image', asset($item->image))
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <style>
        .widget-slider-blogs-style-1 .content span,
        .widget-slider-blogs-style-1 .content p,
        .widget-slider-blogs-style-1 .content p span {
            font-size: 16px !important;
            font-weight: normal !important;
        }

        .widget-slider-blogs-style-1 .content p {
            text-align: justify !important;
        }

        img {
            border-radius: 8px;
        }

        .list-tours .item {
            text-decoration: none;
            height: 270px;
            position: relative;
        }

        .list-tours .item h5 {
            position: absolute;
            bottom: -7px;
            color: #fff;
            background: #0000004d;
            padding: 4px 12px;
            border-end-end-radius: 8px;
            text-align: center;
            border-end-start-radius: 8px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            line-height: 28px;
            font-size: 16px;
            height: 64px;
        }

        .tien_ich_list ul {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .tien_ich_list ul li {
            width: 47%;
        }

        .widget-slider-blogs-style-1 .slick-arrow {
            opacity: 1 !important;
        }

        @media (max-width: 932px) {

            .main-content {
                padding-top: 50px !important;
            }

            .widget_tour_1.js_widget_tour_1_2 .header-title p {
                font-size: 28px !important;
            }

            .widget_tour_1.js_widget_tour_1_2 .tour-item {
                display: block !important;
            }

            .widget_tour_1.js_widget_tour_1_2 .tour-item .title .list-icon-share,
            .widget_tour_1 .tour-item .title .top>a {
                display: none !important;
            }

            .widget_tour_1.js_widget_tour_1_2 .tour-item .title .top {
                padding-top: 0px !important;
                margin: 15px 0 !important;
                padding-bottom: 15px !important;
                text-transform: uppercase;
            }

            .widget_tour_1.js_widget_tour_1_2 .tour-item .title {
                padding: 8px !important;
            }

            .tien_ich_list ul {
                padding-left: 12px;
            }

            .tien_ich_list ul li {
                padding-right: 20px;
            }

            .title-other {
                font-size: 20px !important
            }

            .img-mobile {
                margin-top: 16px;
            }
        }
    </style>
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home blogs-detail">
            <div class="widget-slider-blogs-style-1">
                <div class="container">
                    {{-- start albums --}}
                    @include('guest.destination.detail.albums')
                    {{-- end albums --}}
                    <div class="content">
                        <div>{!! $item->description !!}</div>
                        <div class="row">
                            <div class="col-md-7 mb-2">
                                <div class="img hide-mobile">
                                    <img src="{{ asset($item->image) }}" alt="Image" title="" loading="lazy"
                                        style="">
                                </div>
                                <h5 class="text-uppercase mt-4 title-other" style="font-size: 25px;font-weight: 600;">
                                    @lang('messages.tour.tour_lien_quan')
                                </h5>
                                @if ($data['tours'])
                                    <div class="list-tours row">
                                        @foreach ($data['tours'] as $tour)
                                            @php
                                                $_url = route('demo.tour.detail', ['slug' => $tour->slug]);
                                            @endphp
                                            <div class="col-6 mb-2">
                                                <div class="item">
                                                    <a href="{{ $_url }}" class="img">
                                                        <img src="{{ asset($tour->image) }}" alt="Image" title=""
                                                            loading="lazy" style="">
                                                    </a>
                                                    <a href="{{ $_url }}">
                                                        <h5>
                                                            {{ get_data_lang($tour, 'name') }}
                                                        </h5>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="card card-body">
                                    <h5 class="text-uppercase">@lang('messages.tour.tien_ich_basic')</h5>
                                    <div class="tien_ich_list">
                                        {!! $item->tien_ich !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 mb-2">
                                <div class="img img-mobile show-mobile">
                                    <img src="{{ asset($item->image) }}" alt="Image" title="" loading="lazy"
                                        style="">
                                </div>
                                <h2 class="text-uppercase">{{ get_data_lang($item, 'name') }}</h2>
                                {!! $item->content !!}
                                @php
                                    $plan = json_decode($item->plan);
                                @endphp
                                @if ($plan)
                                    <div style="margin-top: 50px;">
                                        <h2 class="text-uppercase">@lang('messages.ke_hoach_cua_ban')</h2>
                                        {!! $plan->content !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="block-single-post-bottom">
                        <div class="row row-cols-1 row-cols-sm-2">
                            <div class="col">
                                @if (count($tags) > 0)
                                    <div class="-post-tags">
                                        <h2>@lang('messages.tu_khoa_lien_ket')</h2>
                                        <ul>
                                            @foreach ($tags as $item)
                                                <li>
                                                    <a
                                                        href="{{ route('demo.search') }}?t=destination&q={{ $item }}">
                                                        {{ $item }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col">
                                <div class="-post-tags -social text-end">
                                    <h2>@lang('messages.chia_se_bai_viet')</h2>
                                    <div class="sharethis-inline-share-buttons"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- start others --}}
            @include('guest.destination.detail.others')
            {{-- end others --}}
        </div>
    </section>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('/style/js/travel-detail.js') }}"></script>
    <script src="{{ asset('/style/js/post.js') }}"></script>
    <script src="{{ asset('/style/js/blogs.js') }}"></script>
    <script src="{{ asset('/style/js/blogs-detail.js') }}"></script>
@endsection

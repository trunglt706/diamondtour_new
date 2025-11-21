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
    <link rel="stylesheet" href="{{ asset('assets/css/destination/detail.css') }}">
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
                                    <img src="{{ get_file($item->image) }}" alt="Image" loading="lazy">
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
                                                        <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ get_file($tour->image) }}" alt="Image"
                                                            loading="lazy" width="353px" height="270px">
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
                                    <img src="{{ get_file($item->image) }}" alt="Image" loading="lazy">
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
                                                    <a href="{{ route('demo.search') }}?t=destination&q={{ $item }}">
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
    <script src="{{ asset('/style/js/travel-detail.js') }}"></script>
    <script src="{{ asset('/style/js/post.js') }}"></script>
    <script src="{{ asset('/style/js/blogs.js') }}"></script>
    <script src="{{ asset('/style/js/blogs-detail.js') }}"></script>
@endsection

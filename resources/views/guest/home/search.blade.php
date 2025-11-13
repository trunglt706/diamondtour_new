@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/home/search.css') }}">
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home search">
            {{-- start slider --}}
            <div class="widget_slider">
                <div class="box-content">
                    <div class="widget_slider_banner">
                        <div>
                            <a href="#">
                                <img src="{{ asset('style/images/banner/default.jpg') }}" data-src="{{ get_file($data['menu']->background) }}" alt="Image" loading="lazy">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end slider --}}

            {{-- start toolbar --}}
            @include('guest.home.toolbar')
            {{-- end toolbar --}}

            <div class="widget_tour_1">
                {{-- tour --}}
                @if ($data['tours'])
                    <div class="container">
                        <div class="header-title header-title-style-3">
                            <p class="header text-uppercase">
                                {{ __('messages.result_find_tour') }}
                                ({{ $data['tours']->count() }})
                            </p>
                        </div>
                        <div class="row">
                            @foreach ($data['tours'] as $tour)
                                @php
                                    $_url = route('demo.tour.detail', ['slug' => $tour->slug]);
                                @endphp
                                <div class="col-md-4 col-12">
                                    <div class="tour-item">
                                        <div class="img">
                                            <a href="{{ $_url }}">
                                                <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ get_file($tour->image) }}" alt="Image" loading="lazy" width="416px" height="293px">
                                            </a>
                                        </div>
                                        <div class="title">
                                            <div class="top">
                                                <h3 class="header-tour-detail"><a
                                                        href="{{ $_url }}">{{ get_data_lang($tour, 'name') }}</a>
                                                </h3>
                                                <a class="btn-read-more" href="{{ $_url }}">@lang('messages.view_now') ></a>
                                            </div>
                                            <div class="list-icon-share">
                                                <a href="/">
                                                    <i class="fas fa-calendar-week"></i>
                                                    {{ $tour->from ? date('d/m/Y', strtotime($tour->from)) : __('messages.dang_cap_nhat') }}
                                                </a>
                                                <a href="/" class="vnd">
                                                    {{ $tour->price ? number_format($tour->price) . 'Đ' : __('messages.dang_cap_nhat') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            @php
                                $pagination = $data['tours']->appends(request()->all())->links();
                            @endphp
                            {!! $pagination !!}
                        </div>
                    </div>
                @endif

                {{-- blog --}}
                @if ($data['blogs'])
                    <div class="container">
                        <div class="header-title header-title-style-3">
                            <p class="header text-uppercase">
                                {{ __('messages.result_find_blog') }}
                                ({{ $data['blogs']->count() }})
                            </p>
                        </div>
                        <div class="row">
                            @foreach ($data['blogs'] as $item)
                                @php
                                    $_url = route('demo.blog.detail', ['slug' => $item->slug]);
                                @endphp
                                <div class="col-md-4 col-12">
                                    <div class="tour-item">
                                        <div class="img">
                                            <a href="{{ $_url }}">
                                                <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ get_file($item->image) }}" alt="Image" loading="lazy" width="416px" height="293px">
                                            </a>
                                        </div>
                                        <div class="title">
                                            <div class="top">
                                                <h3 class="header-tour-detail">
                                                    <a href="{{ $_url }}">{{ get_data_lang($item, 'name') }}</a>
                                                </h3>
                                                <a class="btn-read-more" href="{{ $_url }}">@lang('messages.view_now') ></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            @php
                                $pagination = $data['blogs']->appends(request()->all())->links();
                            @endphp
                            {!! $pagination !!}
                        </div>
                    </div>
                @endif

                {{-- diểm đến --}}
                @if ($data['destinations'])
                    <div class="container">
                        <div class="header-title header-title-style-3">
                            <p class="header text-uppercase">
                                {{ __('messages.result_find_destination') }}
                                ({{ $data['destinations']->count() }})
                            </p>
                        </div>
                        <div class="row">
                            @foreach ($data['destinations'] as $des)
                                @php
                                    $_url = route('demo.destination.detail', ['slug' => $des->slug]);
                                @endphp
                                <div class="col-md-4 col-12">
                                    <div class="tour-item">
                                        <div class="img">
                                            <a href="{{ $_url }}">
                                                <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ get_file($des->image) }}" alt="Image" loading="lazy" width="416px" height="293px">
                                            </a>
                                        </div>
                                        <div class="title">
                                            <div class="top">
                                                <h3 class="header-tour-detail"><a
                                                        href="{{ $_url }}">{{ get_data_lang($des, 'name') }}</a>
                                                </h3>
                                                <a class="btn-read-more" href="{{ $_url }}">@lang('messages.view_now') ></a>
                                            </div>
                                            <div class="list-icon-share">
                                                <a href="#">
                                                    @if ($des->type == 'local')
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        {{ $des->province_name ?? __('messages.dang_cap_nhat') }}
                                                    @else
                                                        <i class="fas fa-globe-asia"></i>
                                                        {{ $des->country_name ?? __('messages.dang_cap_nhat') }}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            @php
                                $pagination = $data['destinations']->appends(request()->all())->links();
                            @endphp
                            {!! $pagination !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        var url = "{{ route('demo.search') }}";
        $(function() {
            // set startDat and endDate from request
            const startDate = "{{ request()->get('start') }}";
            const endDate = "{{ request()->get('end') }}";

            $('input[name="daterange"]').daterangepicker({
                    opens: "left",
                    startDate: startDate ? moment(startDate) : moment(),
                    endDate: endDate ? moment(endDate) : moment().add(7, 'days'),
                },
                function(start, end, label) {
                    const startDate = start.format("YYYY-MM-DD");
                    const endDate = end.format("YYYY-MM-DD");
                    location.href = `${url}?t=tour&start=${startDate}&end=${endDate}`;
                }
            );

            // event click btn-submit-daterange
            $('.btn-submit-daterange').on('click', function() {
                const daterange = $('input[name="daterange"]').val();
                const dates = daterange.split(' - ');
                const startDate = moment(dates[0], "MM/DD/YYYY").format("YYYY-MM-DD");
                const endDate = moment(dates[1], "MM/DD/YYYY").format("YYYY-MM-DD");
                location.href = `${url}?t=tour&start=${startDate}&end=${endDate}`;
            });
        });

        $(".widget_item_1 .dropdown").on("click", function(e) {
            e.stopPropagation();
        });
    </script>
@endsection

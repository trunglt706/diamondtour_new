@php
    $item = $data['menu'];
@endphp
@extends('guest.layout')
@section('title', get_data_lang($item, 'name'))
@section('keywords', '')
@section('description', $item->description)
@section('image', asset($item->image))
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/tours/all.css') }}">
    <section class="main-content">
        {{-- start tours --}}
        <div class="widget_tour_1">
            <div class="container">
                <div class="header-title header-title-style-3">
                    <p class="header">{{ __('messages.tour.list') }}</p>
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
                                        <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $item->image ? get_file($item->image) : asset('/style/images/post/butan.png') }}"
                                            alt="Image" loading="lazy">
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
                <div class="mt-3 text-center">
                    {!! $pagination = $data['tours']->appends(request()->all())->links() !!}
                </div>
            </div>
        </div>
        {{-- end tours --}}

    </section>
@endsection

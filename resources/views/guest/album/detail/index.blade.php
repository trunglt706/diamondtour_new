@php
    $item = $data['group'];
    $pagination = $data['images']->appends(request()->all())->links();
@endphp
@extends('guest.layout')
@section('title', get_data_lang($item, 'name'))
@section('keywords', '')
@section('description', $item->description)
@section('image', '')
@section('style')
    <link href="{{ asset('style/plugins/fancybox/fancybox.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/album/detail.css') }}">
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home list-album-2">
            <div class="widget_banner_3">
                <div class="box-banner">
                    <div class="box-content">
                        {{-- <p class="title-top">Album ảnh</p> --}}
                        <p class="title">{{ $item->name }}</p>
                        <p class="description">
                            {{ $item->description }}
                        </p>
                    </div>
                    <div class="box-img">
                        <div class="img">
                            <img src="{{ asset('style/images/banner/default.jpg') }}" data-src="{{ $item->image ? get_file($item->image) : asset('/style/images/banner/L1190477 1.png') }}"
                                alt="Image" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget_list_album">
            <div class="container">
                <div class="list-item-album">
                    <div class="row">
                        @foreach ($data['images'] as $item)
                            <div class="col-md-4 col-md-6">
                                <div class="image">
                                    <a data-fancybox="gallery" data-caption="{{ $item->name }}"
                                        data-src="{{ asset($item->image) }}">
                                        <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ get_file($item->image) }}" alt="Image"
                                            loading="lazy">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($pagination)
                        {!! $pagination !!}
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('/style/js/list-album.js') }}"></script>
    <script src="{{ asset('/style/js/album.js') }}"></script>
    <script src="{{ asset('style/plugins/fancybox/fancybox.umd.js') }}"></script>
    <script src="{{ asset('style/plugins/fancybox/de.umd.js') }}"></script>
@endsection

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
    <link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" rel="stylesheet" />
    <style>
        @media (max-width: 932px) {
            .main-content {
                padding-top: 50px !important;
            }

            .widget_banner_3 .box-banner .box-content .description {
                display: none !important;
            }

            .widget_banner_3 .box-banner .box-content {
                width: 100% !important;
                height: 50px !important;
                overflow: hidden !important;
                top: auto !important;
                bottom: 0 !important;
                padding: 0px !important;
            }

            .widget_banner_3 .box-banner .box-content .title {
                font-size: 14px !important;
                line-height: 25px !important;
                margin-bottom: 0px !important;
                text-align: center !important;
            }
        }
    </style>
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
                            <img src="{{ $item->image ? asset($item->image) : asset('/style/images/banner/L1190477 1.png') }}"
                                alt="Image">
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
                                        <img src="{{ asset($item->image) }}">
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
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/l10n/de.umd.js"></script>
    <script>
        Fancybox.bind('[data-fancybox]', {
            l10n: Fancybox.l10n.de
        });
    </script>
@endsection

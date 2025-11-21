@php
    $item = $data['tour'];
@endphp
@extends('guest.layout')
@section('title', get_data_lang($item, 'name'))
@section('keywords', '')
@section('description', stripHtml($item->description))
@section('image', asset($item->image))
@section('style')
    <link rel="stylesheet" href="{{ asset('style/plugins/fancybox/fancybox.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tours/detail.css') }}">
@endsection

@push('head')
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "{{ get_data_lang($item, 'name') }}",
  "image": "{{ asset($item->image) }}",
  "description": "{{ stripHtml($item->description) }}",
  "sku": "",
  "brand": {
    "@type": "Brand",
    "name": "Diamondtour"
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "VND",
    "price": "{{ $item->price ?? '' }}",
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "https://schema.org/InStock",
    "url": "{{ url()->current() }}",
    "seller": {
      "@type": "Organization",
      "name": "{{ config('app.name') }}"
    }
  }
}
</script>
@endpush

@section('content')
    <section class="main-content">
        <div class="wrapper home tour-landtours">
            <div class="widget_about_5">
                <div class="container">
                    <div class="row">
                        <div class="box-left col-12 col-md-6">
                            <div class="box-content pt-3">
                                <p class="title">{{ get_data_lang($item, 'name') }}</p>
                                <div class="description">
                                    {!! $item->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="box-right col-12 col-md-6">
                            <div class="img">
                                <img src="{{ asset('style/images/banner/default.jpg') }}" data-src="{{ get_file($item->image) }}" alt="Image" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget_item_1">
            <div class="container">
                <div class="list-item">
                    <div class="row">
                        <div class="col-12 col-md-3 item item-icon">
                            <div class="top">
                                <img src="/style/images/icon/_x3C_Layer_x3E_.png" alt="Image">
                                <p class="title">
                                    @lang('messages.tour.time')
                                </p>
                            </div>
                            <p class="description">
                                {{ $item->duration ?? __('messages.dang_cap_nhat') }}
                            </p>
                        </div>
                        <div class="col-12 col-md-3 item item-icon">
                            <div class="top">
                                <img src="/style/images/icon/_x3C_Layer_x3E_1.png" alt="Image">
                                <p class="title">
                                    @lang('messages.tour.so_khach')
                                </p>
                            </div>
                            <p class="description">
                                {{ $item->guest ?? __('messages.dang_cap_nhat') }}
                            </p>
                        </div>
                        <div class="col-12 col-md-3 item item-icon">
                            <div class="top">
                                <img src="/style/images/icon/_x3C_Layer_x3E_2.png" alt="Image">
                                <p class="title">
                                    @lang('messages.ngay_khoi_hanh')
                                </p>
                            </div>
                            <p class="description">
                                {{ $item->from ? date('d/m/Y', strtotime($item->from)) : __('messages.dang_cap_nhat') }}
                            </p>
                        </div>
                        <div class="col-12 col-xl-3 item">
                            <div class="block-price">
                                <div class="outer">
                                    <div class="content-head">
                                        <div class="item"><img src="/style/images/hoanhuy.png"
                                                alt="Image">@lang('messages.tour.hoan_huy_linh_hoat')</div>
                                        <div class="item"><img src="/style/images/antoan.png"
                                                alt="Image">@lang('messages.tour.safe_payment')</div>
                                    </div>
                                    <div class="content-price">
                                        <div class="item">@lang('messages.tour.gia_tu')</div>
                                        <div class="item price">
                                            {{ $item->price ? number_format($item->price) . 'Đ' : __('messages.dang_cap_nhat') }}
                                        </div>
                                    </div>
                                    <div class="content-button">
                                        <button class="btn btn-custom">
                                            @lang('messages.tour.dat_lich')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($item->location_description)
                    <div class="box-content">
                        <div class="row">
                            <div class="col-12 col-md-6 box-img">
                                <div class="img">
                                    <img src="{{ $item->location_img ? get_file($item->location_img) : asset('style/images/default.jpg') }}"
                                        alt="Image">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 box-content-trip">
                                <div class="box-item">
                                    <h3 class="title">
                                        @lang('messages.tour.thong_tin_chuyen_di')
                                    </h3>
                                    <div class="description">
                                        {!! $item->location_description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- start albums --}}
        @include('guest.tours.detail.albums')
        {{-- end albums --}}

        <div class="widget_question widget_question_1">
            <div class="container">
                <div class="tour-content">
                    {!! $item->content !!}

                    {{-- start schedules --}}
                    @include('guest.tours.detail.schedules')
                    {{-- end schedules --}}

                    {{-- start thông tin khác --}}
                    @include('guest.tours.detail.other')
                    {{-- end thông tin khác --}}
                </div>

                {{-- start form đăng ký --}}
                @include('guest.tours.detail.register')
                {{-- end form đăng ký --}}
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('style/plugins/fancybox/fancybox.umd.js') }}"></script>
    <script src="{{ asset('style/plugins/fancybox/de.umd.js') }}"></script>
    <script src="{{ asset('/style/js/tours/detail.js') }}"></script>
@endsection

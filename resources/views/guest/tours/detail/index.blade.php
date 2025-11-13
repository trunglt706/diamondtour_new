@php
    $item = $data['tour'];
@endphp
@extends('guest.layout')
@section('title', get_data_lang($item, 'name'))
@section('keywords', '')
@section('description', stripHtml($item->description))
@section('image', asset($item->image))
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <style>
        .widget_form_contact_style_3,
        .widget_item_1,
        .widget_item_1 .list-item {
            padding: 50px 0 !important;
        }

        .widget_about_5 .box-right img {
            transform: scale(1) !important;
        }

        .tour-content {
            text-align: justify;
        }

        .widget_question.widget_question_1 .accordion-body {
            text-align: justify !important;
        }

        .widget_item_1 .box-content-trip .box-item .description {
            text-align: justify !important;
        }

        .widget_item_1 .list-item .item .top img {
            width: 40px !important;
        }

        .widget_about_5 .box-content .title {
            line-height: 50px !important;
        }

        .tour-content span,
        .tour-content p,
        .tour-content p span,
        .widget_question.widget_question_1 .accordion-body,
        .single-tour-content li {
            font-family: 'Montserrat' !important;
            font-size: 16px !important;
            line-height: 32px !important;
        }

        .widget_question.widget_question_1 .box-content {
            padding-top: 0px !important;
            padding-left: 100px;
        }

        .widget_question_1 {
            padding: 40px 0 !important;
        }

        .block-tour-content .single-tour-content p,
        .block-tour-content .single-tour-content span {
            font-family: 'Montserrat' !important;
        }

        .widget_question.widget_question_1 .accordion-button:not(.collapsed) {
            font-size: 18px !important;
        }

        .widget_question.widget_question_1 .accordion-body img,
        .widget_about_5 .box-right img,
        .widget_about_6 .row-grid .img img {
            border-radius: 8px;
        }

        .widget_question.widget_question_1 .accordion-body img {
            max-height: 330px;
        }

        @media (max-width: 932px) {
            .widget_about_6 .row-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0 !important;
            }

            .block-tour-header .nav-pills .nav-link {
                font-size: 11px !important;
                padding: 5px 10px !important;
            }

            .widget_about_6 .row-grid .img:nth-child(1) {
                display: none;
            }


            .widget_question.widget_question_1 .box-content {
                padding-left: 0px !important;
            }

            .widget_about_5 .box-content .title {
                font-size: 28px !important;
                line-height: 40px !important;
            }

            .widget_item_1 .list-item {
                padding: 15px 0 !important;
            }

            .widget_item_1 .list-item .item .top {
                margin-bottom: 0px !important;
                flex-direction: column;
            }

            .widget_item_1 .box-content {
                padding: 8px !important;
            }

            .widget_item_1 .box-content-trip .box-item {
                padding: 0px !important;
            }

            .widget_item_1 .box-content-trip .box-item .title {
                font-size: 28px !important;
                text-align: center !important;
                margin-top: 12px;
            }

            .header-title-style-3.header-title .header {
                text-align: center !important;
            }

            .widget_form_contact_style_3 .title {
                font-size: 28px !important;
            }

            .widget_item_1 {
                padding: 20px 0 !important;
            }

            .widget_item_1 .list-item .item .description {
                text-align: center !important;
            }

            .header-title-style-3.header-title {
                justify-content: center !important;
            }

            .item-icon {
                width: 33.33% !important;
            }

            .widget_about_6 .row-grid .img {
                padding: 2px;
            }

            .widget_question.widget_question_1 .accordion-body {
                padding-right: 0;
                padding-top: 0;
            }

            .widget_question.widget_question_1 .accordion-body img {
                border-radius: 8px;
                height: 235px;
                width: 100%;
            }

            .widget_about_5 .box-content .description {
                line-height: 28px;
            }
        }
    </style>
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
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/l10n/de.umd.js"></script>
    <script>
        Fancybox.bind('[data-fancybox]', {
            l10n: Fancybox.l10n.de
        });

        $('.btn-submit').click(function() {
            let form = $(this).closest('form'); // Lấy form gần nhất
            let hasEmptyRequiredFields = false;
            form.find('input[required], select[required], textarea[required]').each(function() {
                if ($(this).val() === '') {
                    hasEmptyRequiredFields = true;
                }
            });
            if (!hasEmptyRequiredFields) {
                $(this).html(
                    `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status">Loading...</span>`
                );
            }
        });
    </script>
@endsection

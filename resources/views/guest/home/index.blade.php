@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <style>
        .home .widget_post_style_1.js_widget_post_style_1_2 {
            padding-top: 20px;
        }

        .home .widget_post_style_1.js_widget_post_style_1_1 .item .title .header {
            font-size: 16px !important;
        }

        .home .widget_post_style_1.js_widget_post_style_1_4 .post-detail .item .title .description {
            font-size: 14px !important;
        }

        .slick-prev {
            left: 25px;
        }

        .slick-next {
            right: 23px;
        }

        .slick-prev:before,
        .slick-next:before {
            font-size: 40px;
        }

        .slick-prev,
        .slick-next {
            z-index: 1;
        }

        .home .widget_post_style_1.js_widget_post_style_1_1 .item .title .description {
            max-height: 50px;
        }

        @media (max-width: 932px) {

            .slick-next {
                right: 38px !important;
            }

            .home .widget_feed_style_1 .box-content .box-list-item .item .content p {
                font-size: 17px !important;
                line-height: 30px !important;
            }

            .home .widget_feed_style_1 .box-content .box-list-item .item .content {
                max-width: auto !important;
                min-width: auto !important;
            }

            .main-content {
                padding-top: 54px !important;
            }

            .widget_item_1 {
                display: none;
            }

            .home .widget_post_style_1 {
                padding: 50px 0 0 0 !important;
            }

            .home .widget_post_style_1.js_widget_post_style_1_4,
            .home .widget_feed_style_1 {
                padding: 50px 0 !important;
            }

            .home .widget_post_style_1.js_widget_post_style_1_4 .post-detail .item .title span.chip {
                font-size: 12px !important;
            }

            .home .widget_item_style_1 .box-item .row-grid .item .img img {
                width: 120px !important;
            }

            .home .widget_item_style_2 .row-grid .count-time {
                margin: 0px !important;
            }

            .home .widget_item_style_2 .row-grid .count-time .clock-wrap .clock {
                justify-content: space-around !important;
            }

            .home .widget_item_style_2 .row-grid .count-time .clock-wrap .time {
                font-size: 36px !important;
            }

            .home .widget_post_style_1.js_widget_post_style_1_4 .post-detail .item .title .header {
                font-size: 20px !important;
            }

            .post .item .title .read-more {
                height: auto !important;
                justify-content: end !important;
            }

            .js_widget_post_style_1_2 .post .item .title {
                padding: 30px 20px 15px !important;
            }

            .js_widget_post_style_1_2 .post .item .description {
                margin-top: 0 !important;
            }
        }
    </style>
@endsection

@push('head')
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "{{ config('app.name') }}",
  "url": "{{ url('/') }}",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{{ url('/search?q={search_term_string}') }}",
    "query-input": "required name=search_term_string"
  }
}
</script>
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "TravelAgency",
  "name": "Công ty cổ phần đầu tư và phát triển du lịch Kim Cương - Diamondtour",
  "description": "Diamondtour luôn bám vững theo tiêu chí đặt khách hàng là trung tâm, minh bạch và đề cao chất lượng dịch vụ.",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('/style/images/logo.png') }}",
  "telephone": "+84912115515",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Số 15 ngõ 1, phố Phan Huy Chú, Yết Kiêu, Hà Đông, Hà Nội",
    "addressLocality": "Hà Nội",
    "addressRegion": "Hà Nội",
    "postalCode": "12111",
    "addressCountry": "VN"
  },
  "openingHours": "Mo-Fr 09:00-18:00",
  "sameAs": [
    "https://m.me/diamondtourvn",
    "https://zalo.me/0905615666"
  ]
}
</script>
@endpush

@section('content')
    <section class="main-content">
        <div class="wrapper home">
            {{-- start slider --}}
            @include('guest.home.sliders')
            {{-- end slider --}}

            {{-- start toolbar --}}
            @include('guest.home.toolbar')
            {{-- end toolbar --}}

            {{-- start blog --}}
            @include('guest.home.blogs')
            {{-- end blog --}}

            {{-- start tour --}}
            @include('guest.home.tours')
            {{-- end tour --}}

            {{-- start seasonal tour --}}
            @include('guest.home.seasonal_tours')
            {{-- end seasonal tour --}}

            {{-- start why us --}}
            @include('guest.home.why_us')
            {{-- end why us --}}

            {{-- start event --}}
            @include('guest.home.event')
            {{-- end event --}}

            {{-- start feedback --}}
            @include('guest.home.feedbacks')
            {{-- end feedback --}}

            {{-- start cam nang --}}
            @include('guest.home.cam_nang')
            {{-- end cam nang --}}
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        var url = "{{ route('demo.search') }}";
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                    opens: "left",
                },
                function(start, end, label) {
                    const startDate = start.format("YYYY-MM-DD");
                    const endDate = end.format("YYYY-MM-DD");
                    const url = `/${url}?t=tour&start=${startDate}&end=${endDate}`;
                    location.href = url;
                }
            );
        });
    </script>
    <script src="{{ asset('/style/js/home.js') }}"></script>
@endsection

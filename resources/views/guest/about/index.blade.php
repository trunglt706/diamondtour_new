@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <style>
        .widget_banner .box-content {
            height: 495px;
        }

        .widget_about_3 .content,
        .widget_about_3 .content p {
            font-weight: normal !important;
            text-align: justify !important;
            font-family: 'Montserrat' !important;
        }

        @media (max-width: 932px) {
            .widget_about_3 .header-title p {
                margin: 0px !important;
                font-size: 32px !important;
            }

            .main-content {
                padding-top: 0px !important;
            }

            .widget_banner .box-content {
                height: auto !important;
            }

            .widget_gallery_style_1 {
                padding: 12px !important;
            }

            .home .widget_item_style_1 .box-item .row-grid .item .title h3 {
                font-size: 18px !important;
            }

            .home .widget_item_style_1 .box-item .row-grid .item .img img {
                width: 120px !important;
            }

            .widget_about_3 .user-info .info .name {
                font-size: 20px !important;
            }

            .widget_about_3 .user-info .info .ex,
            .widget_about_3 .user-info .info .description {
                font-size: 16px !important;
            }
        }
    </style>
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home about">
            <div class="widget_banner">
                <div class="box-content">
                    <a href="#"><img src="{{ asset($data['menu']->background) }}" alt="Image 1"></a>
                </div>
            </div>
            <div class="widget_about_3">
                <div class="container">
                    <div class="header-title">
                        <p class="header">@lang('messages.menu.about')</p>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="content">
                                {!! $data['content'] !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="user-info">
                                <div class="img">
                                    <img src="/style/images/banner/founder 1.png" alt="Image">
                                </div>
                                <div class="info">
                                    <p class="name">Mr. Trần Anh Tuấn <br />(Đạo Liên)</p>
                                    <p class="ex">20+ năm kinh nghiệm trong lĩnh vực du lịch</p>
                                    <p class="description">“Với chúng tôi, thành công không tính bằng lợi nhuận mà tính bằng
                                        giá
                                        trị trải nghiệm của Khách hàng trên mỗi hành trình!”</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- start album --}}
            @include('guest.about.album')
            {{-- end album --}}

            {{-- start why us --}}
            @include('guest.home.why_us')
            {{-- end why us --}}
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
    </script>
@endsection

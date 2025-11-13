@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <link rel="stylesheet" href="{{ asset('style/plugins/fancybox/fancybox.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/abount.css') }}">
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home about">
            <div class="widget_banner">
                <div class="box-content">
                    <a href="#"><img src="{{ get_file($data['menu']->background) }}" alt="Image 1"></a>
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
    <script src="{{ asset('style/plugins/fancybox/fancybox.umd.js') }}"></script>
    <script src="{{ asset('style/plugins/fancybox/l10n/de.umd.js') }}"></script>
    <script>
        Fancybox.bind('[data-fancybox]', {
            l10n: Fancybox.l10n.de
        });
    </script>
@endsection

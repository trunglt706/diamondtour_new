<div class="js_widget_builder js_widget_banner_style_1_1 widget_banner_style_1">
    <div class="box-content">
        <div class="banner-grid">
            <div class="banner">
                <a href="">
                    <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ asset($data['menu']->background) }}" alt="Image" title="" loading="lazy">
                </a>
            </div>
            <div class="content">
                {{-- <a class="top">

                </a> --}}
                <div class="slogan">
                    <h1>

                    </h1>
                </div>
                <div class="footer-banner">
                    <div class="left">
                        <p>
                            {{-- @lang('messages.tour.kham_pha_ngay_des') --}}
                        </p>
                    </div>
                    <div class="right">
                        <a href="{{ route('demo.tour.category', ['slug' => 'list']) . '?t=1' }}">@lang('messages.tour.kham_pha_ngay')
                            <span>&#x279D;</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

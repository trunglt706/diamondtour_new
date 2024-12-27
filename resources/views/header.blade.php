<header>
    <div class="box-header">
        <!-- Mobile Header -->
        <div class="wsmobileheader clearfix ">
            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
            <span class="smllogo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('style/images/logo.png') }}" width="80" alt="" />
                </a>
            </span>
        </div>
        <!-- Mobile Header -->
        <div class="container">
            <div class="block-header-main--wrap d-flex flex-row w-100 h-100 align-items-center justify-content-between">
                <div class="block-header-main--logo" aria-label="logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('style/images/logo.png') }}" alt="" class="img-fluid">
                    </a>
                </div>
                <div class="block-header-main--menu">
                    <div class="wsmainwp clearfix">
                        <nav class="wsmenu clearfix">
                            <ul class="wsmenu-list">
                                @foreach ($menus as $item)
                                    @php
                                        $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                        $name = $item->$name ?? $item->name;
                                    @endphp
                                    <li>
                                        <a class="{{ Request::is($item->active) ? 'active' : '' }}"
                                            href="{{ $item->link }}">
                                            {{ $name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="block-header-main--navigation">
                    <div class="d-flex flex-wrap">
                        <div class="block-header-top--language">
                            @php
                                $currentLang = get_list_lang()[$locale];
                            @endphp
                            <a href="#" class="current-language">
                                <img src="{{ $currentLang[2] }}" style="width: 20px; margin-top: -3px;">
                                {{ $currentLang[1] }}
                            </a>
                            <div class="option-select">
                                <ul>
                                    @foreach (get_list_lang() as $key => $item)
                                        <li>
                                            <a href="{{ route('lang.change', $key) }}">
                                                <img class="mr-1" src="{{ $item[2] }}" style="width: 20px">
                                                {{ $item[0] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <li><a href="javascript:void(0)" id="navSearch" class="nav-search" aria-label="search"><i
                                        class="fa-solid fa-magnifying-glass"></i></a></li>
                            <li><a href="javascript:void(0)" id="navContactUs" class="nav-contact-us"
                                    aria-label="more"><i class="fa-solid fa-bars"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-offcanvas-search">
            <button id="offcanvas-search" type="button" class="btn-close d-block mb-3"></button>
            <h2 class="mb-3 text-white fs-4">@lang('messages.tim_kiem_thong_tin')</h2>
            <form class="form-newsletter" action="{{ route('search') }}">
                <input type="text" class="form-control" name="tag"
                    value="{{ isset($_GET['tag']) ? $_GET['tag'] : '' }}" placeholder="@lang('messages.nhap_tu_khoa_tim_kiem')">
                <button class="btn btn-submit" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="box-offcanvas-contact-us">
            <button id="offcanvas-contact-us" type="button" class="btn-close d-block mb-3"></button>
            <div class="-about">
                <img src="{{ get_url($seo['seo-logo']) }}" alt="{{ $seo['seo-logo'] }}" class="img-fluid">
                <p>@lang('messages.khao_khat_truyen_tai_gia_tri_cam_hung')</p>
            </div>
            <div class="-content">
                <h2>@lang('messages.menu.contact')</h2>
                <ul>
                    <li>{{ $seo['contact-address'] }}</li>
                    <li>{{ $seo['contact-phone'] }}</li>
                    <li>{{ $seo['contact-email'] }}</li>
                </ul>
            </div>
            <ul class="-social">
                @foreach ($socials as $item)
                    <li>
                        <a href="{{ $item->link }}">
                            <img src="{{ $item->icon ? get_url($item->icon) : asset('user/img/user/no-avatar.jpg') }}"
                                alt="img" class="icon-footer">
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</header>

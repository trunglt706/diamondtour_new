@php
    $currentName = Route::currentRouteName();
    $currentLang = get_list_lang()[\Config::get('app.locale')];
@endphp
<header>
    <div class="box-header-menu">
        <!-- Mobile Header -->
        <div class="wsmobileheader clearfix ">
            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
            <span class="smllogo">
                <a href="{{ route('demo.home') }}">
                    <img src="{{ asset('/style/images/logo.png') }}" width="80" alt="Image">
                </a>
            </span>
        </div>
        <!-- Mobile Header -->

        <div class="box-header-top">
            <div id="box-container" class="container">
                <div class="row">
                    <div class="col-xl-1 col-lg-2 d-xl-block d-lg-block d-md-none d-sm-none d-none">
                        <div class="block-header-top--logo">
                            <a href="{{ route('demo.home') }}"><img src="{{ asset('/style/images/logo.png') }}"
                                    alt="Image" class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="col-xl-11 col-lg-10 col-md-12 col-sm-12 col-12">
                        <div class="block-header-top--menu-main">
                            <div class="wsmainwp clearfix">
                                <nav class="wsmenu clearfix">
                                    <div class="overlapblackbg"></div>
                                    <ul class="wsmenu-list text-uppercase">
                                        <li><a class="{{ $currentName == 'demo.home' ? 'active' : '' }}"
                                                href="{{ route('demo.home') }}">@lang('messages.menu.home')</a></li>
                                        <li><a class="{{ $currentName == 'demo.about' ? 'active' : '' }}"
                                                href="{{ route('demo.about') }}">@lang('messages.menu.about')</a></li>
                                        <li><a class="{{ in_array($currentName, ['demo.tour.index', 'demo.tour.category', 'demo.tour.detail']) ? 'active' : '' }}"
                                                href="{{ route('demo.tour.index') }}">@lang('messages.menu.tour')</a></li>
                                        <li><a class="{{ $currentName == 'demo.landtour.index' ? 'active' : '' }}"
                                                href="{{ route('demo.landtour.index') }}">@lang('messages.menu.landtour')</a></li>
                                        <li><a class="{{ $currentName == 'demo.service.index' ? 'active' : '' }}"
                                                href="{{ route('demo.service.index') }}">@lang('messages.menu.service')</a></li>
                                        <li><a class="{{ in_array($currentName, ['demo.blog.index', 'demo.blog.category', 'demo.blog.detail']) ? 'active' : '' }}"
                                                href="{{ route('demo.blog.index') }}">@lang('messages.menu.blog')</a></li>
                                        <li><a class="{{ in_array($currentName, ['demo.library.index', 'demo.library.category', 'demo.library.detail']) ? 'active' : '' }}"
                                                href="{{ route('demo.library.index') }}">@lang('messages.menu.album')</a></li>
                                        <li><a class="{{ $currentName == 'demo.contact.index' ? 'active' : '' }}"
                                                href="{{ route('demo.contact.index') }}">@lang('messages.menu.contact')</a></li>
                                        <li class="li-search-sp menu-addon">
                                            <div class="header-search">
                                                <div class="header-block-search">
                                                    <form action="{{ route('demo.search') }}">
                                                        <input name="search" type="text"
                                                            value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}"
                                                            placeholder="@lang('messages.tim_kiem') ...">
                                                        <button type="submit" class="btn btn-search"><img
                                                                class="img-lang"
                                                                src="{{ asset('/style/images/icon-search.png') }}"
                                                                alt="Image"></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="li-logo2-sp">
                                            <img class="img-lang" src="{{ asset('/style/images/logo_VAJRA.png') }}"
                                                alt="Image">
                                        </li>
                                        <li class="li-lang-sp">
                                            @foreach (get_list_lang() as $key => $item)
                                                <a href="{{ route('demo.lang.change', $key) }}">
                                                    <img class="img-lang" src="{{ $item[2] }}" style="width: 20px"
                                                        alt="Image">
                                                    {{ $item[0] }}
                                                </a>
                                            @endforeach
                                        </li>
                                    </ul>
                                    <div class="menu-addon">
                                        <div class="header-lang dropdown">
                                            <button type="button" class="btn dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <img alt="Image" class="img-lang" src="{{ $currentLang[2] }}"
                                                    style="width: 20px;">
                                                {{ $currentLang[1] }}
                                            </button>
                                            <ul class="dropdown-menu ps-2">
                                                @foreach (get_list_lang() as $key => $item)
                                                    <li>
                                                        <a href="{{ route('demo.lang.change', $key) }}">
                                                            <img class="img-lang" src="{{ $item[2] }}"
                                                                style="width: 20px">
                                                            {{ $item[0] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="header-search">
                                            <div class="header-block-search">
                                                <form action="{{ route('demo.search') }}">
                                                    <input type="text" name="search"
                                                        value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}"
                                                        placeholder=" @lang('messages.tim_kiem') ...">
                                                    <button type="submit" class="btn btn-search"><img class="img-lang"
                                                            src="{{ asset('/style/images/icon-search.png') }}"
                                                            alt="Image"></button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="header-logo-2">
                                            <img class="img-lang" src="{{ asset('/style/images/logo_VAJRA.png') }}"
                                                alt="Image">
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

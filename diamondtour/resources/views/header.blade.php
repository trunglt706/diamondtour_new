<header>
    <div class="box-header">
        <!-- Mobile Header -->
        <div class="wsmobileheader clearfix ">
            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
            <span class="smllogo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" width="80" alt="" />
                </a>
            </span>
        </div>
        <!-- Mobile Header -->
        <div class="container">
            <div class="block-header-main--wrap d-flex flex-row w-100 h-100 align-items-center justify-content-between">
                <div class="block-header-main--logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="" class="img-fluid">
                    </a>
                </div>
                <div class="block-header-main--menu">
                    <div class="wsmainwp clearfix">
                        <nav class="wsmenu clearfix">
                            <ul class="wsmenu-list">
                                <li>
                                    <a class="{{ Request::is('/') ? 'active' : '' }}" href="{{ route('index') }}">Trang
                                        chủ</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('about') ? 'active' : '' }}"
                                        href="{{ route('about') }}">Giới
                                        thiệu</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('destination*') ? 'active' : '' }}"
                                        href="{{ route('destination.index') }}">Điểm đến</a>
                                </li>
                                <li>
                                    <a class="" href="{{ route('index') }}">Du lịch</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('blog*') ? 'active' : '' }}"
                                        href="{{ route('blog.index') }}">Bài
                                        viết</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('library*') ? 'active' : '' }}"
                                        href="{{ route('library.index') }}">Thư viện</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="block-header-main--navigation">
                    <!-- <a href="#"><i class="fa-solid fa-bars"></i></a> -->
                </div>
            </div>
        </div>
    </div>
</header>

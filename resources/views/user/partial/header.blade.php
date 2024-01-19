<!-- BEGIN #header -->
<div id="header" class="app-header">
    <!-- BEGIN mobile-toggler -->
    <div class="mobile-toggler">
        <button type="button" class="menu-toggler"
            @if (!empty($appTopNav) && !empty($appSidebarHide)) data-toggle="top-nav-mobile" @else data-toggle="sidebar-mobile" @endif>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </div>
    <!-- END mobile-toggler -->

    <!-- BEGIN brand -->
    <div class="brand">
        <div class="desktop-toggler">
            <button type="button" class="menu-toggler"
                @if (empty($appSidebarHide)) data-toggle="sidebar-minify" @endif>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
        <a href="{{ route('user.index') }}" class="brand-logo">
            <img src="{{ get_option('seo-logo', asset('user/img/logo.png')) }}" class="invert-dark" alt="logo"
                height="50" />
        </a>
    </div>
    <!-- END brand -->

    <!-- BEGIN menu -->
    <div class="menu">
        <form class="menu-search" method="POST" name="header_search_form">
            <div class="menu-search-icon"><i class="fa fa-search"></i></div>
            <div class="menu-search-input">
                <input type="text" class="form-control" placeholder="Tìm ..." />
            </div>
        </form>
        <div class="menu-item dropdown">
            <a href="#" data-bs-toggle="dropdown" data-display="static" class="menu-link">
                <div class="menu-text text-end me-2">
                    Quản trị viên
                    <div class="text-wrap text-body-secondary fs-6 st-italic">
                        {{ $user_info->name }}
                    </div>
                </div>
                <div class="menu-img online">
                    <img src="{{ $user_info->avatar ?? asset('user/img/avatar.png') }}" alt="staff"
                        class="ms-100 mh-100 rounded-circle" />
                </div>
            </a>
            <div class="dropdown-menu staff-header dropdown-menu-end me-lg-3">
                <a class="dropdown-item" href="{{ route('user.profile.index') }}">
                    <i class="fa fa-user-circle fa-fw ms-auto text-body text-opacity-50"></i> Cá nhân
                </a>
                <button class="dropdown-item" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt fa-fw ms-auto text-body text-opacity-50"></i> Đăng xuất
                </button>
            </div>
        </div>
    </div>
    <!-- END menu -->
</div>
<!-- END #header -->

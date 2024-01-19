<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"{{ !empty($htmlAttribute) ? $htmlAttribute : '' }}>

<head>
    @include('user.partial.head')
</head>

<body class="{{ !empty($bodyClass) ? $bodyClass : '' }}">
    <!-- BEGIN #app -->
    <div id="app" class="app {{ !empty($appClass) ? $appClass : '' }}">
        @includeWhen(empty($appHeaderHide), 'user.partial.header')
        @includeWhen(empty($appSidebarHide), 'user.partial.sidebar')
        @includeWhen(!empty($appTopNav), 'user.partial.top-nav')

        @if (empty($appContentHide))
            <!-- BEGIN #content -->
            <div id="content" class="app-content  {{ !empty($appContentClass) ? $appContentClass : '' }}">
                @yield('content')
            </div>
            <!-- END #content -->
        @else
            @yield('content')
        @endif

        @includeWhen(empty($appFooter), 'user.partial.footer')
    </div>
    <!-- END #app -->

    @include('user.partial.scroll-top-btn')
    @include('user.partial.scripts')
</body>

</html>

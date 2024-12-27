@php
    $seo_be = isset($data['seo'])
        ? $data['seo']
        : [
            'description' => '',
            'title' => '',
            'image' => '',
        ];
@endphp
<!DOCTYPE html>
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('style/images/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $seo_be['title'] ?? $seo['seo-name'] }}</title>
    <meta name="description" content="{{ $seo_be['description'] }}" />
    <meta name="keywords" content="{{ isset($seo_be['keywords']) ? $seo_be['keywords'] : 'Diamondtour, du lịch' }}" />
    <meta name="copyright" content="Diamondtour" />
    <meta name="author" content="Diamondtour" />
    <meta name="robots" content="noarchive, max-image-preview:large, index" />
    <meta name="googlebot" content="noarchive" />
    <meta name="geo.placename" content="Ha Noi, Viet Nam" />
    <meta name="geo.region" content="VN-HN" />
    <meta content="vi-VN" itemprop="inLanguage" />
    <!-- META FOR FACEBOOK -->
    <meta content="{{ $seo_be['title'] }}" property="og:title" />
    <meta content="{{ $seo_be['description'] }}" property="og:description" />
    <meta property="og:image" itemprop="thumbnailUrl" content="{{ get_url($seo_be['image']) }}" />
    <meta property="og:site_name" content="{{ request()->getHost() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" itemprop="url" content="{{ url()->current() }}" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="354" />
    <!-- END META FOR FACEBOOK -->

    <!-- Twitter Card -->
    <meta name="twitter:card" value="summary" />
    <meta name="twitter:url" content="{{ url()->current() }}" />
    <meta name="twitter:title" content="{{ $seo_be['title'] }}" />
    <meta name="twitter:description" content="{{ $seo_be['description'] }}" />
    <meta name="twitter:image" content="{{ get_url($seo_be['image']) }}" />
    <meta name="twitter:site" content="{{ request()->getHost() }}" />
    <meta name="twitter:creator" content="Diamondtour" />
    <!-- End Twitter Card -->
    @include('style')
    @if (in_array(Route::currentRouteName(), ['blog.detail', 'destination.detail']))
        <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=65dd20dcd41ded001ab5b52f&product=inline-share-buttons&source=platform"
            async="async"></script>
    @endif
</head>

<body>
    @include('header')
    <article>
        @yield('content')
    </article>
    @include('footer')
    @include('script')
    @yield('ajax')
    @yield('script_module')
</body>

</html>

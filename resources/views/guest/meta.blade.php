@php
    $url_current = url()->current();
@endphp

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8">
<title>@yield('title')</title>
<link rel="canonical" href="{{ $url_current }}" />
@stack('head')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="@yield('description')">
<meta name="keyword" content="@yield('keyword')">
<meta name="copyright" content="Diamondtour" />
<meta name="author" content="Diamondtour" />
<meta name="robots" content="noarchive, max-image-preview:large, index" />
<meta name="googlebot" content="noarchive" />
<meta name="geo.placename" content="Ha Noi, Viet Nam" />
<meta name="geo.region" content="VN-HN" />
<meta content="vi-VN" itemprop="inLanguage" />

<!-- META FOR FACEBOOK -->
<meta property="og:image" content="@yield('image')" />
<meta property="og:image:alt" content="@yield('title')" />
<meta property='og:type' content='website' />
<meta property="og:url" content="{{ $url_current }}" />
<meta property="og:title" content="@yield('title')" />
<meta property="og:description" content="@yield('description')">
<!-- END META FOR FACEBOOK -->

<!-- Twitter Card -->
<meta name="twitter:card" value="summary" />
<meta name="twitter:url" content="{{ $url_current }}" />
<meta name="twitter:title" content="@yield('title')" />
<meta name="twitter:description" content="@yield('description')" />
<meta name="twitter:image" content="@yield('image')" />
<meta name="twitter:site" content="{{ request()->getHost() }}" />
<meta name="twitter:creator" content="Diamondtour" />
<!-- End Twitter Card -->

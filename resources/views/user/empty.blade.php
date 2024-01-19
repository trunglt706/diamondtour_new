<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"{{ !empty($htmlAttribute) ? $htmlAttribute : '' }}>

<head>
    @include('user.partial.head')
</head>

<body class="{{ !empty($bodyClass) ? $bodyClass : '' }} bg-primary-subtle">
    @yield('content')

    @include('user.partial.scroll-top-btn')
    @include('user.partial.scripts')
</body>

</html>

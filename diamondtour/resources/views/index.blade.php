<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favico.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} - </title>
    @include('style')
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

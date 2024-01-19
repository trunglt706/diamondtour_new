<meta charset="utf-8" />
<title>Admin | @yield('title')</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ get_option('seo-favicon', asset('user/img/favicon.png')) }}">

<meta name="viewport" content="width=device-width, initial-scale=1" />

@stack('metaTag')

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="{{ asset('user/css/vendor.min.css') }}" rel="stylesheet" />
<link href="{{ asset('user/css/app.min.css') }}" rel="stylesheet" />
<style>
    .app-header .brand img {
        max-height: 60px !important;
    }
</style>
<!-- ================== END BASE CSS STYLE ================== -->
@stack('css')
<link href="{{ asset('user/css/select2.min.css') }}" rel="stylesheet" />
@if (auth()->check())
    <link href="{{ asset('user/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('user/plugins/select-picker/dist/picker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/plugins/spectrum-colorpicker2/dist/spectrum.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('user/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/custom.css') }}">
@endif

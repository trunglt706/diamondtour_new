<meta charset="utf-8" />
<title>Admin | @yield('title')</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('style/images/favicon.png') }}">

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
<style>
    #hdModal ul li {
        margin-bottom: 8px;
    }

    .btn-hd {
        position: absolute;
        top: 40%;
        right: 25px;
        padding: 16px;
        background-color: #e14f4f;
        /* Button background color */
        color: white;
        /* Icon color */
        border-radius: 50%;
        /* Make it circular */
        transition: transform 0.3s ease, background-color 0.3s ease;
        font-size: 20px;
        animation: shake 0.5s ease-in-out 3s infinite;
        /* Shake effect every 3 seconds */
    }

    .btn-hd:hover {
        transform: scale(1.1);
        /* Scale up slightly on hover */
        background-color: #45a049;
        /* Darker green on hover */
    }

    .btn-hd .fa-edit {
        transition: transform 0.3s ease;
        font-size: 30px;
    }

    .btn-hd:hover .fa-edit {
        transform: rotate(20deg);
        /* Rotate icon slightly on hover */
    }

    /* Shake animation keyframes */
    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
        }

        50% {
            transform: translateX(5px);
        }

        75% {
            transform: translateX(-5px);
        }
    }
</style>

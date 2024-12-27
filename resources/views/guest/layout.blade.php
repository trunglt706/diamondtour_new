<!DOCTYPE html>
<html lang="vi">

<head>
    @include('guest.meta')
    @include('guest.style')
    @stack('head')
</head>

<body>
    @include('guest.header')
    @yield('content')
    @include('guest.footer')
    @include('guest.general.call')
    @include('guest.script')
</body>

</html>

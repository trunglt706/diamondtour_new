<script src="{{ asset('/style/js/jquery-3.7.0.min.js') }}"></script>
<script src="{{ asset('/style/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('style/plugins/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('/style/js/webslidemenu.js') }}"></script>
<script src="{{ asset('/style/js/slick.min.js') }}"></script>
<script src="{{ asset('user/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('style/plugins/momentjs/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('style/plugins/daterangepicker/daterangepicker.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('style/plugins/daterangepicker/daterangepicker.css') }}" />

@yield('script')
<script src="{{ asset('/style/js/myscript.js') }}"></script>
@stack('js')
<script>
    @if (session('success'))
        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        });
    @endif

    @if (session('error'))
        Toast.fire({
            icon: 'error',
            title: "{{ session('error') }}"
        });
    @endif

    @if ($errors->any())
        Toast.fire({
            icon: 'error',
            title: "{{ $errors->first() }}"
        });
    @endif
</script>

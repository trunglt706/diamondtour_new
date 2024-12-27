<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/webslidemenu.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-5-select/js/bootstrap-select.min.js') }}"></script>
@yield('plugins_script')
<script src="{{ asset('user/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/site.js') }}"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
    });

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

    $(document).ready(function() {
        checkShowSocial();
    });

    $(window).on('scroll', function() {
        checkShowSocial();
    });

    function checkShowSocial() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 50) {
            $('.footer-copyright .-social').removeClass('right');
        } else {
            $('.footer-copyright .-social').addClass('right');
        }
    }
</script>

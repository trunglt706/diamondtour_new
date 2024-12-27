<script src="{{ asset('/style/js/jquery-3.7.0.min.js') }}"></script>
<script src="{{ asset('/style/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('/style/js/webslidemenu.js') }}"></script>
<script src="{{ asset('/style/js/slick.min.js') }}"></script>
<script src="{{ asset('user/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@yield('script')
<script src="{{ asset('/style/js/myscript.js') }}"></script>
@stack('js')
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
                opens: "left",
            },
            function(start, end, label) {
                const startDate = start.format("YYYY-MM-DD");
                const endDate = end.format("YYYY-MM-DD");
                const url = `/search?t=tour&start=${startDate}&end=${endDate}`;
                location.href = url;
            }
        );
    });

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
</script>

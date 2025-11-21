<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('user/js/vendor.min.js') }}"></script>
<script src="{{ asset('user/js/app.min.js') }}"></script>
<script src="{{ asset('user/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('user/js/select2.min.js') }}"></script>
<script>
    var urlLogout = "{{ route('user.logout') }}";
    const routeSelect = "{{ route('user.get_data_select2') }}";
    let page = 1;
    const userId = "{{ auth()->check() ? auth()->user()->id : 0 }}";
    let btnTrigger = '';

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
@if (auth()->check())
    <script src="{{ asset('user/plugins/select-picker/dist/picker.min.js') }}"></script>
    <script src="{{ asset('user/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('user/js/init.js') }}"></script>
@endif
@stack('js')
<script src="{{ asset('user/js/custom.js') }}"></script>

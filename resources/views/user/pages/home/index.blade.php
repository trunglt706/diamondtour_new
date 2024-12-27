@extends('user.default')
@section('title', 'Trang chủ')
@section('content')
    <style>
        .load-card {
            height: 300px;
            overflow-y: scroll;
        }

        .load-card a {
            text-decoration: none;
            color: #000;
        }
    </style>
    <div class="row">
        <div class="col">
            <a href="{{ route('user.user.index') }}" class="text-decoration-none">
                <div class="card mb-2">
                    <div class="card-body d-flex align-items-center">
                        <div
                            class="w-40px h-40px d-flex align-items-center justify-content-center bg-gradient-yellow-red text-white rounded-2 ms-n1">
                            <i class="fas fa-user-circle fa-lg"></i>
                        </div>
                        <div class="flex-fill px-3 py-1">
                            <div class="fw-semibold text-danger">
                                {{ number_format($data['users']) }}
                            </div>
                            <div class="small text-body text-opacity-50">
                                Quản trị viên
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('user.blog.index') }}" class="text-decoration-none">
                <div class="card mb-2">
                    <div class="card-body d-flex align-items-center">
                        <div
                            class="w-40px h-40px d-flex align-items-center justify-content-center bg-gradient-custom-indigo text-white rounded-2 ms-n1">
                            <i class="fas fa-file-alt fa-lg"></i>
                        </div>
                        <div class="flex-fill px-3 py-1">
                            <div class="fw-semibold text-danger">
                                {{ number_format($data['blogs']) }}
                            </div>
                            <div class="small text-body text-opacity-50">
                                Blogs
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('user.tour.index') }}" class="text-decoration-none">
                <div class="card mb-2">
                    <div class="card-body d-flex align-items-center">
                        <div
                            class="w-40px h-40px d-flex align-items-center justify-content-center bg-gradient-custom-blue text-white rounded-2 ms-n1">
                            <i class="fas fa-plane-departure fa-lg"></i>
                        </div>
                        <div class="flex-fill px-3 py-1">
                            <div class="fw-semibold text-danger">
                                {{ number_format($data['tours']) }}
                            </div>
                            <div class="small text-body text-opacity-50">
                                Tours
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('user.destination.index') }}" class="text-decoration-none">
                <div class="card mb-2">
                    <div class="card-body d-flex align-items-center">
                        <div
                            class="w-40px h-40px d-flex align-items-center justify-content-center bg-gradient-custom-blue text-white rounded-2 ms-n1">
                            <i class="fas fa-map-marker-alt fa-lg"></i>
                        </div>
                        <div class="flex-fill px-3 py-1">
                            <div class="fw-semibold text-danger">
                                {{ number_format($data['destinations']) }}
                            </div>
                            <div class="small text-body text-opacity-50">
                                Điểm đến
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-history"></i> Các hoạt động gần đây
                    </div>
                    <a class="text-decoration-none" href="{{ route('user.log_action.index') }}">Xem thêm</a>
                </div>
                <div class="card-body load-log_action load-card">

                </div>
            </div>

        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-user-clock"></i> Liên hệ gần đây
                    </div>
                    <a class="text-decoration-none" href="{{ route('user.contact.index') }}">Xem thêm</a>
                </div>
                <div class="card-body load-contact load-card">

                </div>
            </div>

        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-gift"></i> Đăng ký nhận ưu đãi gần đây
                    </div>
                    <a class="text-decoration-none" href="{{ route('user.register_promo.index') }}">Xem thêm</a>
                </div>
                <div class="card-body load-register_promo load-card">

                </div>
            </div>

        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-plane-departure"></i> Đăng ký tour gần đây
                    </div>
                    <a class="text-decoration-none" href="{{ route('user.register_tour.index') }}">Xem thêm</a>
                </div>
                <div class="card-body load-register_tour load-card">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        load_log_action();
        load_contact();
        load_register_promo();
        load_register_tour();

        function load_log_action() {
            showSniper('.load-log_action');
            $.ajax({
                async: true,
                method: 'POST',
                url: "{{ route('user.home.log_action') }}",
            }).done(function(data) {
                hideSniper('.load-log_action');
                $('.load-log_action').html(data);
            });
        }

        function load_contact() {
            showSniper('.load-contact');
            $.ajax({
                async: true,
                method: 'POST',
                url: "{{ route('user.home.contact') }}",
            }).done(function(data) {
                hideSniper('.load-contact');
                $('.load-contact').html(data);
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
                    tooltipTriggerEl))
            });
        }

        function load_register_promo() {
            showSniper('.load-register_promo');
            $.ajax({
                async: true,
                method: 'POST',
                url: "{{ route('user.home.register_promo') }}",
            }).done(function(data) {
                hideSniper('.load-register_promo');
                $('.load-register_promo').html(data);
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
                    tooltipTriggerEl))
            });
        }

        function load_register_tour() {
            showSniper('.load-register_tour');
            $.ajax({
                async: true,
                method: 'POST',
                url: "{{ route('user.home.register_tour') }}",
            }).done(function(data) {
                hideSniper('.load-register_tour');
                $('.load-register_tour').html(data);
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
                    tooltipTriggerEl))
            });
        }
    </script>
@endpush

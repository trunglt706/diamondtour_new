@extends('user.default')
@section('title', 'Trang chủ')
@section('content')
    <div class="row">
        <div class="col">
            <a href="{{ route('user.user.index') }}" class="text-decoration-none">
                <div class="card mb-2">
                    <div class="card-body d-flex align-items-center">
                        <div
                            class="w-40px h-40px d-flex align-items-center justify-content-center bg-gradient-yellow-red text-white rounded-2 ms-n1">
                            <i class="fas fa-user-shield fa-lg"></i>
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
                            <i class="far fa-id-badge fa-lg"></i>
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
                            <i class="far fa-copyright fa-lg"></i>
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
                            <i class="fas fa-store fa-lg"></i>
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
@endsection

@extends('user.empty')
@section('title', 'Đăng nhập')
@section('content')
    <!-- BEGIN login -->
    <div class="login">
        <!-- BEGIN login-content -->
        <div class="login-content">
            <div class="card rounded-4">
                <div class="card-body">
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <h4 class="text-center text-uppercase">Đăng nhập</h4>
                        <div class="text-gray-400 text-center mb-4">
                            Đăng nhập tài khoản quản trị viên
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger text-center">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger fw-900">*</span></label>
                            <input type="email" name="email" class="form-control form-control-lg fs-15px"
                                placeholder="Nhập email" value="admin@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu <span class="text-danger fw-900">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password" value="123456"
                                    class="form-control form-control-lg fs-15px" placeholder="Nhập mật khẩu" required>
                                <span role="button" class="input-group-text show-password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-gradient-yellow-orange btn-lg d-block w-100 fw-500">
                            Đăng nhập
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- END login-content -->
    </div>
    <!-- END login -->
@endsection

<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('user.user.update_account') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-2">
                    <div class="form-group">
                        <label class="col-form-label">Mật khẩu mới <span class="text-danger fw-900">*</span></label>
                        <div class="input-group">
                            <input type="password" required class="form-control" name="password">
                            <span role="button" class="input-group-text show-password">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-2">
                    <div class="form-group">
                        <label class="col-form-label">Nhập lại mật khẩu <span
                                class="text-danger fw-900">*</span></label>
                        <div class="input-group">
                            <input type="password" required class="form-control" name="confirm_password">
                            <span role="button" class="input-group-text show-password">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-4">
                {!! NoCaptcha::display() !!}
            </div>
            <button type="submit" class="btn bg-gradient-cyan-blue btn-create text-white">
                <i class="fas fa-save"></i> Cập nhật
            </button>
        </form>
    </div>
</div>

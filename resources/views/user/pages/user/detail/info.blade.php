<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('admin.admin.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="all">
            <input type="hidden" name="id" value="{{ $admin->id }}">
            <div class="row">
                <div class="col-md-6 mb-2 form-group">
                    <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                    <input type="text" class="form-control" value="{{ $admin->name }}" name="name">
                </div>
                <div class="form-group col-md-6 mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="col-form-label">Quyền <span class="text-danger fw-900">*</span></label>
                        @if ($admin_info->can('admin|role|create'))
                            <span class="add-new" role="button" data-bs-toggle="tooltip" title="Tạo mới"
                                data-modal="addRoleModal">
                                <i class="fas fa-plus"></i>
                            </span>
                        @endif
                    </div>
                    <select name="role_id" required class="form-select filter-role_id">
                        @if ($admin->role)
                            <option value="{{ $admin->role_id }}">{{ $admin->role->name }}</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-12 mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="col-form-label">Điện thoại </label>
                        <a href="#" class="edit-data" data-show="update-phone" data-bs-toggle="tooltip"
                            title="Click để cập nhật">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <input type="text" class="form-control update-phone"
                        value="{{ $hide_phone_admin == 'yes' ? $admin->phone : show_mask($admin, 'phone') }}" disabled
                        name="phone">
                </div>
                <div class="col-md-6 col-sm-12 mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="col-form-label">Email </label>
                        <a href="#" class="edit-data" data-show="update-email" data-bs-toggle="tooltip"
                            title="Click để cập nhật">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <input type="text" class="form-control update-email"
                        value="{{ $hide_email_admin == 'yes' ? $admin->email : show_mask($admin, 'email') }}" disabled
                        name="email">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 form-group mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="col-form-label">Nhóm</label>
                        @if ($admin_info->can('admin|group|create'))
                            <span class="add-new" role="button" data-bs-toggle="tooltip" title="Tạo mới"
                                data-modal="addGroupModal">
                                <i class="fas fa-plus"></i>
                            </span>
                        @endif
                    </div>
                    <select name="group_id" class="form-select filter-group_id">
                        @if ($admin->group)
                            <option value="{{ $admin->group_id }}">{{ $admin->group->name }}</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-6 col-sm-12 mb-2 form-group">
                    <label class="col-form-label">Ảnh đại diện</label>
                    <input type="file" class="form-control previewImg" name="avatar" accept="image/*">
                </div>
            </div>
            <div class="row">
                @if ($admin_info->admin)
                    <div class="col-md-6 col-sm-12 py-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="admin" value="1" type="checkbox" role="switch"
                                id="switch_admin" {{ $admin->admin == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="switch_admin">
                                Tài khoản admin <i class="fas fa-question-circle" data-bs-toggle="tooltip"
                                    title="Có toàn quyền"></i>
                            </label>
                        </div>
                    </div>
                @endif
                @if ($admin->admin == 0)
                    <div class="col-md-6 col-sm-12 mb-2">
                        <div class="form-group">
                            <label class="col-form-label">Ngày hết hạn</label>
                            <input type="text" class="form-control datepicker"
                                value="{{ $admin->time_expired ? date('d-m-Y', $admin->time_expired) : '' }}"
                                name="time_expired">
                        </div>
                    </div>
                @endif
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
<div class="mt-3">
    <h4 class="text-uppercase text-underline">Lưu ý</h4>
    <div class="alert alert-warning" role="alert">
        <ul>
            <li>
                Khi thay đổi quyền, quyển của người dùng cũng sẽ thay đổi theo tương ứng
            </li>
            <li>
                Tài khoản admin là tài khoản có toàn quyền trên hệ thống
            </li>
            <li>
                Nếu muốn thay đổi thông tin điện thoại hoặc email, click bào biểu tượng <i class="fas fa-edit"></i> rồi
                tiến hành cập nhật
            </li>
        </ul>
    </div>
</div>
@if ($admin_info->can('admin|role|create'))
    @include('admin::admin.form.createGroup')
@endif
@if ($admin_info->can('admin|group|create'))
    @include('admin::admin.form.createRole')
@endif
@push('js')
    @include('admin::admin.detail.script.info')
@endpush

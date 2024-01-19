<div class="profile-sidebar w-250px">
    <div class="desktop-sticky-top">
        <div class="text-center">
            <h4>{{ $admin->name }}</h4>
            <div class="fw-500 mb-3 text-muted mt-n2">{{ $admin->code }}</div>
        </div>
        <div class="mb-1 d-flex justify-content-between">
            <div>
                <i class="fas fa-mobile-alt fa-fw text-muted"></i>
                <span
                    class="show-data">{{ $hide_phone_admin == 'yes' ? $admin->phone : show_mask($admin, 'phone') }}</span>
            </div>
            @if ($hide_phone_admin == 'yes')
                <span role="button" data-table="admins" data-column="phone" data-id="{{ $admin->id }}"
                    class="h-20px w-20px show-secret-data" data-bs-toggle="tooltip" title="Sao chép dữ liệu">
                    <i class="fas fa-clone"></i>
                </span>
            @endif
        </div>
        <div class="mb-3 d-flex justify-content-between">
            <div>
                <i class="fas fa-envelope-open-text fa-fw text-muted"></i>
                <span
                    class="show-data">{{ $hide_email_admin == 'yes' ? $admin->email : show_mask($admin, 'email') }}</span>
            </div>
            @if ($hide_email_admin == 'yes')
                <span role="button" data-table="admins" data-column="email" data-id="{{ $admin->id }}"
                    class="h-20px w-20px show-secret-data" data-bs-toggle="tooltip" title="Sao chép dữ liệu">
                    <i class="fas fa-clone"></i>
                </span>
            @endif
        </div>
        <hr class="mt-4 mb-4">
        <div class="d-flex align-items-center mb-3 justify-content-between">
            Quyền
            @if ($admin->role)
                <a class="text-decoration-none" href="{{ route('role.detail', ['id' => $admin->role_id]) }}">
                    {{ $admin->role->name }}
                </a>
            @else
                <span>-</span>
            @endif
        </div>
        <div class="d-flex align-items-center mb-3 justify-content-between">
            Nhóm
            @if ($admin->group)
                <a class="text-decoration-none"
                    href="{{ route('admin.admin_group.detail', ['id' => $admin->group_id]) }}">
                    {{ $admin->group->name }}
                </a>
            @else
                <span>-</span>
            @endif
        </div>
        <div class="d-flex align-items-center mb-3 justify-content-between">
            Ngày tạo <span
                class="text-success">{{ $admin->created_at ? date('d/m/Y', $admin->created_at) : '-' }}</span>
        </div>
        <div class="d-flex align-items-center mb-3 justify-content-between">
            Cập nhật lần cuối <span>{{ $admin->updated_at ? date('d/m/Y', $admin->updated_at) : '-' }}</span>
        </div>
        <div class="d-flex align-items-center mb-3 justify-content-between">
            <span>
                Ngày hết hạn <i class="fas fa-question-circle mr-2" data-bs-toggle="tooltip"
                    title="Đến ngày hết hạn, tài khoản sẽ tự động bị khóa"></i>
            </span>
            <span class="text-warning">{{ $admin->time_expired ? date('d/m/Y', $admin->time_expired) : '-' }}</span>
        </div>
        <div class="d-flex align-items-center mb-3 justify-content-between">
            Đăng nhập lần cuối <span>{{ $admin->last_login ? date('H:i d/m/Y', $admin->last_login) : '-' }}</span>
        </div>
        <div class="d-flex align-items-center mb-3 justify-content-between">
            Trạng thái
            <span
                class="badge bg-{{ $status[1] }} text-{{ $status[1] }} bg-opacity-15 px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                <i class="fa fa-circle text-{{ $status[1] }} fs-9px fa-fw me-5px"></i> {{ $status[0] }}
            </span>
        </div>
    </div>
    @if ($admin->status == 'blocked')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Quản trị viên này đã bị khóa, không thể đăng nhập vào hệ thống
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

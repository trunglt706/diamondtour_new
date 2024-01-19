<div class="profile-header">
    <div class="profile-header-cover">
        @if ($admin->status == 'active' && $admin_info->can('admin|admin|update_status') && $admin->id != $admin_info->id)
            <button class="btn btn-danger update-status absolute" data-status="blocked" data-id="{{ $admin->id }}">
                <i class="fas fa-lock"></i> Khóa
            </button>
        @endif
        @if ($admin->status != 'active' && $admin_info->can('admin|admin|update_status') && $admin->id != $admin_info->id)
            <button class="btn btn-success update-status absolute" data-status="active" data-id="{{ $admin->id }}">
                <i class="fas fa-check"></i> Kích hoạt
            </button>
        @endif
    </div>
    <div class="profile-header-content" style="padding: 0 25px">
        <div class="profile-header-img">
            <img class="h-100" class="preview" src="{{ $admin->avatar ?? asset('assets/img/user/no-avatar.jpg') }}"
                alt="admin">
        </div>
        <ul class="profile-header-tab nav nav-tabs nav-tabs-v2 ms-50px">
            @if ($admin_info->can('admin|admin|update'))
                <li class="nav-item">
                    <a href="{{ route('admin.admin.detail', ['id' => $admin->id]) }}?tab=info"
                        class="nav-link {{ $tab == 'info' ? 'active' : '' }}">
                        <div class="nav-field text-uppercase">
                            <i class="fas fa-info-circle"></i> Cá nhân
                        </div>
                    </a>
                </li>
            @endif
            @if ($admin_info->can('admin|admin|update_password'))
                <li class="nav-item">
                    <a href="{{ route('admin.admin.detail', ['id' => $admin->id]) }}?tab=account"
                        class="nav-link {{ $tab == 'account' ? 'active' : '' }}">
                        <div class="nav-field text-uppercase">
                            <i class="far fa-user"></i> Tài khoản
                        </div>
                    </a>
                </li>
            @endif
            @if ($admin_info->can('admin|admin|history'))
                <li class="nav-item">
                    <a href="{{ route('admin.admin.detail', ['id' => $admin->id]) }}?tab=history"
                        class="nav-link {{ $tab == 'history' ? 'active' : '' }}">
                        <div class="nav-field text-uppercase">
                            <i class="fas fa-undo"></i> Nhật ký
                        </div>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>

<div class="profile-header">
    <div class="profile-header-cover">
        @if ($user->status == 'active' && $user->id != $user_info->id)
            <button class="btn btn-danger update-status absolute" data-status="blocked" data-id="{{ $user->id }}">
                <i class="fas fa-lock"></i> Khóa
            </button>
        @endif
        @if ($user->status != 'active' && $user->id != $user_info->id)
            <button class="btn btn-success update-status absolute" data-status="active" data-id="{{ $user->id }}">
                <i class="fas fa-check"></i> Kích hoạt
            </button>
        @endif
    </div>
    <div class="profile-header-content" style="padding: 0 25px">
        <div class="profile-header-img hide-mobile">
            <img class="h-100" class="preview"
                src="{{ $user->avatar ? get_url($user->avatar) : asset('user/img/user/no-avatar.jpg') }}"
                alt="user">
        </div>
        <ul class="profile-header-tab nav nav-tabs nav-tabs-v2 ms-50px">
            <li class="nav-item">
                <a href="{{ route('user.user.detail', ['id' => $user->id]) }}?tab=info"
                    class="nav-link {{ $tab == 'info' ? 'active' : '' }}">
                    <div class="nav-field text-uppercase">
                        <i class="fas fa-info-circle"></i> Cá nhân
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.user.detail', ['id' => $user->id]) }}?tab=account"
                    class="nav-link {{ $tab == 'account' ? 'active' : '' }}">
                    <div class="nav-field text-uppercase">
                        <i class="far fa-user"></i> Tài khoản
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.user.detail', ['id' => $user->id]) }}?tab=history"
                    class="nav-link {{ $tab == 'history' ? 'active' : '' }}">
                    <div class="nav-field text-uppercase">
                        <i class="fas fa-undo"></i> Nhật ký
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>

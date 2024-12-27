@php
    use App\Models\User;
    $status = User::get_status($user->status);
@endphp
<div class="profile-sidebar w-250px">
    <div class="desktop-sticky-top">
        <div class="text-center">
            <h4>{{ $user->name }}</h4>
            <div class="fw-500 mb-3 text-muted mt-n2">{{ $user->code }}</div>
        </div>
        <div class="mb-1 d-flex justify-content-between">
            <div>
                <i class="fas fa-mobile-alt fa-fw text-muted"></i>
                <span class="show-data">{{ $user->phone }}</span>
            </div>
        </div>
        <div class="mb-3 d-flex justify-content-between">
            <div>
                <i class="fas fa-envelope-open-text fa-fw text-muted"></i>
                <span class="show-data">{{ $user->email }}</span>
            </div>
        </div>
        <hr class="mt-4 mb-4">
        <div class="d-flex align-items-center mb-3 justify-content-between">
            Ngày tạo <span
                class="text-success">{{ $user->created_at ? date('d/m/Y', strtotime($user->created_at)) : '-' }}</span>
        </div>
        <div class="d-flex align-items-center mb-3 justify-content-between">
            Cập nhật lần cuối <span>{{ $user->updated_at ? date('d/m/Y', strtotime($user->updated_at)) : '-' }}</span>
        </div>
        <div class="d-flex align-items-center mb-3 justify-content-between">
            Đăng nhập lần cuối
            <span>{{ $user->last_login ? date('H:i d/m/Y', strtotime($user->last_login)) : '-' }}</span>
        </div>
        <div class="d-flex align-items-center mb-3 justify-content-between">
            Trạng thái
            <span
                class="badge bg-{{ $status[1] }} text-{{ $status[1] }} bg-opacity-15 px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                <i class="fa fa-circle text-{{ $status[1] }} fs-9px fa-fw me-5px"></i> {{ $status[0] }}
            </span>
        </div>
    </div>
    @if ($user->status == 'blocked')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Quản trị viên này đã bị khóa, không thể đăng nhập vào hệ thống
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

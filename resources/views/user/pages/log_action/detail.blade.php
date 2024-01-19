@extends('user.default')
@section('title', 'Chi tiết nhật ký')
@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h5>Chi tiết nhật ký: #{{ $log_action->id }}</h5>
        <div class="btn-group" role="group">
            <a href="{{ route('user.log_action.index') }}"
                class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-primary">
                <i class="fas fa-list-ul"></i> Danh sách
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Mã:
                    <span>#{{ $log_action->id }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Quản trị viên:
                    <span>
                        @if ($log_action->user)
                            <a class="text-decoration-none"
                                href="{{ route('user.user.detail', ['id' => $log_action->user_id]) }}">
                                {{ $log_action->user->name }}
                            </a>
                        @else
                            -
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - IP address:
                    <span>{{ $log_action->ip }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Thiết bị:
                    <span class="text-end" style="max-width: 80%">{{ $log_action->device }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Thời gian:
                    <span>{{ $log_action->created_at ? date('H:i:s d/m/Y', $log_action->created_at) : '-' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Nội dung:
                    <span class="text-end" style="max-width: 80%">{!! $log_action->content !!}</span>
                </li>
            </ul>
        </div>
    </div>
@endsection

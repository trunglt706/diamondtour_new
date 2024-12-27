@php
    use App\Models\Newllter;
    $status = Newllter::get_status($data->status);
    $device = $data->device ? json_decode($data->device) : null;
@endphp
@extends('user.default')
@section('title', 'Chi tiết newllter')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Chi tiết newllter: #{{ $data->code }}</h5>
        <div class="btn-group" role="group">
            <a href="{{ route('user.newllter.index') }}"
                class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            @if ($data->status != 'active')
                <a href="{{ route('user.newllter.accept') }}?id={{ $data->id }}" class="btn btn-accept btn-success">
                    <i class="fas fa-check"></i> Duyệt
                </a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Mã:
                    <span>#{{ $data->code }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Email:
                    <span>{{ $data->email }}</span>
                </li>
                @if ($device)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        - Địa chỉ IP:
                        <span class="text-end" style="max-width: 80%">{{ $device->ip }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        - Thiết bị:
                        <span class="text-end" style="max-width: 80%">{{ $device->device }}</span>
                    </li>
                @endif
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Thời gian:
                    <span>
                        {{ $data->created_at ? date('H:i:s d/m/Y', strtotime($data->created_at)) : '-' }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Trạng thái:
                    <span
                        class="badge bg-{{ $status[1] }} text-{{ $status[1] }} bg-opacity-15 px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                        <i class="fa fa-circle text-{{ $status[1] }} fs-9px fa-fw me-5px"></i> {{ $status[0] }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <div class="alert alert-info mt-3" role="alert">
        Sử dụng chức năng "Duyệt" để xác nhận thông tin đăng ký này!
    </div>
@endsection
@push('js')
    <script>
        $('.btn-accept').click(function() {
            if (confirm('Xác nhận thực hiện chức năng này?')) {
                return true;
            }
            return false;
        })
    </script>
@endpush

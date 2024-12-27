@extends('user.default')
@section('title', 'Chi tiết thiết kế tour')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="hide-mobile">Chi tiết thiết kế tour: #{{ $data->id }}</h6>
        <div class="btn-group" role="group">
            <a href="{{ route('user.tour_design.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Mã:
                    <span>{{ $data->code }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Họ tên:
                    <span>{{ $data->name }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Điện thoại:
                    <span>{{ $data->phone }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Email:
                    <span>{{ $data->email }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Quốc gia:
                    <span>{{ $data->country ? $data->country->name : '' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Đi cùng với:
                    <span>{{ $data->object ? $data->object->name : '' }} {{ $data->someone_other }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Người lớn:
                    <span>{{ $data->adults }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Trẻ em:
                    <span>{{ $data->children }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Nơi xuất phát:
                    <span>{{ $data->province ? $data->province->name : '' }} {{ $data->place_start_other }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Cần HDV đi cùng không:
                    <span>{{ $data->tour_guide ? 'Cần' : 'Không' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Thời gian tạo:
                    <span>
                        {{ $data->created_at ? date('H:i:s d/m/Y', $data->created_at) : '-' }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Cập nhật lần cuối:
                    <span>
                        {{ $data->updated_at ? date('H:i:s d/m/Y', $data->updated_at) : '-' }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
@endsection

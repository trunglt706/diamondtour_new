@php
    use App\Models\DestinationGroup;
    $status = DestinationGroup::get_status($data->status);
@endphp
@extends('user.default')
@section('title', 'Chi tiết danh mục điểm đến')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="hide-mobile">Danh mục điểm đến: #{{ $data->code }}</h6>
        <div class="btn-group" role="group">
            <a href="{{ route('user.destination_group.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-edit"></i> Cập nhật
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 d-flex">
            <ul class="list-group w-100 me-3">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Mã:
                    <span>{{ $data->code }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Tên:
                    <span>{{ $data->name }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Thứ tự:
                    <span>{{ $data->numering }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Trạng thái:
                    <span
                        class="badge bg-{{ $status[1] }} text-{{ $status[1] }} bg-opacity-15 px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                        <i class="fa fa-circle text-{{ $status[1] }} fs-9px fa-fw me-5px"></i> {{ $status[0] }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Thời gian tạo:
                    <span>
                        {{ $data->created_at ? date('H:i:s d/m/Y', strtotime($data->created_at)) : '-' }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Cập nhật lần cuối:
                    <span>
                        {{ $data->updated_at ? date('H:i:s d/m/Y', strtotime($data->updated_at)) : '-' }}
                    </span>
                </li>
                <li class="list-group-item">
                    <u>- Mô tả:</u>
                    <div>{!! $data->description !!}</div>
                </li>
            </ul>
            <img src="{{ $data->image ? get_url($data->image) : asset('user/img/user/no-avatar.jpg') }}"
                class="img-thumbnail preview w-80px h-70px hide-mobile" alt="img">
        </div>
    </div>
    <h3 class="mt-2">Lưu ý</h3>
    <div class="alert alert-info" role="alert">
        <ul>
            <li>
                Số thứ tự thể hiện độ ưu tiên của dữ liệu
            </li>
            <li>
                Số thứ tự càng cao, độ ưu tiên càng cao
            </li>
        </ul>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('user.destination_group.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Cập nhật thông tin</h1>
                        <span>
                            <small class="pe-2">
                                Các trường có dấu <span class="text-danger fw-900">*</span></label> là bắt buộc
                            </small>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </span>
                    </div>
                    <div class="modal-body px-4 py-1 content-update">
                        @include('user.pages.destination.group.show')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-long-arrow-alt-left"></i> Thoát
                        </button>
                        <button type="submit" class="btn bg-gradient-cyan-blue btn-create text-white">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
@endpush

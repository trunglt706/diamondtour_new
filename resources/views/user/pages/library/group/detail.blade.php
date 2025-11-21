@extends('user.default')
@section('title', 'Chi tiết danh mục thư viện')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="hide-mobile">Danh mục thư viện: #{{ $data->id }}</h6>
        <div class="btn-group" role="group">
            <a href="{{ route('user.library_group.index') }}" class="btn btn-secondary">
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
                    <span>#{{ $data->id }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Tên:
                    <span>{{ $data->name }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Độ ưu tiên:
                    <span>{{ number_format($data->libraries_count) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - SL ảnh:
                    <span>
                        @if ($data->important)
                            <i class="far fa-star text-warning"></i>
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Theo mùa:
                    <span>
                        @if ($data->season)
                            @php
                                $season = LibraryGroup::get_season($data->season);
                            @endphp
                            {{ $season[0] }}
                        @else
                            -
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Trạng thái:
                    <span
                        class="badge bg-{{ $status[1] }} text-{{ $status[1] }} bg-opacity-15 px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                        <i class="fa fa-circle text-{{ $status[1] }} fs-9px fa-fw me-5px"></i> {{ $status[0] }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Album của khách:
                    <span>{{ $data->guest ? 'Đúng' : 'Không đúng' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Album hot:
                    <span>{{ $data->hot ? 'Đúng' : 'Không đúng' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Thời gian:
                    <span>{{ $data->date }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Địa điểm:
                    <span>{{ $data->address }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Mô tả:
                    <span>{!! $data->description !!}</span>
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
            </ul>
            <div class="hide-mobile">
                <img src="{{ $data->image ? get_url($data->image) : asset('user/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail preview w-100px" alt="img">
                <hr>
                <img src="{{ $data->background ? get_url($data->background) : asset('user/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail w-100px" alt="img">
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('user.library_group.update') }}" method="POST" enctype="multipart/form-data">
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
                        @include('user.pages.library.group.show')
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

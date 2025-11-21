@extends('user.default')
@section('title', 'Chi tiết menu')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="hide-mobile">Menu: #{{ $data->name }}</h6>
        <div class="btn-group" role="group">
            <a href="{{ route('user.menu.index') }}" class="btn btn-secondary">
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
                    - Đường dẫn:
                    <a class="text-decoration-none" href="{{ $data->link }}" target="_blank">
                        {{ $data->link }}
                    </a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Icon:
                    <span>{!! $data->icon !!}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Mô tả:
                    <span>{{ $data->description }}</span>
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
            <div class="d-flex flex-column hide-mobile">
                <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $data->background ? get_file($data->background) : asset('assets/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail preview w-100px" loading="lazy" alt="img">
                <hr>
                @php
                    $images = $data->images ? json_decode($data->images) : [];
                @endphp
                @foreach ($images as $item)
                    <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $item ? get_file($item) : asset('assets/img/user/no-avatar.jpg') }}"
                        class="img-thumbnail preview w-100px" loading="lazy" alt="img">
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('user.menu.update') }}" method="POST" enctype="multipart/form-data">
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
                        @include('user.pages.setting.menu.show')
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

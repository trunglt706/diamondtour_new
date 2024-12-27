@extends('user.default')
@section('title', 'Cập nhật thông tin bài tham dự')
@section('content')
    <div id="editModal">
        <form id="form-update" action="{{ route('user.event_submission.update') }}" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $data->id }}">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="hide-mobile">Bài tham dự: #{{ $data->id }}</h6>
                    <div class="btn-group" role="group">
                        <a type="button" href="{{ route('user.event_submission.detail', ['id' => $data->id]) }}"
                            class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary btn-create">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">
                                <i class="fas fa-info-circle"></i> Cơ bản
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">
                                <i class="fas fa-file-alt"></i> Nội dung
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-1">
                                        <label class="col-form-label">Người tham dự <span
                                                class="text-danger fw-900">*</span></label>
                                        <input type="text" class="form-control" value="{{ $data->name }}"
                                            name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-1">
                                        <label class="col-form-label">Chức vụ <span
                                                class="text-danger fw-900">*</span></label>
                                        <input type="text" class="form-control" value="{{ $data->position }}"
                                            name="position">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            Ảnh đại diện
                                            <small class="form-text fst-italic">
                                                (Kích thước gợi ý: 200 x 200px)
                                            </small>
                                        </label>
                                        <input type="file" class="form-control previewImg" name="image"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <div class="form-group mb-1">
                                        <label class="col-form-label">Liên kết</label>
                                        <input type="text" class="form-control" value="{{ $data->link }}"
                                            name="link">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <label class="col-form-label">Trạng thái</label>
                                    <div>
                                        @foreach ($other['status'] as $key => $item)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    {{ $key == $data->status ? 'checked' : '' }}
                                                    id="inlineRadio{{ $key }}" value="{{ $key }}">
                                                <label class="form-check-label" for="inlineRadio{{ $key }}">
                                                    {{ $item[0] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Mô tả ngắn *</label>
                                <textarea name="description" rows="3" class="form-control">{{ $data->description }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">
                            <div class="form-group mb-1">
                                <label class="col-form-label">Nội dung <span class="text-danger fw-900">*</span></label>
                                <textarea name="content" id="ckeditor" rows="3" class="form-control">{{ $data->content }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        var noReload = 'true';
        $(document).ready(function() {
            CKEDITOR.replace('ckeditor', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });

            $(document).on('click', 'button[type="submit"]', function() {
                for (var instanceName in CKEDITOR.instances) {
                    CKEDITOR.instances[instanceName].updateElement();
                }
            })
        })
    </script>
@endpush

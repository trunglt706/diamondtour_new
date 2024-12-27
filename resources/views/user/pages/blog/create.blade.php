@extends('user.default')
@section('title', 'Tạo mới blog')
@push('css')
    <link href="{{ asset('user/plugins/tag-it/css/jquery.tagit.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div id="addModal">
        <form id="form-create" action="{{ route('user.blog.insert') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="hide-mobile">Tạo mới blog</h6>
                    <div class="btn-group" role="group">
                        <a type="button" href="{{ route('user.blog.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary btn-create">
                            <i class="fas fa-plus"></i> Lưu
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
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-tab-pane"
                                type="button" role="tab" aria-controls="en-tab-pane" aria-selected="false">
                                Tiếng Anh
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ch-tab" data-bs-toggle="tab" data-bs-target="#ch-tab-pane"
                                type="button" role="tab" aria-controls="ch-tab-pane" aria-selected="false">
                                Tiếng Trung
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="col-form-label">Tiêu đề <span class="text-danger fw-900">*</span></label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="col-form-label">Danh mục <span
                                                class="text-danger fw-900">*</span></label>
                                        <a href="{{ route('user.blog_group.index') }}" target="_blank" class="add-new"
                                            data-bs-toggle="tooltip" title="Tạo mới">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                    <select name="group_id" class="form-select filter-group_id">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            Ảnh đại diện
                                            <small class="form-text fst-italic">
                                                (Kích thước gợi ý: 401 x 282px)
                                            </small>
                                        </label>
                                        <input type="file" class="form-control previewImg" name="image"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            Ảnh background
                                            <small class="form-text fst-italic">
                                                (Kích thước gợi ý: 1579 x 407 px)
                                            </small>
                                        </label>
                                        <input type="file" class="form-control" name="background" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            Album ảnh
                                            <small class="form-text fst-italic">
                                                (Chọn 6 tấm hình)
                                            </small>
                                        </label>
                                        <input type="file" class="form-control" min="6" max="6"
                                            multiple name="album[]" class="album" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Danh sách tour liên quan</label>
                                <select name="tours[]" class="form-select filter-tours" multiple>

                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="col-form-label">Trạng thái</label>
                                    <div>
                                        @foreach ($data['status'] as $key => $item)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    {{ $key == 'draft' ? 'checked' : '' }}
                                                    id="inlineRadio{{ $key }}" value="{{ $key }}">
                                                <label class="form-check-label" for="inlineRadio{{ $key }}">
                                                    {{ $item[0] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-1 form-group">
                                        <label class="col-form-label">
                                            Thứ tự ưu tiên
                                            <small>(Thứ tự càng cao độ ưu tiên càng cao)</small>
                                        </label>
                                        <input type="number" placeholder="Thứ tự" class="form-control" value="0"
                                            name="important">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="col-form-label">
                                    Thẻ tag
                                    <small class="fst-italic">(Nhấn Enter hoặc Tab để hoàn tất 1 thẻ tag)</small>
                                </label>
                                <input type="text" class="form-control tags" name="tags">
                            </div>
                            <div class="my-3 d-flex justify-content-between">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="hot" value="1" type="checkbox"
                                        role="switch" id="switch_hot">
                                    <label class="form-check-label" for="switch_hot">
                                        Đề tài nóng
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="like_total" value="1" type="checkbox"
                                        role="switch" id="switch_like_total">
                                    <label class="form-check-label" for="switch_like_total">
                                        Bài viết yêu thích
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="tieu_diem" value="1" type="checkbox"
                                        role="switch" id="switch_tieu_diem">
                                    <label class="form-check-label" for="switch_tieu_diem">
                                        Tiêu điểm trong tuần
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">
                            <div class="form-group mb-1">
                                <label class="col-form-label">Mô tả ngắn</label>
                                <textarea name="description" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Nội dung <span class="text-danger fw-900">*</span></label>
                                <textarea name="content" id="ckeditor" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="en-tab-pane" role="tabpanel" aria-labelledby="en-tab"
                            tabindex="0">
                            <div class="col-md-12 mb-1">
                                <label class="col-form-label">Tiêu đề</label>
                                <input type="text" class="form-control" name="name_en">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ch-tab-pane" role="tabpanel" aria-labelledby="ch-tab"
                            tabindex="0">
                            <div class="col-md-12 mb-1">
                                <label class="col-form-label">Tiêu đề</label>
                                <input type="text" class="form-control" name="name_ch">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-3">
        <h4>Lưu ý</h4>
        <div class="alert alert-danger" role="alert">
            Blog ở trạng thái "Đang kích hoạt" mới được hiển thị ở trang ngoài.
        </div>
    </div>
    @include('user.pages.hd')
@endsection
@push('js')
    <script src="{{ asset('user/plugins/tag-it/js/tag-it.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        initSelect2('.filter-group_id', "-- Danh mục --", 'post_groups');
        initSelect2('.filter-tours', "-- Chọn tour --", 'tours');

        $(document).ready(function() {
            $(".tags").tagit({
                allowSpaces: true
            });

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

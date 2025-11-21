@extends('user.default')
@section('title', 'Cập nhật thông tin tour')
@push('css')
    <link href="{{ asset('user/plugins/tag-it/css/jquery.tagit.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="mb-3">
        Xem bà viết công khai tại
        <a target="_blank" href="{{ route('tour.detail', ['slug' => $data->slug]) }}" class="text-decoration-none">
            tại đây
        </a>
    </div>
    <div id="editModal">
        <form id="form-update" action="{{ route('user.tour.update') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $data->id }}">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="hide-mobile">Tour: #{{ $data->name }}</h6>
                    <div class="btn-group" role="group">
                        <a type="button" href="{{ route('user.tour.detail', ['id' => $data->id]) }}"
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
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                data-bs-target="#contact-tab-pane" type="button" role="tab"
                                aria-controls="contact-tab-pane" aria-selected="false">
                                <i class="fas fa-cog"></i> Khác
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
                                    <input type="text" class="form-control" value="{{ $data->name }}" name="name">
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="col-form-label">Danh mục chính <span
                                                class="text-danger fw-900">*</span></label>
                                        <a href="{{ route('user.destination_group.index') }}" target="_blank"
                                            class="add-new" data-bs-toggle="tooltip" title="Tạo mới">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                    <select name="group_id" class="form-select filter-group_id">
                                        @if ($data->group)
                                            <option value="{{ $data->group_id }}">{{ $data->group->name }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="col-form-label">Quốc gia <span
                                            class="text-danger fw-900">*</span></label>
                                    <select name="country_id" class="form-select filter-country_id">
                                        @if ($data->withCountry)
                                            <option value="{{ $data->country_id }}">{{ $data->withCountry->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-3 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            Ảnh đại diện
                                            <small class="form-text fst-italic">
                                                (Kích thước gợi ý: 405 x 320px)
                                            </small>
                                        </label>
                                        <input type="file" class="form-control" multiple name="image"
                                            class="images" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-3 mb-1">
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
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-1">
                                    <label class="col-form-label">Đơn giá</label>
                                    <input type="number" class="form-control" placeholder="VD: 2000000"
                                        value="{{ $data->price }}" name="price" min="0">
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label class="col-form-label">Thời gian</label>
                                    <input type="text" class="form-control" name="duration"
                                        value="{{ $data->duration }}" placeholder="VD: 2N1Đ">
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label class="col-form-label">Bắt đầu</label>
                                    <input type="date" class="form-control" value="{{ $data->from }}"
                                        name="from">
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label class="col-form-label">Kết thúc</label>
                                    <input type="date" class="form-control" value="{{ $data->to }}"
                                        name="to">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="col-form-label">Trạng thái</label>
                                    <div>
                                        @foreach ($other['status'] as $key => $item)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    {{ $data->status == $key ? 'checked' : '' }}
                                                    id="inlineRadio{{ $key }}" value="{{ $key }}">
                                                <label class="form-check-label" for="inlineRadio{{ $key }}">
                                                    {{ $item[0] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="col-form-label">Loại tour</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type"
                                                {{ $data->type == 0 ? 'checked' : '' }} id="typeinlineRadio0"
                                                value="0">
                                            <label class="form-check-label" for="typeinlineRadio0">
                                                Tour
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type"
                                                {{ $data->type == 1 ? 'checked' : '' }} id="typeinlineRadio1"
                                                value="1">
                                            <label class="form-check-label" for="typeinlineRadio1">
                                                LandTour
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="col-form-label">Tour thiết kế</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="design"
                                                {{ $data->design == 0 ? 'checked' : '' }} id="designinlineRadio0"
                                                value="0">
                                            <label class="form-check-label" for="designinlineRadio0">
                                                Không Đúng
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="design"
                                                {{ $data->design == 1 ? 'checked' : '' }} id="designinlineRadio1"
                                                value="1">
                                            <label class="form-check-label" for="designinlineRadio1">
                                                Đúng
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="col-form-label">Thuộc bundle</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bundle"
                                                {{ $data->bundle == 1 ? 'checked' : '' }} id="bundleinlineRadio1"
                                                value="1">
                                            <label class="form-check-label" for="bundleinlineRadio1">
                                                Bundle 1
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bundle"
                                                {{ $data->bundle == 2 ? 'checked' : '' }} id="bundleinlineRadio2"
                                                value="2">
                                            <label class="form-check-label" for="bundleinlineRadio2">
                                                Bundle 2
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bundle"
                                                {{ $data->bundle == 3 ? 'checked' : '' }} id="bundleinlineRadio3"
                                                value="3">
                                            <label class="form-check-label" for="bundleinlineRadio3">
                                                Bundle 3
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group mb-1">
                                    <label class="col-form-label">
                                        Thẻ tag
                                        <small class="fst-italic">(Nhấn Enter hoặc Tab để hoàn tất 1 thẻ tag)</small>
                                    </label>
                                    <input type="text"
                                        value="{{ $data->tags ? implode(',', json_decode($data->tags)) : '' }}"
                                        class="form-control tags" name="tags">
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="col-form-label">
                                        Hoạt động chính
                                        <small class="fst-italic">(Để tìm tour theo hoạt động)</small>
                                    </label>
                                    <input type="text" class="form-control" value="{{ $data->activity }}"
                                        name="activity">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            Thứ tự ưu tiên
                                            <small>(Thứ tự càng cao độ ưu tiên càng cao)</small>
                                        </label>
                                        <input type="number" placeholder="Thứ tự" class="form-control"
                                            value="{{ $data->important }}" name="important">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="col-form-label">Danh mục khác</label>
                                    <select name="group_ids[]" multiple class="form-select filter-group_ids">
                                        @if ($data->groups)
                                            @foreach ($data->groups as $gr)
                                                <option value="{{ $gr->group->id }}" selected>{{ $gr->group->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            Theo mùa
                                        </label>
                                        <select name="season" class="form-select select-picker">
                                            <option value="" selected>-- Chọn --</option>
                                            @foreach ($other['seasons'] as $key => $item)
                                                <option value="{{ $key }}"
                                                    {{ $key == $data->season ? 'selected' : '' }}>{{ $item[0] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">Số khách</label>
                                        <input type="text" class="form-control" value="{{ $data->guest }}"
                                            name="guest" placeholder="VD: Tối thiểu 2">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">Ngôn ngữ</label>
                                        <input type="text" class="form-control" value="{{ $data->language }}"
                                            name="language" placeholder="VD: Tiếng Việt, Tiếng Anh">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">
                            <div class="form-group mb-1">
                                <label class="col-form-label">Mô tả ngắn</label>
                                <textarea name="description" id="description" rows="3" class="form-control">{{ $data->description }}</textarea>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Nội dung <span class="text-danger fw-900">*</span></label>
                                <textarea name="content" id="ckeditor" rows="3" class="form-control">{{ $data->content }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                            tabindex="0">
                            <div class="form-group mb-1">
                                <label class="col-form-label">
                                    Hình ảnh thông tin chuyến đi
                                    <small class="form-text fst-italic">
                                        (Kích thước gợi ý: 550 x 398px)
                                    </small>
                                </label>
                                <input type="file" class="form-control" name="location_img" class="image"
                                    accept="image/*">
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Nội dung thông tin chuyến đi</label>
                                <textarea name="location_description" rows="3" class="form-control" id="location_description">{{ $data->location_description }}</textarea>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Bao gồm</label>
                                <textarea name="include" rows="3" class="form-control" id="include">{{ $data->include }}</textarea>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Không bao gồm</label>
                                <textarea name="exclude" rows="3" class="form-control" id="exclude">{{ $data->exclude }}</textarea>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Quy định</label>
                                <textarea name="term" rows="3" class="form-control" id="term">{{ $data->term }}</textarea>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Lưu ý</label>
                                <textarea name="notice" rows="3" class="form-control" id="notice">{{ $data->notice }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="en-tab-pane" role="tabpanel" aria-labelledby="en-tab"
                            tabindex="0">
                            <div class="col-md-12 mb-1">
                                <label class="col-form-label">Tiêu đề</label>
                                <input type="text" class="form-control" value="{{ $data->name_en }}" name="name_en">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ch-tab-pane" role="tabpanel" aria-labelledby="ch-tab"
                            tabindex="0">
                            <div class="col-md-12 mb-1">
                                <label class="col-form-label">Tiêu đề</label>
                                <input type="text" class="form-control" value="{{ $data->name_ch }}" name="name_ch">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('user.pages.tour.note')
    @include('user.pages.hd')
@endsection
@push('js')
    <script src="{{ asset('user/plugins/tag-it/js/tag-it.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        var noReload = 'true';
        initSelect2('.filter-group_id', "-- Chọn --", 'tour_groups');
        initSelect2('.filter-group_ids', "-- Chọn --", 'tour_groups');
        initSelect2('.filter-country_id', "-- Quốc gia --", 'countries');

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

            CKEDITOR.replace('include', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });

            CKEDITOR.replace('exclude', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });

            CKEDITOR.replace('notice', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });

            CKEDITOR.replace('term', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });

            CKEDITOR.replace('location_description', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });

            CKEDITOR.replace('description', {
                height: 280,
                toolbar: [{
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline', 'Strike']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                            'Blockquote'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'insert',
                        items: ['Image', 'Table', 'HorizontalRule']
                    },
                    {
                        name: 'document',
                        items: ['Source']
                    }
                ],
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

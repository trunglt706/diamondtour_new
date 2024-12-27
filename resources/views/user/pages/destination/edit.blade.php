@extends('user.default')
@section('title', 'Cập nhật thông tin điểm đến')
@push('css')
    <link href="{{ asset('user/plugins/tag-it/css/jquery.tagit.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="mb-3">
        Xem bà viết công khai tại
        <a target="_blank" href="{{ route('demo.destination.detail', ['slug' => $data->slug]) }}" class="text-decoration-none">
            tại đây
        </a>
    </div>
    <div id="editModal">
        <form id="form-update" action="{{ route('user.destination.update') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $data->id }}">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="hide-mobile">Cập nhật điểm đến #{{ $data->name }}</h6>
                    <div class="btn-group" role="group">
                        <a type="button" href="{{ route('user.destination.detail', ['id' => $data->id]) }}"
                            class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary btn-create">
                            <i class="fas fa-save"></i> Lưu thay đổi
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
                                    <input type="text" class="form-control" value="{{ $data->name }}"
                                        placeholder="Nhập tiêu đề" name="name">
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="col-form-label">Danh mục điểm đến <span
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
                                <div class="col-md-6 mb-1 div_country_id"
                                    style="display: {{ $data->type == 'national' ? 'blocked' : 'none' }};">
                                    <label class="col-form-label">Quốc gia <span
                                            class="text-danger fw-900">*</span></label>
                                    <select name="country_id" class="form-select filter-country_id">
                                        @if ($data->country)
                                            <option value="{{ $data->country_id }}">{{ $data->country->name }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 mb-1 div_province_id"
                                    style="display: {{ $data->type != 'national' ? 'blocked' : 'none' }};">
                                    <label class="col-form-label">Khu vực <span
                                            class="text-danger fw-900">*</span></label>
                                    <select name="province_id" class="form-select filter-province_id">
                                        @if ($data->province)
                                            <option value="{{ $data->province_id }}">{{ $data->province->name }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label class="col-form-label">Phân loại</label>
                                    <div>
                                        @foreach ($other['type'] as $key => $item)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input type" type="radio" name="type"
                                                    {{ $key == $data->type ? 'checked' : '' }}
                                                    id="inlineRadio{{ $key }}" value="{{ $key }}">
                                                <label class="form-check-label" for="inlineRadio{{ $key }}">
                                                    {{ $item[0] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label class="col-form-label">Đơn giá (VNĐ)</label>
                                    <input type="number" class="form-control" name="price" placeholder="VD: 2000000"
                                        min="0" value="{{ $data->price }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mb-1">
                                    <label class="col-form-label">
                                        Thẻ tag
                                        <small class="fst-italic">(Nhấn Enter hoặc Tab để hoàn tất 1 thẻ tag)</small>
                                    </label>
                                    <input type="text"
                                        value="{{ $data->tags ? implode(',', json_decode($data->tags)) : '' }}"
                                        class="form-control tags" name="tags">
                                </div>
                                <div class="col-md-6 form-group mb-1">
                                    <label class="col-form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" value="{{ $data->address }}"
                                        name="address" placeholder="VD: Hà Nội">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-1">
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
                                <div class="col-md-3 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            Ảnh đại diện
                                            <small class="form-text fst-italic size-text">
                                                (Kích thước gợi ý:
                                                {{ $data->type == 'national' ? '412 x 250px' : '283 x 400px' }})
                                            </small>
                                        </label>
                                        <input type="file" class="form-control" multiple name="image"
                                            accept="image/*">
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
                                <div class="col-md-6">
                                    <div class="form-group  mb-1">
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
                                <div class="col-md-6 mb-1 div_tour_group"
                                    style="display: {{ $data->type == 'national' ? 'blocked' : 'none' }};">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="col-form-label">Danh mục tour <span
                                                class="text-danger fw-900">*</span></label>
                                        <a href="{{ route('user.tour_group.index') }}" target="_blank" class="add-new"
                                            data-bs-toggle="tooltip" title="Tạo mới">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                    <select name="tour_group_ids[]" class="form-select filter-tour_group_ids" multiple>
                                        @foreach ($other['tour_groups'] as $item)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Danh sách tour liên quan</label>
                                <select name="tours[]" class="form-select filter-tours" multiple>
                                    @foreach ($other['tours'] as $item)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-1 form-group">
                                <label class="col-form-label">
                                    Thứ tự ưu tiên
                                    <small>(Thứ tự càng cao độ ưu tiên càng cao)</small>
                                </label>
                                <input type="number" placeholder="Thứ tự" class="form-control"
                                    value="{{ $data->important }}" name="important">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">
                            <div class="form-group mb-1">
                                <label class="col-form-label">Mô tả điểm đến <span
                                        class="text-danger fw-900">*</span></label>
                                <textarea name="description" id="description" rows="3" class="form-control">{{ $data->description }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            Hình ảnh mô tả điểm đến
                                            <small class="form-text fst-italic size-text">
                                                (Kích thước gợi ý:)
                                            </small>
                                        </label>
                                        <input type="file" class="form-control" name="image_description"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            Hình ảnh mô tả địa chỉ
                                            <small class="form-text fst-italic size-text">
                                                (Kích thước gợi ý:)
                                            </small>
                                        </label>
                                        <input type="file" class="form-control" name="image_content"
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Mô tả địa chỉ <span
                                        class="text-danger fw-900">*</span></label>
                                <textarea name="content" id="ckeditor" rows="3" class="form-control">{{ $data->content }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                            tabindex="0">
                            <div class="form-group mb-1">
                                <label class="col-form-label">Tiện ích cơ bản</label>
                                <textarea name="tien_ich" rows="3" class="form-control" id="tien_ich">{{ $data->tien_ich }}</textarea>
                            </div>
                            <div class="form-group mb-1">
                                @php
                                    $plan = $data->plan ? json_decode($data->plan) : null;
                                @endphp
                                <label class="col-form-label">Kế hoạch du lịch và chi phí tham khảo</label>
                                <textarea name="plan" rows="3" class="form-control" id="plan">{{ $plan->content ?? '' }}</textarea>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label">Mọi người nói gì về chúng tôi</label>
                                <textarea name="talk" rows="3" class="form-control" id="talk">{{ $data->talk }}</textarea>
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
    <div class="mt-3">
        <h4>Lưu ý</h4>
        <div class="alert alert-danger" role="alert">
            Điểm đến ở trạng thái "Đang kích hoạt" mới được hiển thị ở trang ngoài.
        </div>
    </div>
    @include('user.pages.hd')
@endsection
@push('js')
    <script src="{{ asset('user/plugins/tag-it/js/tag-it.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        var noReload = 'true';
        initSelect2('.filter-tour_group_ids', "-- Chọn danh mục tour --", 'tour_groups');
        initSelect2('.filter-group_id', "-- Chọn --", 'destination_groups');
        initSelect2('.filter-country_id', "-- Chọn --", 'countries');
        initSelect2('.filter-tours', "-- Chọn tour --", 'tours');
        initSelect2('.filter-province_id', "-- Chọn --", 'provinces', '', {}, ["id",
            "name_with_type as name"
        ]);

        $(document).ready(function() {
            $(".tags").tagit({
                allowSpaces: true
            });



            CKEDITOR.replace('description', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });

            CKEDITOR.replace('ckeditor', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });

            CKEDITOR.replace('plan', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });

            CKEDITOR.replace('talk', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });

            CKEDITOR.replace('tien_ich', {
                height: 280,
                toolbar: [{
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline', 'Strike']
                    },
                    {
                        name: 'paragraph',
                        items: ['BulletedList']
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

            $(document).on('change', '.type', function() {
                const value = $('.type:checked').val();
                if (value == 'national') {
                    $('.size-text').text('(Kích thước gợi ý: 412 x 250px)');
                    $('.div_country_id').show();
                    $('.div_province_id').hide();
                    $('.div_tour_group').show();
                } else {
                    $('.size-text').text('(Kích thước gợi ý: 283 x 400px)');
                    $('.div_country_id').hide();
                    $('.div_province_id').show();
                    $('.div_tour_group').hide();
                }
            })
        })
    </script>
@endpush

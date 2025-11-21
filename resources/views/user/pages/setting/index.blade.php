@php
    use App\Models\Setting;
    $group = $data['group'];
    $lang = isset($_GET['lang']) && $_GET['lang'] != '' ? $_GET['lang'] : '';
    $type = isset($_GET['type']) ? $_GET['type'] : 'seo';
    $value = $lang == '' || $lang == 'vi' ? 'value' : 'value_' . $lang;
@endphp
@extends('user.default')
@section('title', 'Cài đặt')
@section('content')
    <style>
        .image-setting {
            width: 65px !important;
            height: 65px !important;
        }

        .btn-delete-image {
            z-index: 2;
        }
    </style>
    <div class="d-flex justify-content-between mb-1">
        <h5>Cài đặt hệ thống</h5>
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <a href="{{ route('user.setting.index') }}/?type={{ $type }}&lang=" type="button"
                class="btn btn-outline-primary {{ $lang == '' ? 'active' : '' }}">VN</a>
            <a href="{{ route('user.setting.index') }}/?type={{ $type }}&lang=en" type="button"
                class="btn btn-outline-primary {{ $lang == 'en' ? 'active' : '' }}">EN</a>
            <a href="{{ route('user.setting.index') }}/?type={{ $type }}&lang=ch" type="button"
                class="btn btn-outline-primary {{ $lang == 'ch' ? 'active' : '' }}">CH</a>
        </div>
    </div>
    <div>
        <div class="setting">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($data['groups'] as $item)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary {{ $group->id == $item->id ? 'active' : '' }}"
                            href="{{ route('user.setting.index') . '?type=' . $item->code . '&lang=' . $lang }}">
                            {!! $item->icon !!}&nbsp; {{ $item->name }}
                        </a>
                    </li>
                @endforeach
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary {{ Request::is('social*') ? 'active' : '' }}"
                        href="{{ route('user.social.index') }}">
                        <i class="fas fa-share-alt"></i> Mạng xã hội
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary {{ Request::is('qa*') ? 'active' : '' }}"
                        href="{{ route('user.qa.index') }}">
                        <i class="fas fa-question-circle"></i> Câu hỏi thường gặp
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary {{ Request::is('menu*') ? 'active' : '' }}"
                        href="{{ route('user.menu.index') }}">
                        <i class="fas fa-bars"></i> Menu
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <form action="{{ route('user.setting.update') }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card mt-2 card-main">
                            <div class="card-body data-content">
                                <input type="hidden" name="type" value={{ $group->code }}>
                                <input type="hidden" name="lang" value={{ $lang }}>
                                @foreach ($group->settings as $setting)
                                    @switch($setting->type)
                                        @case(Setting::TYPE_FILE)
                                            <div class="row">
                                                <label class="col-lg-3 col-sm-12 mb-3">
                                                    {{ $setting->name }}
                                                    @if ($setting->description)
                                                        <i class="fas fa-question-circle mr-2" role="button"
                                                            data-bs-toggle="tooltip" title="{!! $setting->description !!}"></i>
                                                    @endif
                                                </label>
                                                <div class="col-lg-9 col-sm-12 mb-3 show">
                                                    <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ get_file($setting->value) }}" alt="setting"
                                                        class="image-setting preview" loading="lazy">
                                                    <input type="file" class="form-control previewImg"
                                                        name="{{ $setting->code }}" class="{{ $setting->code }}" accept="image/*">
                                                    <div class="form-text">(Chấp nhận kiểu tập tin: png, jpg, jpeg)</div>
                                                </div>
                                            </div>
                                        @break

                                        @case(Setting::TYPE_IMAGES)
                                            <div class="row">
                                                <label class="col-lg-3 col-sm-12 mb-3">
                                                    {{ $setting->name }}
                                                    @if ($setting->description)
                                                        <i class="fas fa-question-circle mr-2" role="button"
                                                            data-bs-toggle="tooltip" title="{!! $setting->description !!}"></i>
                                                    @endif
                                                </label>
                                                <div class="col-lg-9 col-sm-12 mb-3 show">
                                                    @php
                                                        $images = get_image_from_codes($setting->code);
                                                    @endphp
                                                    <div class="w-100 d-flex flex-wrap">
                                                        @foreach ($images as $item)
                                                            <div id="{{ $item->id }}" draggable="true"
                                                                class="draggable img-album position-relative w-65px me-4 btn-delete-image-{{ $item->id }}">
                                                                <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ get_file($item->url) }}" alt="setting"
                                                                    class="image-setting" loading="lazy">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger btn-delete-image position-absolute top-0 right-0"
                                                                    data-id={{ $item->id }}>
                                                                    x
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <input type="file" class="form-control" multiple
                                                        name="{{ $setting->code }}[]" class="{{ $setting->code }}"
                                                        accept="image/*">
                                                    <div class="form-text">(Chấp nhận kiểu tập tin: png, jpg, jpeg)</div>
                                                </div>
                                            </div>
                                        @break

                                        @case(Setting::TYPE_RADIO)
                                            @php
                                                $_data = $setting->data_json ? json_decode($setting->data_json) : [];
                                            @endphp
                                            <div class="row">
                                                <label class="col-lg-3 col-sm-12 mb-3">
                                                    {{ $setting->name }}
                                                    @if ($setting->description)
                                                        <i class="fas fa-question-circle mr-2" role="button"
                                                            data-bs-toggle="tooltip" title="{!! $setting->description !!}"></i>
                                                    @endif
                                                </label>
                                                <div class="col-lg-9 col-sm-12 mb-3">
                                                    @foreach ($_data as $item)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" name="{{ $setting->code }}"
                                                                type="radio"
                                                                id="inlineRadio{{ $setting->code }}_{{ $item->id }}"
                                                                value="{{ $item->id }}"
                                                                {{ $setting->value == $item->id ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="inlineRadio{{ $setting->code }}_{{ $item->id }}">{{ $item->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @break

                                        @case(Setting::TYPE_TEXT_AREA)
                                            <div class="row">
                                                <label class="col-lg-3 col-sm-12 mb-3">
                                                    {{ $setting->name }}
                                                    @if ($setting->description)
                                                        <i class="fas fa-question-circle mr-2" role="button"
                                                            data-bs-toggle="tooltip" title="{!! $setting->description !!}"></i>
                                                    @endif
                                                </label>
                                                <div class="col-lg-9 col-sm-12 mb-3">
                                                    <textarea name="{{ $setting->code }}" rows="3" class="form-control">{{ $setting->$value ?? $setting->value }}</textarea>
                                                </div>
                                            </div>
                                        @break

                                        @case(Setting::TYPE_EDITOR)
                                            <div class="row">
                                                <label class="col-lg-3 col-sm-12 mb-3">
                                                    {{ $setting->name }}
                                                    @if ($setting->description)
                                                        <i class="fas fa-question-circle mr-2" role="button"
                                                            data-bs-toggle="tooltip" title="{!! $setting->description !!}"></i>
                                                    @endif
                                                </label>
                                                <div class="col-lg-9 col-sm-12 mb-3">
                                                    <textarea name="{{ $setting->code }}" rows="3" class="form-control ckeditor">{{ $setting->$value ?? $setting->value }}</textarea>
                                                </div>
                                            </div>
                                        @break

                                        @default
                                            <div class="row">
                                                <label class="col-lg-3 col-sm-12 mb-3">
                                                    {{ $setting->name }}
                                                    @if ($setting->description)
                                                        <i class="fas fa-question-circle mr-2" role="button"
                                                            data-bs-toggle="tooltip" title="{!! $setting->description !!}"></i>
                                                    @endif
                                                </label>
                                                <div class="col-lg-9 col-sm-12 mb-3">
                                                    <input type="{{ $setting->type }}" name={{ $setting->code }}
                                                        class="form-control" value="{{ $setting->$value ?? $setting->value }}" />
                                                </div>
                                            </div>
                                        @break
                                    @endswitch
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn-submit btn btn-primary">
                                    <i class="fas fa-save"></i> Cập nhật
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-info mt-3" role="alert">
        Phần cấu hình "Tổng quan" liên quan đến SEO của website, vì thế cần cân nhắc khi sử dụng chức năng này!
    </div>
@endsection
@push('js')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
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
                $('#editor').val(editor.getData());
            })

            $(document).on('click', '.btn-delete-image', function() {
                const id = $(this).data('id');
                $.post("{{ route('user.delete_image') }}", {
                    id
                }, function(data) {
                    if (data?.status) {
                        $('.btn-delete-image-' + id).remove();
                    }
                });
            })

            let draggedItem = null;

            $(document).on('dragstart', '.draggable', function(event) {
                draggedItem = $(this);
            });

            $(document).on('dragover', function(event) {
                event.preventDefault();
            });

            $(document).on('drop', '.img-album', function(event) {
                event.preventDefault();
                $(this).removeClass('drag-over');

                if (draggedItem !== null) {
                    const draggedId = draggedItem.attr('id'); // Lấy ID của phần tử kéo
                    const targetId = $(this).attr('id'); // Lấy ID của phần tử đích

                    if (draggedId && targetId) {
                        swapItem(draggedId, targetId); // Gửi ID để hoán đổi

                        // Hoán đổi phần tử trong DOM
                        if (draggedItem.index() < $(this).index()) {
                            $(this).after(draggedItem);
                        } else {
                            $(this).before(draggedItem);
                        }

                        draggedItem = null; // Đặt lại draggedItem
                    }
                }
            });

            // Hàm gửi ID của hai phần tử để hoán đổi
            function swapItem(draggedId, targetId) {
                $.post("{{ route('user.setting.swapImage') }}", {
                    draggedId: draggedId, // Gửi ID của phần tử bị kéo
                    targetId: targetId // Gửi ID của phần tử đích
                }, function(rs) {
                    Toast.fire({
                        icon: rs?.type || 'error', // Thêm giá trị mặc định nếu có lỗi
                        title: rs.message || 'An error occurred during the swap.'
                    });
                }).fail(function(xhr) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Failed to swap images: ' + xhr.responseText
                    });
                });
            }
        })
    </script>
@endpush

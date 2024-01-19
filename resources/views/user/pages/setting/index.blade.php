@php
    use App\Models\Setting;
    $group = $data['group'];
@endphp
@extends('user.default')
@section('title', 'Cài đặt')
@section('content')
    <div class="d-flex justify-content-between mb-1">
        <h5>Cài đặt hệ thống</h5>
        <div class="btn-group" role="group">
            <button class="btn btn-primary btn-update">
                <i class="fas fa-save"></i> Lưu thay đổi
            </button>
        </div>
    </div>
    <div>
        <div class="setting">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($data['groups'] as $item)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary {{ $group->id == $item->id ? 'active' : '' }}"
                            href="{{ route('user.setting.index') . '?type=' . $item->code }}">
                            {!! $item->icon !!}&nbsp; {{ $item->name }}
                        </a>
                    </li>
                @endforeach
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
                                                    <img src="{{ $setting->value }}" alt="setting" class="image-setting preview">
                                                    <input type="file" class="form-control previewImg"
                                                        name="{{ $setting->code }}" class="{{ $setting->code }}" accept="image/*">
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
                                                    <textarea name="{{ $setting->code }}" rows="3" class="form-control">{{ $setting->value }}</textarea>
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
                                                    <textarea name="{{ $setting->code }}" rows="3" class="form-control ckeditor">{{ $setting->value }}</textarea>
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
                                                        class="form-control" value="{{ $setting->value }}" />
                                                </div>
                                            </div>
                                        @break
                                    @endswitch
                                @endforeach
                            </div>
                            <div class="card-footer" style="display: none;">
                                <button type="submit" class="" class="btn-submit">Cập
                                    nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        CKEDITOR.replace('ckeditor', {
            height: 280,
            toolbar: 'Full',
            filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
            filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
            filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
            filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
        });
    </script>
@endpush

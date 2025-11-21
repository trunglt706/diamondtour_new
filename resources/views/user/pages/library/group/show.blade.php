<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-vi-tab-update" data-bs-toggle="tab" data-bs-target="#nav-vi-update"
            type="button" role="tab" aria-controls="nav-vi-update" aria-selected="true">Tiếng Việt</button>
        <button class="nav-link" id="nav-en-tab-update" data-bs-toggle="tab" data-bs-target="#nav-en-update"
            type="button" role="tab" aria-controls="nav-en-update" aria-selected="false">Tiếng
            Anh</button>
        <button class="nav-link" id="nav-ch-tab-update" data-bs-toggle="tab" data-bs-target="#nav-ch-update"
            type="button" role="tab" aria-controls="nav-ch-update" aria-selected="false">Tiếng
            Trung</button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-vi-update" role="tabpanel" aria-labelledby="nav-vi-tab-update"
        tabindex="0">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <input type="hidden" name="type" value="all">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-1 form-group">
                    <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                    <input type="text" placeholder="Tên danh mục" value="{{ $data->name }}" class="form-control"
                        required name="name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-1 form-group">
                    <label class="col-form-label">Thuộc nhóm</label>
                    <select name="tour_group_id" class="form-select filter-tour_group_id">
                        @if ($data->tourGroup)
                            <option value="{{ $data->tour_group_id }}">{{ $data->tourGroup->name }}</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-1 form-group">
                    <label class="col-form-label">Thời gian</label>
                    <input type="date" class="form-control" value="{{ $data->date }}" name="date">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-1 form-group">
                    <label class="col-form-label">Địa điểm</label>
                    <input type="text" class="form-control" value="{{ $data->address }}" name="address">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center my-3">
            <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $data->image ? get_file($data->image) : asset('user/img/user/no-avatar.jpg') }}"
                class="img-thumbnail preview w-80px h-70px" loading="lazy" alt="img">
            <div class="form-group w-100 ps-3">
                <label class="col-form-label">Hình ảnh</label>
                <input type="file" class="form-control previewImg" name="image" accept="image/*">
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group mb-1">
                    <label class="col-form-label">
                        Ảnh background
                        <small class="fst-italic">(Đề xuất 1579 x 407 px)</small>
                    </label>
                    <input type="file" class="form-control previewImg" name="background" accept="image/*">
                </div>
            </div>
            <div class="col-md-5 mb-1">
                <div class="form-group">
                    <label class="col-form-label">
                        Theo mùa
                    </label>
                    <select name="season" class="form-select">
                        <option value="" selected>-- Chọn --</option>
                        @foreach ($seasons as $key => $item)
                            <option value="{{ $key }}" {{ $key == $data->season ? 'selected' : '' }}>
                                {{ $item[0] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-1 form-group">
            <label class="col-form-label">Mô tả</label>
            <textarea class="form-control" placeholder="Nội dung mô tả" rows="2" name="description">{{ $data->description }}</textarea>
        </div>
        <div class="my-3 d-flex justify-content-between">
            <div class="form-check form-switch">
                <input class="form-check-input" name="status" value="active" type="checkbox" role="switch"
                    id="switch_status_update" {{ $data->status == 'active' ? 'checked' : '' }}>
                <label class="form-check-label" for="switch_status_update">
                    Kích hoạt
                </label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" name="important" value="1" type="checkbox" role="switch"
                    id="switch_important_update" {{ $data->important ? 'checked' : '' }}>
                <label class="form-check-label" for="switch_important_update">
                    Độ ưu tiên
                </label>
            </div>
        </div>
        <div class="my-3 d-flex justify-content-between">
            <div class="form-check form-switch">
                <input class="form-check-input" name="guest" value="1" type="checkbox" role="switch"
                    id="switch_update_guest" {{ $data->guest ? 'checked' : '' }}>
                <label class="form-check-label" for="switch_update_guest">
                    Album của khách
                </label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" name="hot" value="1" type="checkbox" role="switch"
                    id="switch_update_hot" {{ $data->hot ? 'checked' : '' }}>
                <label class="form-check-label" for="switch_update_hot">
                    Album hot
                </label>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-en-update" role="tabpanel" aria-labelledby="nav-en-tab-update"
        tabindex="0">
        <div class="mb-1 form-group">
            <label class="col-form-label">Tên</label>
            <input type="text" placeholder="Tên danh mục" value="{{ $data->name_en }}" class="form-control"
                name="name_en">
        </div>
    </div>
    <div class="tab-pane fade" id="nav-ch-update" role="tabpanel" aria-labelledby="nav-ch-tab-update"
        tabindex="0">
        <div class="mb-1 form-group">
            <label class="col-form-label">Tên</label>
            <input type="text" placeholder="Tên danh mục" value="{{ $data->name_ch }}" class="form-control"
                name="name_ch">
        </div>
    </div>
</div>

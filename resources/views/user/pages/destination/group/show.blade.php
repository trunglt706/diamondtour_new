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
        <div class="mb-1 form-group">
            <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
            <input type="text" placeholder="Tên danh mục" class="form-control" required value="{{ $data->name }}"
                name="name">
        </div>
        <div class="d-flex justify-content-between align-items-center my-3">
            <img src="{{ $data->image ? get_url($data->image) : asset('user/img/user/no-avatar.jpg') }}"
                class="img-thumbnail preview w-80px h-70px" alt="img">
            <div class="form-group w-100 ps-3">
                <label class="col-form-label">Hình ảnh</label>
                <input type="file" class="form-control previewImg" name="image" accept="image/*">
            </div>
        </div>
        <div class="mb-1 form-group">
            <label class="col-form-label">Mô tả</label>
            <textarea class="form-control" placeholder="Nội dung mô tả" rows="2" name="description">{{ $data->description }}</textarea>
        </div>
        <div class="my-3 d-flex justify-content-between align-items-center">
            <div class="mb-1 form-group">
                <label class="col-form-label">Trạng thái</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="status" value="active" type="checkbox" role="switch"
                        id="switch_status_update" {{ $data->status == 'active' ? 'checked' : '' }}>
                    <label class="form-check-label" for="switch_status_update">
                        Kích hoạt
                    </label>
                </div>
            </div>
            <div class="mb-1 form-group">
                <label class="col-form-label">Thứ tự</label>
                <input type="number" placeholder="Thứ tự" value="{{ $data->numering }}" class="form-control"
                    name="numering">
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-en-update" role="tabpanel" aria-labelledby="nav-en-tab-update" tabindex="0">
        <div class="mb-1 form-group">
            <label class="col-form-label">Tên</label>
            <input type="text" placeholder="Tên danh mục" value="{{ $data->name_en }}" class="form-control"
                name="name_en">
        </div>
    </div>
    <div class="tab-pane fade" id="nav-ch-update" role="tabpanel" aria-labelledby="nav-ch-tab-update" tabindex="0">
        <div class="mb-1 form-group">
            <label class="col-form-label">Tên</label>
            <input type="text" placeholder="Tên danh mục" value="{{ $data->name_ch }}" class="form-control"
                name="name_ch">
        </div>
    </div>
</div>

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
        <div class="mb-1 form-group">
            <div class="mb-1 form-group">
                <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                <input type="text" placeholder="Tên thư viện" class="form-control" required
                    value="{{ $data->name }}" name="name">
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
                <div class="d-flex justify-content-between align-items-center">
                    <label class="col-form-label">Danh mục <span class="text-danger fw-900">*</span></label>
                    <a href="{{ route('user.library_group.index') }}" target="_blank" class="add-new"
                        data-bs-toggle="tooltip" title="Tạo mới">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <select name="group_id" class="form-select filter-group_id">
                    <option value="{{ $data->group_id }}">{{ $data->group->name }}</option>
                </select>
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
        </div>
    </div>
    <div class="tab-pane fade" id="nav-en-update" role="tabpanel" aria-labelledby="nav-en-tab-update" tabindex="0">
        <div class="mb-1 form-group">
            <label class="col-form-label">Tên</label>
            <input type="text" placeholder="Tên ảnh" value="{{ $data->name_en }}" class="form-control"
                name="name_en">
        </div>
    </div>
    <div class="tab-pane fade" id="nav-ch-update" role="tabpanel" aria-labelledby="nav-ch-tab-update"
        tabindex="0">
        <div class="mb-1 form-group">
            <label class="col-form-label">Tên</label>
            <input type="text" placeholder="Tên ảnh" value="{{ $data->name_ch }}" class="form-control"
                name="name_ch">
        </div>
    </div>
</div>

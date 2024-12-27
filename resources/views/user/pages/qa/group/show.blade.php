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
            <div class="mb-1 form-group">
                <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                <input type="text" placeholder="Tên danh mục" class="form-control" required
                    value="{{ $data->name }}" name="name">
            </div>
            <div class="my-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" name="status" value="active" type="checkbox" role="switch"
                        id="switch_status_update" {{ $data->status == 'active' ? 'checked' : '' }}>
                    <label class="form-check-label" for="switch_status_update">
                        Kích hoạt
                    </label>
                </div>
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

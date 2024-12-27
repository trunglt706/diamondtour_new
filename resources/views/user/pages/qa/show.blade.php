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
            <div class="row">
                <div class="form-group mb-1 col-md-5">
                    <label class="col-form-label">Danh mục</label>
                    <select name="group_id" class="form-select filter-group_id">
                        <option value="{{ $data->group_id }}">{{ $data->group->name }}</option>
                    </select>
                </div>
                <div class="mb-1 form-group col-md-7">
                    <label class="col-form-label">Tiêu đề <span class="text-danger fw-900">*</span></label>
                    <input type="text" class="form-control" required name="name" value="{{ $data->name }}">
                </div>
            </div>
            <div class="mb-1 form-group">
                <label class="col-form-label">Mô tả</label>
                <textarea name="description" id="ckeditor" rows="3" class="form-control">{{ $data->description }}</textarea>
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
            <label class="col-form-label">Tiêu đề</label>
            <input type="text" placeholder="Nhập tiêu đề" value="{{ $data->name_en }}" class="form-control"
                name="name_en">
        </div>
        <div class="mb-1 form-group">
            <label class="col-form-label">Mô tả</label>
            <textarea name="description_en" id="ckeditor_en" rows="3" class="form-control">{{ $data->description_en }}</textarea>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-ch-update" role="tabpanel" aria-labelledby="nav-ch-tab-update" tabindex="0">
        <div class="mb-1 form-group">
            <label class="col-form-label">Tiêu đề</label>
            <input type="text" placeholder="Nhập tiêu đề" value="{{ $data->name_ch }}" class="form-control"
                name="name_ch">
        </div>
        <div class="mb-1 form-group">
            <label class="col-form-label">Mô tả</label>
            <textarea name="description_ch" id="ckeditor_ch" rows="3" class="form-control">{{ $data->description_ch }}</textarea>
        </div>
    </div>
</div>

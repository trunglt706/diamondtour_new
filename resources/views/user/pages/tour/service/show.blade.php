<input type="hidden" name="id" value="{{ $data->id }}">
<input type="hidden" name="type" value="all">
<div class="mb-1 form-group">
    <div class="mb-1 form-group">
        <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
        <input type="text" placeholder="Tên danh mục" class="form-control" required value="{{ $data->name }}"
            name="name">
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

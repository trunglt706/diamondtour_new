<input type="hidden" name="id" value="{{ $data->id }}">
<input type="hidden" name="type" value="all">
<div class="mb-1 form-group">
    <div class="mb-1 form-group">
        <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
        <input type="text" placeholder="Tên danh mục" class="form-control" required value="{{ $data->name }}"
            name="name">
    </div>
    <div class="row">
        <div class="mb-1 form-group">
            <label class="col-form-label">Bắt đầu <span class="text-danger fw-900">*</span></label>
            <input type="number" min="0" placeholder="VD: 0" class="form-control" value="{{ $data->from }}"
                required name="from">
        </div>
        <div class="mb-1 form-group">
            <label class="col-form-label">Kết thúc <span class="text-danger fw-900">*</span></label>
            <input type="number" min="0" placeholder="VD: 1000000" class="form-control"
                value="{{ $data->to }}" required name="to">
        </div>
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

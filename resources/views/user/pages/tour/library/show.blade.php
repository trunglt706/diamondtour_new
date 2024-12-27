<input type="hidden" name="id" value="{{ $data->id }}">
<input type="hidden" name="type" value="tour">
<div class="mb-1 form-group">
    <div class="row">
        <div class="col-md-7">
            <div class="mb-1 form-group">
                <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                <input type="text" placeholder="Tên ảnh" value="{{ $data->name }}" class="form-control" required
                    name="name">
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-1 form-group">
                <label class="col-form-label">Thứ tự ưu tiên</label>
                <input type="number" min="0" placeholder="Tự sinh" value="{{ $data->numering }}"
                    class="form-control" name="numering">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center my-3">
        <img src="{{ $data->image ? get_url($data->image) : asset('user/img/user/no-avatar.jpg') }}"
            class="img-thumbnail preview w-80px h-70px" alt="img">
        <div class="form-group w-100 ps-3">
            <label class="col-form-label">Hình ảnh</label>
            <input type="file" class="form-control previewImg" name="image" accept="image/*">
        </div>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" name="status" value="active" type="checkbox" role="switch"
            id="switch_status_update" {{ $data->status == 'active' ? 'checked' : '' }}>
        <label class="form-check-label" for="switch_status_update">
            Kích hoạt
        </label>
    </div>
</div>

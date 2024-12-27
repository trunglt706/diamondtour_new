<input type="hidden" name="id" value="{{ $data->id }}">
<input type="hidden" name="type" value="all">
<div class="mb-1 form-group">
    <div class="mb-1 form-group">
        <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
        <input type="text" placeholder="Tên module" class="form-control" required value="{{ $data->name }}"
            name="name">
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-1 form-group">
                <label class="col-form-label">Đường dẫn liên kết</label>
                <input type="url" class="form-control" placeholder="VD: https://" value="{{ $data->link }}"
                    name="link">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-1 form-group">
                <label class="col-form-label">Thứ tự ưu tiên</label>
                <input type="integer" class="form-control" name="numering" value="{{ $data->numering }}">
            </div>
        </div>
    </div>
    {{-- <div class="mb-1 form-group">
        <label class="col-form-label">
            Icon
            <small>
                <a href="https://fontawesome.com/v5/search?o=r&m=free" target="_blank">(Xem tại đây)</a>
            </small>
        </label>
        <input type="text" class="form-control" value="{{ $data->icon }}" name="icon">
    </div> --}}
    <div class="d-flex justify-content-between align-items-center my-3">
        <img src="{{ $data->icon ? get_url($data->icon) : asset('user/img/user/no-avatar.jpg') }}"
            class="img-thumbnail preview w-80px h-70px" alt="img">
        <div class="form-group w-100 ps-3">
            <label class="col-form-label">Hình ảnh</label>
            <input type="file" class="form-control previewImg" name="icon" accept="image/*">
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

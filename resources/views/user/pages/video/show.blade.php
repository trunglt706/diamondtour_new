<input type="hidden" name="id" value="{{ $data->id }}">
<div class="mb-1 form-group">
    <label class="col-form-label">Tên thước phim <span class="text-danger fw-900">*</span></label>
    <input type="text" value="{{ $data->video_name }}" class="form-control" required name="video_name">
</div>
<div class="mb-1 form-group">
    <label class="col-form-label">Đường dẫn <span class="text-danger fw-900">*</span></label>
    <input type="text" placeholder="https://" value="{{ $data->video_url }}" class="form-control" required
        name="video_url">
</div>
<div class="d-flex justify-content-between align-items-center my-3">
    <img src="{{ $data->video_image ? get_url($data->video_image) : asset('user/img/user/no-avatar.jpg') }}"
        class="img-thumbnail preview w-80px h-70px" alt="img">
    <div class="form-group w-100 ps-3">
        <label class="col-form-label">Ảnh nền</label>
        <input type="file" class="form-control previewImg" name="video_image" accept="image/*">
    </div>
</div>
<div class="form-check form-switch">
    <input class="form-check-input" name="video_status" value="active" type="checkbox" role="switch"
        id="switch_status_update" {{ $data->video_status == 'active' ? 'checked' : '' }}>
    <label class="form-check-label" for="switch_status_update">
        Kích hoạt
    </label>
</div>

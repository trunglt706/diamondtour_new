<input type="hidden" name="id" value="{{ $data->id }}">
<input type="hidden" name="tour_id" value="{{ $data->tour_id }}">
<input type="hidden" name="type" value="all">
<div class="mb-1 form-group">
    <div class="mb-1 form-group">
        <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
        <input type="text" placeholder="Tên lịch trình" class="form-control" required value="{{ $data->name }}"
            name="name">
    </div>
    <div class="d-flex justify-content-between align-items-center my-3">
        <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $data->image ? get_file($data->image) : asset('user/img/user/no-avatar.jpg') }}"
            class="img-thumbnail preview w-80px h-70px" loading="lazy" alt="img">
        <div class="form-group w-100 ps-3">
            <label class="col-form-label">
                Hình ảnh
                <small class="fst-italic">
                    (Kích thước gợi ý: 355 x 200px)
                </small>
            </label>
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

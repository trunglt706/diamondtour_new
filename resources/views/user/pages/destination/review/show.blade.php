<input type="hidden" name="id" value="{{ $data->id }}">
<input type="hidden" name="type" value="all">
<div class="row">
    <div class="mb-1 form-group col-md-6">
        <label class="col-form-label">Họ tên <span class="text-danger fw-900">*</span></label>
        <input type="text" class="form-control" required value="{{ $data->user_name }}" name="user_name">
    </div>
    <div class="col-md-6 mb-1 form-group">
        <label class="col-form-label">Chức vụ <span class="text-danger fw-900">*</span></label>
        <input type="text" class="form-control" required value="{{ $data->name }}" name="name">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-1">
        <label class="col-form-label">
            Điểm đến <small class="fst-italic">(Nếu không chọn, sẽ hiển thị tại trang chủ)</small>
        </label>
        <select name="destination_id" class="form-select destination_id">
            @if ($data->destination_id)
                <option value="{{ $data->destination_id }}">{{ $data->destination->name }}</option>
            @endif
        </select>
    </div>
    <div class="col-md-6 mb-1">
        <div class="d-flex justify-content-between align-items-center">
            <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $data->user_avatar ? get_file($data->user_avatar) : asset('user/img/user/no-avatar.jpg') }}"
                class="img-thumbnail preview w-80px h-70px" loading="lazy" alt="img">
            <div class="form-group w-100 ps-3">
                <label class="col-form-label">Ảnh đại diện</label>
                <input type="file" class="form-control previewImg" name="user_avatar" accept="image/*">
            </div>
        </div>
    </div>
</div>
<div class="mb-1 form-group">
    <label class="col-form-label">Nội dung</label>
    <textarea class="form-control" placeholder="Nội dung review" rows="2" name="content">{{ $data->content }}</textarea>
</div>
<div class="my-3 d-flex justify-content-between">
    <div class="form-check form-switch">
        <input class="form-check-input" name="status" value="active" type="checkbox" role="switch" id="update_status"
            {{ $data->status == 'active' ? 'checked' : '' }}>
        <label class="form-check-label" for="update_status">
            Kích hoạt
        </label>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" name="important" value="1" type="checkbox" role="switch"
            id="switch_update_important" {{ $data->important ? 'checked' : '' }}>
        <label class="form-check-label" for="switch_update_important">Ưu tiên</label>
    </div>
</div>

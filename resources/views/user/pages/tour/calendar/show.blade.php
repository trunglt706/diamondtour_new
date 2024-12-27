<input type="hidden" name="id" value="{{ $data->id }}">
<input type="hidden" name="type" value="all">
<div class="mb-1 form-group">
    <label class="col-form-label">Tour <span class="text-danger fw-900">*</span></label>
    <select name="tour_id" class="form-select tour_id">
        @if ($data->tour)
            <option value="{{ $data->tour_id }}">{{ $data->tour->name }}
            </option>
        @endif
    </select>
</div>
<div class="row">
    <div class="mb-1 form-group col-md-6">
        <label class="col-form-label">Đơn giá</label>
        <input type="text" class="form-control" placeholder="VD: 2000000" value="{{ $data->price }}" name="price">
    </div>
    <div class="mb-1 form-group col-md-6">
        <label class="col-form-label">Còn trống</label>
        <input type="number" class="form-control" placeholder="VD: 100" value="{{ $data->empty }}" name="empty"
            min="0">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-1">
        <label class="col-form-label">Bắt đầu <span class="text-danger fw-900">*</span></label>
        <input type="date" class="form-control" value="{{ $data->start }}" name="start">
    </div>
    <div class="col-md-6 mb-1">
        <label class="col-form-label">Kết thúc <span class="text-danger fw-900">*</span></label>
        <input type="date" class="form-control" value="{{ $data->end }}" name="end">
    </div>
</div>
<div class="form-group mb-1">
    <label class="col-form-label">Mô tả</label>
    <textarea name="description" rows="3" class="form-control">{{ $data->description }}</textarea>
</div>
<div class="my-3 d-flex justify-content-between">
    <div class="form-check form-switch">
        <input class="form-check-input" name="status" value="active" type="checkbox" role="switch"
            id="switch_status_update" {{ $data->status == 'active' ? 'checked' : '' }}>
        <label class="form-check-label" for="switch_status_update">
            Đang nhận khách
        </label>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" name="display" value="1" type="checkbox" role="switch"
            id="switch_display_update" {{ $data->display ? 'checked' : '' }}>
        <label class="form-check-label" for="switch_display_update">
            Hiển thị lịch
        </label>
    </div>
</div>

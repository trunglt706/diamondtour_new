<input type="hidden" name="id" value="{{ $data->id }}">
<input type="hidden" name="type" value="all">
<div class="mb-1 form-group">
    <div class="mb-1 form-group">
        <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
        <input type="text" placeholder="Tên khu vực" class="form-control" required value="{{ $data->name }}"
            name="name">
    </div>
    <div class="form-group mb-1">
        <label class="col-form-label">Quốc gia</label>
        <select name="country_id" class="form-select country_id">
            @if ($data->country)
                <option value="{{ $data->country_id }}">{{ $data->country->name }}</option>
            @endif
        </select>
    </div>
</div>

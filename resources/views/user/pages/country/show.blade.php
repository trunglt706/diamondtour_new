<input type="hidden" name="id" value="{{ $data->id }}">
<input type="hidden" name="type" value="all">
<div class="mb-1 form-group">
    <div class="mb-1 form-group">
        <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
        <input type="text" placeholder="Tên quốc gia" class="form-control" required value="{{ $data->name }}"
            name="name">
    </div>
</div>

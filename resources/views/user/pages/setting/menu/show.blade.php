<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
            role="tab" aria-controls="nav-home" aria-selected="true">
            Tiếng Việt
        </button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
            role="tab" aria-controls="nav-profile" aria-selected="false">
            Tiếng Anh
        </button>
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button"
            role="tab" aria-controls="nav-contact" aria-selected="false">
            Tiếng Trung
        </button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <input type="hidden" name="type" value="all">
        <div class="mb-1 form-group">
            <div class="mb-1 form-group">
                <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                <input type="text" placeholder="Tên menu" class="form-control" required value="{{ $data->name }}"
                    name="name">
            </div>
            @if ($data->code != 'dashboard')
                <div class="d-flex justify-content-between align-items-center my-3">
                    <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $data->background ? get_file($data->background) : asset('user/img/user/no-avatar.jpg') }}"
                        class="img-thumbnail preview w-80px h-70px" loading="lazy" alt="img">
                    <div class="form-group w-100 ps-3">
                        <label class="col-form-label">
                            Ảnh nền
                            <small class="fst-italic">
                                (Kích thước gợi ý: 1579 x 407 px)
                            </small>
                        </label>
                        <input type="file" class="form-control previewImg" name="background" accept="image/*">
                    </div>
                </div>
            @else
                <div class="form-group mb-1">
                    <label class="col-form-label">
                        Album ảnh
                        <small class="fst-italic">
                            (Có thể chọn nhiều ảnh. Kích thước gợi ý: 1579 x 557 px)
                        </small>
                    </label>
                    <input type="file" class="form-control" multiple name="images[]" min="0" accept="image/*">
                </div>
            @endif
            <div class="mb-1 form-group">
                <label class="col-form-label">
                    Mô tả
                </label>
                <textarea class="form-control" placeholder="Nội dung mô tả" rows="3" name="description">{{ $data->description }}</textarea>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
        <div class="mb-1 form-group">
            <label class="col-form-label">Tên</label>
            <input type="text" placeholder="Tên menu" class="form-control" value="{{ $data->name_en }}"
                name="name_en">
        </div>
        <div class="mb-1 form-group">
            <label class="col-form-label">
                Mô tả
            </label>
            <textarea class="form-control" placeholder="Nội dung mô tả" rows="3" name="description_en">{{ $data->description_en }}</textarea>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
        <div class="mb-1 form-group">
            <label class="col-form-label">Tên</label>
            <input type="text" placeholder="Tên menu" class="form-control" value="{{ $data->name_ch }}"
                name="name_ch">
        </div>
        <div class="mb-1 form-group">
            <label class="col-form-label">
                Mô tả
            </label>
            <textarea class="form-control" placeholder="Nội dung mô tả" rows="3" name="description_ch">{{ $data->description_ch }}</textarea>
        </div>
    </div>
</div>

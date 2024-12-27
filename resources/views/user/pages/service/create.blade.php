<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.service.insert') }}" id="form-create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tạo mới dịch vụ</h1>
                    <span>
                        <small class="pe-2">
                            Các trường có dấu <span class="text-danger fw-900">*</span></label> là bắt buộc
                        </small>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </span>
                </div>
                <div class="modal-body px-4 py-1">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-vi-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-vi" type="button" role="tab" aria-controls="nav-vi"
                                aria-selected="true">Tiếng Việt</button>
                            <button class="nav-link" id="nav-en-tab" data-bs-toggle="tab" data-bs-target="#nav-en"
                                type="button" role="tab" aria-controls="nav-en" aria-selected="false">Tiếng
                                Anh</button>
                            <button class="nav-link" id="nav-ch-tab" data-bs-toggle="tab" data-bs-target="#nav-ch"
                                type="button" role="tab" aria-controls="nav-ch" aria-selected="false">Tiếng
                                Trung</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-vi" role="tabpanel"
                            aria-labelledby="nav-vi-tab" tabindex="0">
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                                <input type="text" placeholder="Tên dịch vụ" class="form-control" required
                                    name="name">
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-3">
                                <img src="{{ asset('user/img/user/no-avatar.jpg') }}"
                                    class="img-thumbnail preview w-80px h-70px" alt="img">
                                <div class="form-group w-100 ps-3">
                                    <label class="col-form-label">Icon</label>
                                    <input type="file" class="form-control previewImg" name="image"
                                        accept="image/*">
                                </div>
                            </div>
                            <div class="mb-1 form-group">
                                <label class="col-form-label">
                                    Album ảnh <small class="fst-italic">(Có thể chọn nhiều ảnh)</small>
                                </label>
                                <input type="file" class="form-control" name="backgrounds[]" multiple
                                    accept="image/*">
                            </div>
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Mô tả</label>
                                <textarea class="form-control" placeholder="Nội dung mô tả" rows="2" name="description"></textarea>
                            </div>
                            <div class="my-3 d-flex justify-content-between align-items-center">
                                <div class="mb-1 form-group">
                                    <label class="col-form-label">Trạng thái</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="status" value="active" type="checkbox"
                                            role="switch" id="switch_status" checked>
                                        <label class="form-check-label" for="switch_status">
                                            Kích hoạt
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-1 form-group">
                                    <label class="col-form-label">Thứ tự</label>
                                    <input type="number" placeholder="Thứ tự" class="form-control" name="numering">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab"
                            tabindex="0">
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Tên</label>
                                <input type="text" placeholder="Tên dịch vụ" class="form-control" name="name_en">
                            </div>
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Mô tả</label>
                                <textarea class="form-control" placeholder="Nội dung mô tả" rows="2" name="description_en"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-ch" role="tabpanel" aria-labelledby="nav-ch-tab"
                            tabindex="0">
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Tên</label>
                                <input type="text" placeholder="Tên dịch vụ" class="form-control" name="name_ch">
                            </div>
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Mô tả</label>
                                <textarea class="form-control" placeholder="Nội dung mô tả" rows="2" name="description_ch"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-long-arrow-alt-left"></i> Thoát
                    </button>
                    <button type="submit" class="btn bg-gradient-cyan-blue btn-create text-white">
                        <i class="fas fa-plus"></i> Tạo mới
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

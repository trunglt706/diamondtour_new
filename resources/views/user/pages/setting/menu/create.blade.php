<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.menu.insert') }}" id="form-create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tạo mới menu</h1>
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
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">
                                Tiếng Việt
                            </button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">
                                Tiếng Anh
                            </button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                aria-selected="false">
                                Tiếng Trung
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab" tabindex="0">
                            <div class="mb-1 form-group">
                                <div class="mb-1 form-group">
                                    <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                                    <input type="text" placeholder="Tên menu" class="form-control" required
                                        name="name">
                                </div>
                                <div class="mb-1 form-group">
                                    <label class="col-form-label">Đường dẫn <span
                                            class="text-danger fw-900">*</span></label>
                                    <input type="text" placeholder="https://" class="form-control" required
                                        name="link">
                                </div>
                                <div class="mb-1 form-group">
                                    <label class="col-form-label">
                                        Ảnh nền
                                        <small class="fst-italic">
                                            (Kích thước gợi ý: 1579 x 407 px)
                                        </small>
                                    </label>
                                    <input type="file" class="form-control previewImg" name="background"
                                        accept="image/*">
                                </div>
                                <div class="mb-1 form-group">
                                    <label class="col-form-label">
                                        Mô tả
                                    </label>
                                    <textarea class="form-control" placeholder="Nội dung mô tả" rows="3" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                            tabindex="0">
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Tên</label>
                                <input type="text" placeholder="Tên menu" class="form-control" name="name_en">
                            </div>
                            <div class="mb-1 form-group">
                                <label class="col-form-label">
                                    Mô tả
                                </label>
                                <textarea class="form-control" placeholder="Nội dung mô tả" rows="3" name="description_en"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                            tabindex="0">
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Tên</label>
                                <input type="text" placeholder="Tên menu" class="form-control" name="name_ch">
                            </div>
                            <div class="mb-1 form-group">
                                <label class="col-form-label">
                                    Mô tả
                                </label>
                                <textarea class="form-control" placeholder="Nội dung mô tả" rows="3" name="description_ch"></textarea>
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

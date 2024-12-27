<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.qa_group.insert') }}" id="form-create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tạo mới danh mục</h1>
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
                                <input type="text" placeholder="Tên danh mục" class="form-control" required
                                    name="name">
                            </div>
                            <div class="my-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="status" value="active" type="checkbox"
                                        role="switch" id="switch_status" checked>
                                    <label class="form-check-label" for="switch_status">
                                        Kích hoạt
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab"
                            tabindex="0">
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Tên</label>
                                <input type="text" placeholder="Tên danh mục" class="form-control" name="name_en">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-ch" role="tabpanel" aria-labelledby="nav-ch-tab"
                            tabindex="0">
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Tên</label>
                                <input type="text" placeholder="Tên danh mục" class="form-control" name="name_ch">
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

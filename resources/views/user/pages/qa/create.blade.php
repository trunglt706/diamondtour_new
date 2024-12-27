<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('user.qa.insert') }}" id="form-create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tạo mới câu hỏi</h1>
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
                            <div class="row">
                                <div class="form-group mb-1 col-md-5">
                                    <label class="col-form-label">Danh mục</label>
                                    <select name="group_id" class="form-select filter-group_id">

                                    </select>
                                </div>
                                <div class="mb-1 form-group col-md-7">
                                    <label class="col-form-label">Tiêu đề <span
                                            class="text-danger fw-900">*</span></label>
                                    <input type="text" class="form-control" required name="name">
                                </div>
                            </div>
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Mô tả</label>
                                <textarea name="description" id="ckeditor" rows="3" class="form-control"></textarea>
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
                                <label class="col-form-label">Tiêu đề</label>
                                <input type="text" placeholder="Nhập tiêu đề" class="form-control" name="name_en">
                            </div>
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Mô tả</label>
                                <textarea name="description_en" id="ckeditor_en" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-ch" role="tabpanel" aria-labelledby="nav-ch-tab"
                            tabindex="0">
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Tiêu đề</label>
                                <input type="text" placeholder="Nhập tiêu đề" class="form-control"
                                    name="name_ch">
                            </div>
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Mô tả</label>
                                <textarea name="description_ch" id="ckeditor_ch" rows="3" class="form-control"></textarea>
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

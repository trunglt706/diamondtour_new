<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
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
                    <div class="mb-1 form-group">
                        <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                        <input type="text" class="form-control" required name="name">
                    </div>
                    <div class="mb-1 form-group">
                        <label class="col-form-label">Mô tả</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="my-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" value="active" type="checkbox" role="switch"
                                id="switch_status" checked>
                            <label class="form-check-label" for="switch_status">
                                Kích hoạt
                            </label>
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

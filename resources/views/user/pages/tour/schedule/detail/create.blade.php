<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.schedule_detail.insert') }}" id="form-create" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="schedule_id" value="{{ $data->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tạo mới chi tiết lịch trình</h1>
                    <span>
                        <small class="pe-2">
                            Các trường có dấu <span class="text-danger fw-900">*</span></label> là bắt buộc
                        </small>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </span>
                </div>
                <div class="modal-body px-4 py-1">
                    <div class="mb-1 form-group">
                        <label class="col-form-label">Tiêu đề <span class="text-danger fw-900">*</span></label>
                        <input type="text" class="form-control" required name="name">
                    </div>
                    <div class="mb-1 form-group">
                        <label class="col-form-label">Mô tả</label>
                        <textarea class="form-control" id="description" placeholder="Nội dung mô tả" rows="8" name="description"></textarea>
                    </div>
                    <div class="mb-1 mt-3 form-group">
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

<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.tour_group.insert') }}" id="form-create" method="POST" enctype="multipart/form-data">
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
                    <div class="mb-1 form-group">
                        <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                        <input type="text" placeholder="Tên nhóm" class="form-control" required name="name">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <img src="{{ asset('user/img/user/no-avatar.jpg') }}"
                            class="img-thumbnail preview w-80px h-70px" alt="img">
                        <div class="form-group w-100 ps-3">
                            <label class="col-form-label">Hình ảnh</label>
                            <input type="file" class="form-control previewImg" name="image" accept="image/*">
                        </div>
                    </div>
                    <div class="mb-1 form-group">
                        <label class="col-form-label">Mô tả</label>
                        <textarea class="form-control" placeholder="Nội dung mô tả" rows="2" name="description"></textarea>
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

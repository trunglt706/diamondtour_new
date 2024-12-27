<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.tour_library.insert') }}" id="form-create" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="group_id" value="{{ $data['tour']->id }}">
            <input type="hidden" name="type" value="tour">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Thêm mới thư viện</h1>
                    <span>
                        <small class="pe-2">
                            Các trường có dấu <span class="text-danger fw-900">*</span></label> là bắt buộc
                        </small>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </span>
                </div>
                <div class="modal-body px-4 py-1">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                                <input type="text" placeholder="Tên ảnh" class="form-control" required
                                    name="name">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-1 form-group">
                                <label class="col-form-label">Thứ tự ưu tiên</label>
                                <input type="number" placeholder="Tự sinh" min="0" class="form-control"
                                    name="numering">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <img src="{{ asset('user/img/user/no-avatar.jpg') }}"
                            class="img-thumbnail preview w-80px h-70px" alt="img">
                        <div class="form-group w-100 ps-3">
                            <label class="col-form-label">Hình ảnh</label>
                            <input type="file" class="form-control previewImg" name="image" accept="image/*">
                        </div>
                    </div>
                    <div class="form-check form-switch mt-1">
                        <input class="form-check-input" name="status" value="active" type="checkbox" role="switch"
                            id="switch_status" checked>
                        <label class="form-check-label" for="switch_status">
                            Kích hoạt
                        </label>
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

<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('user.review.insert') }}" id="form-create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tạo mới review</h1>
                    <span>
                        <small class="pe-2">
                            Các trường có dấu <span class="text-danger fw-900">*</span></label> là bắt buộc
                        </small>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </span>
                </div>
                <div class="modal-body px-4 py-1">
                    <div class="row">
                        <div class="mb-1 form-group col-md-6">
                            <label class="col-form-label">Họ tên <span class="text-danger fw-900">*</span></label>
                            <input type="text" class="form-control" required name="user_name">
                        </div>
                        <div class="col-md-6 mb-1 form-group">
                            <label class="col-form-label">Chức vụ <span class="text-danger fw-900">*</span></label>
                            <input type="text" class="form-control" required name="name" value="Du khách">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="col-form-label">
                                Điểm đến <small class="fst-italic">(Nếu không chọn, sẽ hiển thị tại trang chủ)</small>
                            </label>
                            <select name="destination_id" class="form-select destination_id">

                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <img src="{{ asset('user/img/user/no-avatar.jpg') }}"
                                    class="img-thumbnail preview w-80px h-70px" alt="img">
                                <div class="form-group w-100 ps-3">
                                    <label class="col-form-label">Ảnh đại diện</label>
                                    <input type="file" class="form-control previewImg" name="user_avatar"
                                        accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1 form-group">
                        <label class="col-form-label">Nội dung</label>
                        <textarea class="form-control" placeholder="Nội dung review" rows="2" name="content"></textarea>
                    </div>
                    <div class="my-3 d-flex justify-content-between">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" value="active" type="checkbox" role="switch"
                                id="switch_status" checked>
                            <label class="form-check-label" for="switch_status">
                                Kích hoạt
                            </label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="important" value="1" type="checkbox"
                                role="switch" id="switchimportant">
                            <label class="form-check-label" for="switchimportant">Ưu tiên</label>
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

<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.tour_calendar.insert') }}" id="form-create" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tạo mới lịch khởi hành</h1>
                    <span>
                        <small class="pe-2">
                            Các trường có dấu <span class="text-danger fw-900">*</span></label> là bắt buộc
                        </small>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </span>
                </div>
                <div class="modal-body px-4 py-1">
                    <div class="mb-1 form-group">
                        <label class="col-form-label">Tour <span class="text-danger fw-900">*</span></label>
                        <select name="tour_id" class="form-select tour_id">

                        </select>
                    </div>
                    <div class="row">
                        <div class="mb-1 form-group col-md-6">
                            <label class="col-form-label">Đơn giá</label>
                            <input type="text" class="form-control" placeholder="VD: 2000000" name="price">
                        </div>
                        <div class="mb-1 form-group col-md-6">
                            <label class="col-form-label">Còn trống</label>
                            <input type="number" class="form-control" placeholder="VD: 100" name="empty"
                                min="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="col-form-label">Bắt đầu <span class="text-danger fw-900">*</span></label>
                            <input type="date" class="form-control" name="start">
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="col-form-label">Kết thúc <span class="text-danger fw-900">*</span></label>
                            <input type="date" class="form-control" name="end">
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <label class="col-form-label">Mô tả</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="my-3 d-flex justify-content-between">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" value="active" type="checkbox" role="switch"
                                id="switch_status" checked>
                            <label class="form-check-label" for="switch_status">
                                Đang nhận khách
                            </label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="display" value="1" type="checkbox" role="switch"
                                id="switch_display" checked>
                            <label class="form-check-label" for="switch_display">
                                Hiển thị lịch
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

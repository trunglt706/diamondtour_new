<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.user.insert') }}" id="form-create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tạo mới quản trị viên</h1>
                    <span>
                        <small class="pe-2">
                            Các trường có dấu <span class="text-danger fw-900">*</span></label> là bắt buộc
                        </small>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </span>
                </div>
                <div class="modal-body px-4 py-1">
                    <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-uppercase" id="basic-tab" data-bs-toggle="tab"
                                data-bs-target="#basic-tab-pane" type="button" role="tab"
                                aria-controls="basic-tab-pane" aria-selected="true">
                                <i class="fas fa-info-circle"></i> Liên hệ
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-uppercase" id="account-tab" data-bs-toggle="tab"
                                data-bs-target="#account-tab-pane" type="button" role="tab"
                                aria-controls="account-tab-pane" aria-selected="false">
                                <i class="far fa-user-circle"></i> Tài khoản
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active show-img" id="basic-tab-pane" role="tabpanel"
                            aria-labelledby="basic-tab" tabindex="0">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                                <input type="text" placeholder="Tên quản trị" class="form-control" name="name">
                            </div>
                            <div class="row">
                                <div class="form-group mb-2 col-md-6">
                                    <label class="col-form-label">Email <span
                                            class="text-danger fw-900">*</span></label>
                                    <input type="email" placeholder="VD: admn@gmail.com" class="form-control"
                                        name="email">
                                </div>
                                <div class="form-group mb-2 col-md-6">
                                    <label class="col-form-label">Điện thoại</label>
                                    <input placeholder="VD: 0909000999" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="my-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="status" value="active" type="checkbox"
                                        role="switch" id="switch_status">
                                    <label class="form-check-label" for="switch_status">
                                        Kích hoạt
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-tab-pane" role="tabpanel" aria-labelledby="account-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label class="col-form-label">Mật khẩu <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password">
                                            <span role="button" class="input-group-text show-password">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label class="col-form-label">Nhập lại mật khẩu <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="confirm_password">
                                            <span role="button" class="input-group-text show-password">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-long-arrow-alt-left"></i> Thoát
                    </button>
                    <button type="submit" class="btn save-button bg-gradient-cyan-blue btn-create text-white">
                        <i class="fas fa-plus"></i> Tạo mới
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

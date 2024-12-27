<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="hide-mobile">Lịch sử hoạt động <span class="total-item">(0)</span></div>
        <form action="" id="form-filter">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="type" value="user">
            <div class="d-flex justify-content-between">
                <div class="me-1">
                    {!! generate_limit_select() !!}
                </div>
                <div class="me-1 w-135px">
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" name="date" style="height: 34px;"
                            placeholder="Chọn ngày">
                        <label class="input-group-text text-primary" for="datepicker-start">
                            <i class="fa fa-calendar"></i>
                        </label>
                    </div>
                </div>
                <button type="submit" data-type="filter" data-bs-toggle="tooltip" title="Tải lại dữ liệu"
                    class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-primary btn-reload">
                    <i class="fas fa-sync"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="card-body py-4 table-responsive table-loading">
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 bg-light-primary">
                    <th class="text-center w-50px">#</th>
                    <th class="text-center w-150px hide-mobile">Thời gian</th>
                    <th class="text-center w-150px hide-mobile">Ip address</th>
                    <th class="text-center">Nội dung</th>
                </tr>
            </thead>
            <tbody id="load-table" class="text-gray-600 fw-semibold">
                <tr>
                    <td colspan="4" class="text-center empty-data">
                        <div class="text-center">
                            <i class="fas fa-sad-cry fs-s2"></i> Không có dữ liệu
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--end::Card body-->
</div>
@push('js')
    @include('user.pages.user.profile.script.history')
@endpush

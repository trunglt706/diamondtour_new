@extends('user.default')
@section('title', 'Danh sách nhật ký')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="hide-mobile">Danh sách nhật ký <span class="total-item">(0)</span></h5>
        <div class="btn-group" role="group">
            <a href="{{ route('user.user.index') }}" class="btn btn-secondary">
                Quản trị viên
            </a>
            <a href="{{ route('user.log_action.index') }}" class="btn btn-primary">
                Nhật ký
            </a>
        </div>
    </div>
    <div class="card card-header-actions">
        <form action="" id="form-filter">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="d-flex justify-content-start">
                    <input name="search" type="text" class="form-control w-200px ps-13 me-1"
                        placeholder="Nhấn enter để tìm ...">
                    {!! generate_limit_select() !!}
                </div>
                <div class="d-flex justify-content-end hide-mobile">
                    <div class="me-1 w-200px">
                        <select name="user_id" class="form-select filter-user_id form-filter">

                        </select>
                    </div>
                    <div class="me-1 w-135px">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" value="{{ now()->format('d-m-Y') }}"
                                name="date" style="height: 34px;" placeholder="Chọn ngày">
                            <label class="input-group-text text-primary" for="datepicker-start">
                                <i class="fa fa-calendar"></i>
                            </label>
                        </div>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="submit" data-type="filter" data-bs-toggle="tooltip" title="Tải lại dữ liệu"
                            class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-primary btn-reload">
                            <i class="fas fa-sync"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!--end::Card header-->
        </form>
        <!--begin::Card body-->
        <div class="card-body py-4 table-responsive table-loading">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 bg-light-primary">
                        <th class="text-center w-50px">#</th>
                        <th class="text-center w-200px hide-mobile">Quản trị viên</th>
                        <th class="text-center w-150px hide-mobile">Thời gian</th>
                        <th class="text-center w-100px hide-mobile">Ip</th>
                        <th class="text-center">Nội dung</th>
                    </tr>
                </thead>
                <tbody id="load-table" class="text-gray-600 fw-semibold">
                    <tr>
                        <td colspan="5" class="text-center empty-data">
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
@endsection
@push('js')
    <script>
        const routeList = "{{ route('user.log_action.list') }}";

        initSelect2('.filter-user_id', "-- Quản trị viên --", 'users');

        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            "setDate": new Date(),
            "autoclose": true,
            todayHighlight: true
        });

        $('.datepicker').on('change', function() {
            $('#form-filter').submit();
        });

        filterTable();

        function filterTable(currentPage = 1) {
            loadTable(routeList, currentPage);
        };
    </script>
@endpush

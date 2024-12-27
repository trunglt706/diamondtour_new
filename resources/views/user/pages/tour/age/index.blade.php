@extends('user.default')
@section('title', 'Độ tuổi')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="hide-mobile">Độ tuổi <span class="total-item">(0)</span></h5>
        <div class="btn-group hide-mobile">
            <a href="{{ route('user.tour.index') }}" class="btn btn-secondary me-1">
                Tour
            </a>
            <a href="{{ route('user.tour_group.index') }}" class="btn btn-secondary me-1">
                Danh mục
            </a>
            <a href="{{ route('user.tour_age.index') }}" class="btn btn-primary me-1">
                Độ tuổi
            </a>
            <a href="{{ route('user.tour_service.index') }}" class="btn btn-secondary me-1">
                Dịch vụ
            </a>
            <a href="{{ route('user.tour_object.index') }}" class="btn btn-secondary me-1">
                Đối tượng
            </a>
            <a href="{{ route('user.tour_balance.index') }}" class="btn btn-secondary me-1">
                Ngân sách
            </a>
            <a href="{{ route('user.tour_style.index') }}" class="btn btn-secondary me-1">
                Phong cách
            </a>
            <a href="{{ route('user.tour_design.index') }}" class="btn btn-secondary me-1">
                Thiết kế tour
            </a>
            <a href="{{ route('user.tour_calendar.index') }}" class="btn btn-secondary me-1">
                Lịch khởi hành
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
                    <div class="me-1 w-150px">
                        <select name="status" class="form-select filter-status form-filter select-picker">
                            <option value="" selected>-- Trạng thái --</option>
                            @foreach ($data['status'] as $key => $item)
                                <option value="{{ $key }}">{{ $item[0] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="submit" data-type="filter" data-bs-toggle="tooltip" title="Tải lại dữ liệu"
                            class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-primary btn-reload">
                            <i class="fas fa-sync"></i>
                        </button>
                        <button type="button" id="btnAddModal" class="btn btn-trigger btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addModal">
                            <i class="fas fa-plus"></i> Tạo
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
                        <th class="text-center w-125px">#</th>
                        <th class="text-center">Tên</th>
                        <th class="text-center w-125px hide-mobile">Trạng thái</th>
                    </tr>
                </thead>
                <tbody id="load-table" class="text-gray-600 fw-semibold">
                    <tr>
                        <td colspan="3" class="text-center empty-data">
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
    @include('user.pages.tour.age.create')
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('user.tour_age.update') }}" id="form-update" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Cập nhật dữ liệu</h1>
                        <span>
                            <small class="pe-2">
                                Các trường có dấu <span class="text-danger fw-900">*</span></label> là bắt buộc
                            </small>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </span>
                    </div>
                    <div class="modal-body px-4 py-1 content-update">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-long-arrow-alt-left"></i> Thoát
                        </button>
                        <button type="submit" class="btn bg-gradient-cyan-blue btn-create text-white">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const routeList = "{{ route('user.tour_age.list') }}";

        filterTable();

        function filterTable(currentPage = 1) {
            loadTable(routeList, currentPage);
        };

        function confirmDelete(id) {
            deleteData(id, "{{ route('user.tour_age.delete') }}");
        }

        $(document).ready(function() {
            $(document).on("click", ".data-item", function(e) {
                showSniper(".table-loading");
                e.preventDefault();
                const url = $(this).attr('href');
                $.get(url, function(data) {
                    hideSniper(".table-loading");
                    $('.content-update').html(data);
                    $('#editModal').modal('show');
                })
            })
        })
    </script>
@endpush

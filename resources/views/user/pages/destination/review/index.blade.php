@extends('user.default')
@section('title', 'Danh sách reviews')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="hide-mobile">Danh dách reviews <span class="total-item">(0)</span></h5>
        <div class="btn-group">
            <a href="{{ route('user.destination.index') }}" class="btn btn-secondary me-1">
                Điểm đến
            </a>
            <a href="{{ route('user.destination_group.index') }}" class="btn btn-secondary me-1">
                Danh mục
            </a>
            <a href="{{ route('user.review.index') }}" class="btn btn-primary me-1">
                Reviews
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-primary">
                <div class="d-flex justify-content-between text-white">
                    Tổng reviews
                    <span>{{ $data['total'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-danger">
                <div class="d-flex justify-content-between text-white">
                    Review tại trang chủ
                    <span>{{ $data['home'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-secondary">
                <div class="d-flex justify-content-between">
                    Review điểm đến
                    <span>{{ $data['destination'] }}</span>
                </div>
            </div>
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
                    <div class="me-1 w-300px">
                        <select name="destination_id" class="form-select filter-destination_id form-filter">

                        </select>
                    </div>
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
                        <th class="text-center w-200px">Họ tên</th>
                        <th class="text-center w-300px hide-mobile">Điểm đến</th>
                        <th class="text-center w-125px hide-mobile">Trạng thái</th>
                        <th class="text-center hide-mobile">Nội dung</th>
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
    @include('user.pages.destination.review.create')
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('user.review.update') }}" id="form-update" method="POST" enctype="multipart/form-data">
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
        const routeList = "{{ route('user.review.list') }}";
        initSelect2('.filter-destination_id', "-- Điểm đến --", 'destinations');
        initSelect2('#addModal .destination_id', "-- Điểm đến --", 'destinations', '#addModal');
        filterTable();

        function filterTable(currentPage = 1) {
            loadTable(routeList, currentPage);
        };

        function confirmDelete(id) {
            deleteData(id, "{{ route('user.review.delete') }}");
        }

        $(document).ready(function() {
            $(document).on("click", ".data-item", function(e) {
                showSniper(".table-loading");
                e.preventDefault();
                const url = $(this).attr('href');
                $.get(url, function(data) {
                    hideSniper(".table-loading");
                    $('.content-update').html(data);
                    initSelect2('#editModal .destination_id', "-- Điểm đến --", 'destinations',
                        '#editModal');
                    $('#editModal').modal('show');
                })
            })
        })
    </script>
@endpush

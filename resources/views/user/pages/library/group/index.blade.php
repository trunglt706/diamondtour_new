@extends('user.default')
@section('title', 'Danh mục thư viện')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="hide-mobile">Danh mục thư viện <span class="total-item">(0)</span></h5>
        <div class="btn-group">
            <a href="{{ route('user.library.index') }}" class="btn btn-secondary me-1">
                Thư viện
            </a>
            <a href="{{ route('user.library_group.index') }}" class="btn btn-primary me-1">
                Danh mục
            </a>
            <a href="{{ route('user.video.index') }}" class="btn btn-secondary me-1">
                Thước phim yêu thích
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-success">
                <div class="d-flex justify-content-between text-white">
                    Tổng danh mục
                    <span>{{ $data['total'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-info">
                <div class="d-flex justify-content-between text-white">
                    Danh mục hot
                    <span>{{ $data['hot'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-warning">
                <div class="d-flex justify-content-between text-white">
                    Danh mục là của khách
                    <span>{{ $data['guest'] }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 mb-2 text-danger">
            Tour mùa xuân: <span>{{ $data['total_mua_xua'] }}</span>
        </div>
        <div class="col-md-3 mb-2 text-primary">
            Tour mùa hạ: <span>{{ $data['total_mua_ha'] }}</span>
        </div>
        <div class="col-md-3 mb-2 text-success">
            Tour mùa thu: <span>{{ $data['total_mua_thu'] }}</span>
        </div>
        <div class="col-md-3 mb-2">
            Tour mùa đông: <span>{{ $data['total_mua_dong'] }}</span>
        </div>
    </div>
    <div class="card card-header-actions">
        <form action="" id="form-filter">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="d-flex justify-content-start">
                    <input name="search" type="text" class="form-control w-200px ps-13 me-1"
                        placeholder="Nhấn enter để tìm ...">
                    {{-- {!! generate_limit_select() !!} --}}
                </div>
                <div class="d-flex justify-content-end hide-mobile">
                    <div class="me-1 w-200px">
                        <select name="tour_group_id" class="form-select filter-tour_group_id form-filter">

                        </select>
                    </div>
                    <div class="me-1 w-125px">
                        <select name="season" class="form-select filter-season form-filter select-picker">
                            <option value="" selected>-- Theo mùa --</option>
                            @foreach ($data['seasons'] as $key => $item)
                                <option value="{{ $key }}">{{ $item[0] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="me-1 w-150px">
                        <select name="guest" class="form-select filter-guest form-filter select-picker">
                            <option value="" selected>-- Của khách --</option>
                            <option value="0">Không đúng</option>
                            <option value="1">Đúng</option>
                        </select>
                    </div>
                    <div class="me-1 w-125px">
                        <select name="hot" class="form-select filter-hot form-filter select-picker">
                            <option value="" selected>-- Hot --</option>
                            <option value="0">Không đúng</option>
                            <option value="1">Đúng</option>
                        </select>
                    </div>
                    <div class="me-1 w-125px">
                        <select name="important" class="form-select filter-important form-filter select-picker">
                            <option value="" selected>-- Ưu tiên --</option>
                            @foreach ($data['important'] as $key => $item)
                                <option value="{{ $key }}">{{ $item[0] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="me-1 w-125px">
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
                        <th class="text-center w-175px hide-mobile">SL ảnh</th>
                        <th class="text-center w-100px hide-mobile">Ưu tiên</th>
                        <th class="text-center w-100px hide-mobile">Hot</th>
                        <th class="text-center w-100px hide-mobile">Của khách</th>
                        <th class="text-center w-125px hide-mobile">Trạng thái</th>
                    </tr>
                </thead>
                <tbody id="load-table" class="text-gray-600 fw-semibold">
                    <tr>
                        <td colspan="7" class="text-center empty-data">
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
    @include('user.pages.library.group.create')
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('user.library_group.update') }}" id="form-update" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Cập nhật dữ liệu</h1>
                        <span>
                            <small class="pe-2">
                                Các trường có dấu <span class="text-danger fw-900">*</span></label> là bắt buộc
                            </small>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
        initSelect2('.filter-tour_group_id', "-- Thuộc nhóm --", 'tour_groups');
        initSelect2('#addModal .filter-tour_group_id', "-- Thuộc nhóm --", 'tour_groups', '#addModal');
        const routeList = "{{ route('user.library_group.list') }}";

        filterTable();

        function filterTable(currentPage = 1) {
            loadTable(routeList, currentPage);
        };

        function confirmDelete(id) {
            deleteData(id, "{{ route('user.library_group.delete') }}");
        }

        $(document).ready(function() {
            $(document).on("click", ".data-item", function(e) {
                showSniper(".table-loading");
                e.preventDefault();
                const url = $(this).attr('href');
                $.get(url, function(data) {
                    hideSniper(".table-loading");
                    $('.content-update').html(data);
                    initSelect2('#editModal .filter-tour_group_id', "-- Thuộc nhóm --",
                        'tour_groups',
                        '#editModal');
                    $('#editModal').modal('show');
                })
            })
        })
    </script>
@endpush

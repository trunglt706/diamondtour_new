@extends('user.default')
@section('title', 'Danh sách tour')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="hide-mobile">Danh sách tour <span class="total-item">(0)</span></h5>
        <div class="btn-group hide-mobile">
            <a href="{{ route('user.tour.index') }}" class="btn btn-primary me-1">
                Tour
            </a>
            <a href="{{ route('user.tour_group.index') }}" class="btn btn-secondary me-1">
                Danh mục
            </a>
            <a href="{{ route('user.tour_age.index') }}" class="btn btn-secondary me-1">
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
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-primary">
                <div class="d-flex justify-content-between text-white">
                    Tổng tours
                    <span>{{ $data['total_tours'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-danger">
                <div class="d-flex justify-content-between text-white">
                    Tổng landtours
                    <span>{{ $data['total_landtours'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-secondary">
                <div class="d-flex justify-content-between">
                    Tổng tour thiết kế
                    <span>{{ $data['total_designs'] }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-success">
                <div class="d-flex justify-content-between text-white">
                    Tour trải nghiệm
                    <span>{{ $data['total_bundle1'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-info">
                <div class="d-flex justify-content-between text-white">
                    Tour bạn thân
                    <span>{{ $data['total_bundle2'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-warning">
                <div class="d-flex justify-content-between text-white">
                    Tour tri kỷ
                    <span>{{ $data['total_bundle3'] }}</span>
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
                        <select name="group_id" class="form-select filter-group_id form-filter">

                        </select>
                    </div>
                    <div class="me-1 w-175px">
                        <select name="country_id" class="form-select filter-country_id form-filter">

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
                        <a href="{{ route('user.tour.create') }}" type="button" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tạo
                        </a>
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
                        <th class="text-center w-100px">#</th>
                        <th class="text-center">Tour</th>
                        <th class="text-center w-150px hide-mobile">Giá</th>
                        <th class="text-center w-175px hide-mobile">Quốc gia</th>
                        <th class="text-center w-100px hide-mobile">Ưu tiên</th>
                        <th class="text-center w-175px hide-mobile">Thời gian</th>
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
@endsection
@push('js')
    <script>
        initSelect2('.filter-group_id', "-- Danh mục --", 'tour_groups');
        initSelect2('.filter-country_id', "-- Quốc gia --", 'countries');
        const routeList = "{{ route('user.tour.list') }}";

        filterTable();

        function filterTable(currentPage = 1) {
            loadTable(routeList, currentPage);
        };

        function confirmDelete(id) {
            deleteData(id, "{{ route('user.tour.delete') }}");
        }
    </script>
@endpush

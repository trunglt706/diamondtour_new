@extends('user.default')
@section('title', 'Danh sách điểm đến')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="hide-mobile">Danh sách điểm đến <span class="total-item">(0)</span></h5>
        <div class="btn-group">
            <a href="{{ route('user.destination.index') }}" class="btn btn-primary me-1">
                Điểm đến
            </a>
            <a href="{{ route('user.destination_group.index') }}" class="btn btn-secondary me-1">
                Danh mục
            </a>
            <a href="{{ route('user.review.index') }}" class="btn btn-secondary me-1">
                Reviews
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-primary">
                <div class="d-flex justify-content-between text-white">
                    Tổng điểm đến
                    <span>{{ $data['total'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-danger">
                <div class="d-flex justify-content-between text-white">
                    Theo quốc gia
                    <span>{{ $data['country'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card card-body bg-secondary">
                <div class="d-flex justify-content-between">
                    Theo khu vực
                    <span>{{ $data['province'] }}</span>
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
                    <div class="me-1 w-150px div_country_id d-none">
                        <select name="country_id" class="form-select filter-country_id form-filter">

                        </select>
                    </div>
                    <div class="me-1 w-200px">
                        <select name="group_id" class="form-select filter-group_id form-filter">

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
                    <div class="me-1 w-150px">
                        <select name="type" class="form-select filter-type form-filter select-picker">
                            <option value="" selected>-- Phân loại --</option>
                            @foreach ($data['type'] as $key => $item)
                                <option value="{{ $key }}">{{ $item[0] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="submit" data-type="filter" data-bs-toggle="tooltip" title="Tải lại dữ liệu"
                            class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-primary btn-reload">
                            <i class="fas fa-sync"></i>
                        </button>
                        <a href="{{ route('user.destination.create') }}" type="button" class="btn btn-primary">
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
                        <th class="text-center">Điểm đến</th>
                        <th class="text-center w-200px hide-mobile">Danh mục</th>
                        <th class="text-center w-100px hide-mobile">Loại</th>
                        <th class="text-center w-100px hide-mobile">Ưu tiên</th>
                        <th class="text-center w-175px hide-mobile">Ngày đăng</th>
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
        initSelect2('.filter-group_id', "-- Danh mục --", 'destination_groups');
        initSelect2('.filter-country_id', "-- Quốc gia --", 'countries');
        const routeList = "{{ route('user.destination.list') }}";

        filterTable();

        function filterTable(currentPage = 1) {
            loadTable(routeList, currentPage);
        };

        function confirmDelete(id) {
            deleteData(id, "{{ route('user.destination.delete') }}");
        }

        $('.filter-type').on('change', function() {
            const data = $(this).val();
            if (data != 'local') {
                $('.div_country_id').addClass('d-none');
            } else {
                $('.div_country_id').removeClass('d-none');
            }
        })
    </script>
@endpush

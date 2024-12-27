@extends('user.default')
@section('title', 'Menu')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="hide-mobile">Menu <span class="total-item">(0)</span></h5>
        <a href="{{ route('user.setting.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
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
                        <th class="text-center w-50px">#</th>
                        <th class="text-center w-300px">Tên</th>
                        <th class="text-center w-100px hide-mobile">Liên kết</th>
                        <th class="text-center hide-mobile">Mô tả</th>
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
    @include('user.pages.setting.menu.create')
@endsection
@push('js')
    <script>
        const routeList = "{{ route('user.menu.list') }}";

        filterTable();

        function filterTable(currentPage = 1) {
            loadTable(routeList, currentPage);
        };
    </script>
@endpush

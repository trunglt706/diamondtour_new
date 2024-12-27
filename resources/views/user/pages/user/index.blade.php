@extends('user.default')
@section('title', 'Quản trị viên')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="hide-mobile">Quản trị viên <span class="total-item">(0)</span></h5>
        <div class="btn-group" role="group">
            <a href="{{ route('user.user.index') }}" class="btn btn-primary">
                Quản trị viên
            </a>
            <a href="{{ route('user.log_action.index') }}" class="btn btn-secondary">
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
                        <th class="text-center w-100px">#</th>
                        <th class="text-center w-150px hide-mobile">Mã</th>
                        <th class="text-center">Tên</th>
                        <th class="text-center w-200px hide-mobile">Email</th>
                        <th class="text-center w-200px hide-mobile">Điện thoại</th>
                        <th class="text-center w-125px hide-mobile">Trạng thái</th>
                        <th class="text-center w-175px hide-mobile">Last login</th>
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
    @include('user.pages.user.create')
@endsection
@push('js')
    <script>
        const routeList = "{{ route('user.user.list') }}";

        filterTable();

        function filterTable(currentPage = 1) {
            loadTable(routeList, currentPage);
        };

        function confirmDelete(id) {
            deleteData(id, "{{ route('user.user.delete') }}");
        }
    </script>
@endpush

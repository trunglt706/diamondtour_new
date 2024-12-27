@extends('user.default')
@section('title', 'Danh sách bài tham dự')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="hide-mobile">Danh sách bài tham dự <span class="total-item">(0)</span></h5>
            <a href="{{ route('user.event.detail', ['id' => $data['event']->id]) }}">
                ({{ $data['event']->title }})
            </a>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('user.event.detail', ['id' => $data['event']->id]) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>
    <div class="card card-header-actions">
        <form action="" id="form-filter">
            <input type="hidden" name="event_id" value="{{ $data['event']->id }}">
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
                        <a href="{{ route('user.event_submission.create') }}?event_id={{ $data['event']->id }}"
                            type="button" class="btn btn-primary">
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
                        <th class="text-center">Người tham dự</th>
                        <th class="text-center">Chức vụ</th>
                        <th class="text-center w-175px hide-mobile">Thời gian</th>
                        <th class="text-center w-125px hide-mobile">Trạng thái</th>
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
        const routeList = "{{ route('user.event_submission.list') }}";

        filterTable();

        function filterTable(currentPage = 1) {
            loadTable(routeList, currentPage);
        };

        function confirmDelete(id) {
            deleteData(id, "{{ route('user.event_submission.delete') }}");
        }
    </script>
@endpush

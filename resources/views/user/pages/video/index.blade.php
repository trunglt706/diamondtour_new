@extends('user.default')
@section('title', 'Thước phim yêu thích')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="hide-mobile">Thước phim yêu thích <span class="total-item">(0)</span></h5>
        <div class="btn-group">
            <a href="{{ route('user.library.index') }}" class="btn btn-secondary me-1">
                Thư viện
            </a>
            <a href="{{ route('user.library_group.index') }}" class="btn btn-secondary me-1">
                Danh mục
            </a>
            <a href="{{ route('user.video.index') }}" class="btn btn-primary me-1">
                Thước phim yêu thích
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
                </div>
                <div class="d-flex justify-content-end hide-mobile">
                    <div class="me-1 w-125px">
                        <select name="status" class="form-select filter-status form-filter select-picker">
                            <option value="" selected>-- Trạng thái --</option>
                            @foreach ($data['video_status'] as $key => $item)
                                <option value="{{ $key }}">{{ $item[0] }}</option>
                            @endforeach
                        </select>
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
                        <th class="text-center">Danh mục tour</th>
                        <th class="text-center">Tên thước phim</th>
                        <th class="text-center w-200px hide-mobile">Url</th>
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
    <div class="mt-2">
        <b><u>Hướng dẫn lấy url video từ youtube</u></b>
        <div class="alert alert-info" role="alert">
            <ul>
                <li>
                    B1: Mở đường dẫn youtube bằng trình duyệt web
                </li>
                <li>
                    B2: Phía dưới mỗi video sẽ có nút "Chia sẽ", click vào
                </li>
                <li>
                    B3: Sao chép giá trị trong thẻ src trong đoạn script ở trên, có dạng như sau:
                    "https://www.youtube.com/embed/DvPhlS6E64Y?si=mxTSeTu1F0QjKU94"
                </li>
            </ul>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form action="{{ route('user.video.update') }}" id="form-update" method="POST" enctype="multipart/form-data">
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
        const routeList = "{{ route('user.video.list') }}";

        filterTable();

        function filterTable(currentPage = 1) {
            loadTable(routeList, currentPage);
        };

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

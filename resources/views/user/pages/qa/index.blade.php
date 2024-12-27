@extends('user.default')
@section('title', 'Câu hỏi thường gặp')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="hide-mobile">Câu hỏi thường gặp <span class="total-item">(0)</span></h5>
        <div class="btn-group">
            <a href="{{ route('user.setting.index') }}" class="btn btn-secondary me-1">
                Cài đặt
            </a>
            <a href="{{ route('user.qa.index') }}" class="btn btn-primary me-1">
                Câu hỏi thường gặp
            </a>
            <a href="{{ route('user.qa_group.index') }}" class="btn btn-secondary me-1">
                Danh mục
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
                    <div class="me-1 w-300px">
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
                        <th class="text-center">Tiêu đề</th>
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
    @include('user.pages.qa.create')
@endsection
@push('js')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        const routeList = "{{ route('user.qa.list') }}";
        initSelect2('.filter-group_id', "-- Danh mục --", 'qa_groups');
        initSelect2('#addModal .filter-group_id', "-- Chọn --", 'qa_groups', '#addModal');

        filterTable();

        function filterTable(currentPage = 1) {
            loadTable(routeList, currentPage);
        };

        function confirmDelete(id) {
            deleteData(id, "{{ route('user.qa.delete') }}");
        }

        $(document).ready(function() {
            CKEDITOR.replace('ckeditor', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });
            CKEDITOR.replace('ckeditor_en', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });
            CKEDITOR.replace('ckeditor_ch', {
                height: 280,
                toolbar: 'Full',
                filebrowserBrowseUrl: "{{ route('user.upload_editor') }}",
                filebrowserImageBrowseUrl: "{{ route('user.upload_editor') . '?type=Images' }}",
                filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            });

            $(document).on('click', 'button[type="submit"]', function() {
                $('#editor').val(editor.getData());
                $('#editor_en').val(editor.getData());
                $('#editor_ch').val(editor.getData());
            })
        })
    </script>
@endpush

@php
    $album = $data->album ? json_decode($data->album) : [];
@endphp
@extends('user.default')
@section('title', 'Thông tin blog')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="hide-mobile">Post: #{{ $data->code }} {!! $data->hot ? '<span class="text-danger">(HOT)</span>' : '' !!}</h6>
        <div class="btn-group" role="group">
            <a href="{{ route('user.blog.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <a href="{{ route('user.blog.edit', ['id' => $data->id]) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Cập nhật
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 d-flex">
            <ul class="list-group w-100 me-3">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Mã:
                    <span>{{ $data->code }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Tiêu đề:
                    <span>{{ $data->name }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Độ ưu tiên:
                    <span>
                        {{ $data->important > 0 ? $data->important : '-' }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Bài viết yêu thích:
                    <span>
                        {{ $data->like_total > 0 ? 'Đúng' : 'Không đúng' }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Tiêu điểm trong tuần:
                    <span>
                        {{ $data->tieu_diem ? 'Đúng' : 'Không đúng' }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Đề tài nóng:
                    <span>
                        {{ $data->hot > 0 ? 'Đúng' : 'Không đúng' }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Danh mục:
                    <span>
                        @if ($data->group)
                            <a href="{{ route('user.blog_group.detail', ['id' => $data->group_id]) }}"
                                class="text-decoration-none">
                                {{ $data->group->name }}
                            </a>
                        @else
                            -
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Trạng thái:
                    <span
                        class="badge bg-{{ $status[1] }} text-{{ $status[1] }} bg-opacity-15 px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                        <i class="fa fa-circle text-{{ $status[1] }} fs-9px fa-fw me-5px"></i> {{ $status[0] }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Thời gian tạo:
                    <span>
                        {{ $data->created_at ? date('H:i:s d/m/Y', strtotime($data->created_at)) : '-' }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Cập nhật lần cuối:
                    <span>
                        {{ $data->updated_at ? date('H:i:s d/m/Y', strtotime($data->updated_at)) : '-' }}
                    </span>
                </li>
                <li class="list-group-item">
                    <div class="mb-2">
                        <u>- Album:</u> <small class="fst-italic text-danger">(nắm kéo hình ảnh để thay đổi vị trí)</small>
                    </div>
                    <div>
                        @foreach ($album as $item)
                            <img draggable="true" src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $item ? get_file($item) : asset('user/img/user/no-avatar.jpg') }}"
                                class="draggable img-thumbnail preview w-80px h-70px img-album" loading="lazy" alt="img">
                        @endforeach
                    </div>
                </li>
                <li class="list-group-item">
                    <u>- Mô tả:</u>
                    <div>{!! $data->description !!}</div>
                </li>
                <li class="list-group-item">
                    <u>- Nội dung:</u>
                    <div>{!! $data->content !!}</div>
                </li>
            </ul>
            <div>
                <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $data->image ? get_file($data->image) : asset('user/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail preview w-100px" loading="lazy" alt="img">
                <hr>
                <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $data->background ? get_file($data->background) : asset('user/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail w-100px" loading="lazy" alt="img">
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            let draggedItem = null;

            $(document).on('dragstart', '.draggable', function(event) {
                draggedItem = $(this);
            });

            $(document).on('dragover', function(event) {
                event.preventDefault();
            });

            $(document).on('drop', '.img-album', function(event) {
                event.preventDefault();
                if (draggedItem !== null) {
                    const items = $('.img-album');
                    const draggedIndex = items.index(draggedItem);
                    const targetIndex = items.index($(this));

                    // Hoán đổi vị trí của hai phần tử trong DOM
                    if (draggedIndex !== -1 && targetIndex !== -1) {
                        swapItem(draggedIndex, targetIndex);
                        if (draggedIndex < targetIndex) {
                            $(this).after(draggedItem);
                        } else {
                            $(this).before(draggedItem);
                        }
                        draggedItem = null;
                    }
                }
            });

            function swapItem(draggedIndex, targetIndex) {
                $.post("{{ route('user.blog.updateAlbum') }}", {
                    id: "{{ $data->id }}",
                    draggedIndex: draggedIndex,
                    targetIndex: targetIndex
                }, function(rs) {
                    Toast.fire({
                        icon: rs?.type,
                        title: rs.message,
                    });
                });
            }
        });
    </script>
@endpush

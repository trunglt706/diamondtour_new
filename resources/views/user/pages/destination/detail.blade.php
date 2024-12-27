@php
    use App\Models\Destination;
    $status = Destination::get_status($data->status);
    $type = Destination::get_type($data->type);
    $album = $data->album ? json_decode($data->album) : [];
@endphp
@extends('user.default')
@section('title', 'Thông tin điểm đến')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="hide-mobile">Điểm đến: #{{ $data->code }}</h6>
        <div class="btn-group" role="group">
            <a href="{{ route('user.destination.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <a href="{{ route('user.destination.edit', ['id' => $data->id]) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Cập nhật
            </a>
        </div>
    </div>
    <div class="row">
        @if ($data->type == 'national')
            <div class="col-lg-4 mb-2">
                <h5 class="text-uppercase">Danh sách điểm đến khu vực ({{ $list->count() }})</h5>
                <ul class="list-group w-100 me-3">
                    @if ($list && $list->count() > 0)
                        @foreach ($list as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div style="max-width: 70%">
                                    <a class="text-decoration-none"
                                        href="{{ route('user.destination.detail', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                </div>
                                <div>({{ $item->province_name }})</div>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item">
                            Chưa có dữ liệu!
                        </li>
                    @endif
                </ul>
                <div class="mt-3">
                    <b><u>Lưu ý:</u></b>
                    <div class="alert alert-warning" role="alert">
                        <ul>
                            <li>
                                Để bổ sung điểm đến "thuộc khu vực" vào điểm đến "thuộc quốc gia". Trước tiên phải cấu hình
                                "khu vực" đó phải thuộc "quốc gia" đang chọn.
                            </li>
                            <li>
                                Truy cập vào mục "Khác" => <a
                                    href="{{ route('user.province.index') }}?country_id={{ $data->country_id }}">"Khu
                                    vực"</a> và lọc
                                tên quốc gia hiện tại để xem có khu vực nào thuộc hay chưa
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-{{ $data->type == 'national' ? '8' : '12' }} col-sm-12 mb-2 d-flex">
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
                    - Danh mục:
                    <span>
                        @if ($data->group)
                            <a href="{{ route('user.destination_group.detail', ['id' => $data->group_id]) }}"
                                class="text-decoration-none">
                                {{ $data->group->name }}
                            </a>
                        @else
                            -
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Địa chỉ:
                    <span>{{ $data->address }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Loại:
                    <div>
                        <span
                            class="badge bg-{{ $type[1] }} text-{{ $type[1] }} bg-opacity-15 px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                            {{ $type[0] }}
                        </span>
                        -
                        @if ($data->country)
                            <span>{{ $data->country->name }}</span>
                        @endif
                        @if ($data->province)
                            <span>{{ $data->province->name }}</span>
                        @endif
                    </div>
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
                            <img draggable="true" src="{{ $item ? get_url($item) : asset('user/img/user/no-avatar.jpg') }}"
                                class="draggable img-thumbnail preview w-80px h-70px img-album" alt="img">
                        @endforeach
                    </div>
                </li>
                <li class="list-group-item">
                    <u>- Mô tả điểm đến:</u>
                    <div>{!! $data->description !!}</div>
                </li>
                <li class="list-group-item">
                    <u>- Mô tả địa chỉ:</u>
                    <div>{!! $data->content !!}</div>
                </li>
            </ul>
            <div class="hide-mobile">
                <img src="{{ $data->image ? get_url($data->image) : asset('user/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail preview w-100px" alt="img">
                <hr>
                <img src="{{ $data->background ? get_url($data->background) : asset('user/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail w-100px" alt="img">
                <hr>
                <img src="{{ $data->image_description ? get_url($data->image_description) : asset('user/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail w-100px" alt="img">
                <hr>
                <img src="{{ $data->image_content ? get_url($data->image_content) : asset('user/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail w-100px" alt="img">
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
                $.post("{{ route('user.destination.updateAlbum') }}", {
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

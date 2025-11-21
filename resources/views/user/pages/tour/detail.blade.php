@extends('user.default')
@section('title', 'Thông tin tour')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="hide-mobile">Tour: #{{ $data->code }}</h6>
        <div class="btn-group" role="group">
            <a href="{{ route('user.tour.index') }}" class="btn btn-secondary hide-mobile">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <a href="{{ route('user.tour.edit', ['id' => $data->id]) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Cập nhật
            </a>
            <a href="{{ route('user.tour_library.index') }}?id={{ $data->id }}"
                class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-primary">
                <i class="fas fa-photo-video"></i> Album ảnh
            </a>
            <a href="{{ route('user.schedule.index') }}?id={{ $data->id }}"
                class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-primary">
                <i class="far fa-calendar-check"></i> Lịch trình
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-2">
            <div class="card card-body bg-primary">
                <div class="d-flex justify-content-between text-white">
                    Tổng số albums
                    <span>{{ $report['albums'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="card card-body bg-danger">
                <div class="d-flex justify-content-between text-white">
                    Tổng số lịch trình
                    <span>{{ $report['schedules'] }}</span>
                </div>
            </div>
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
                    - Đơn giá:
                    <span>{{ number_format($data->price) }} {{ $data->currency }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Thời gian:
                    <span>{{ $data->duration }} (Từ {{ $data->from }} đến {{ $data->to }})</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Danh mục:
                    <span>
                        @if ($data->group)
                            <a href="{{ route('user.tour_group.detail', ['id' => $data->group_id]) }}"
                                class="text-decoration-none">
                                {{ $data->group->name }}
                            </a>
                        @else
                            -
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Theo mùa:
                    <span>
                        @if ($data->season)
                            @php
                                $season = Tour::get_season($data->season);
                            @endphp
                            {{ $season[0] }}
                        @else
                            -
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Số khách:
                    <span>{{ $data->guest }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Hoạt động chính:
                    <span>{{ $data->activity }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Ngôn ngữ:
                    <span>{{ $data->language }}</span>
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
                    <u>- Mô tả:</u>
                    <div>{!! $data->description !!}</div>
                </li>
                <li class="list-group-item">
                    <u>- Nội dung:</u>
                    <div>{!! $data->content !!}</div>
                </li>
            </ul>
            <div>
                <div>
                    @php
                        $route = route('tour.detail', ['alias' => $data->slug]);
                    @endphp
                    <div id="qrcode">
                        {!! \DNS2D::getBarcodeHTML($route, 'QRCODE', 4, 4) !!}
                    </div>
                    <button class="btn btn-primary w-100 mt-1" id="download"
                        data-code="{{ $data->code }}">Download</button>
                </div>
                <hr>
                <img src="{{ $data->image ? get_file($data->image) : asset('user/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail preview w-100px" alt="img">
                <hr>
                <img src="{{ $data->background ? get_file($data->background) : asset('user/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail w-100px" alt="img">
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/html2canvas.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#download').click(function() {
                const code = $(this).data('code');
                html2canvas(document.getElementById('qrcode')).then(function(canvas) {
                    // Tạo URL cho hình ảnh từ canvas
                    var imgData = canvas.toDataURL('image/png');

                    // Tạo một thẻ <a> ẩn để tải hình ảnh
                    var link = document.createElement('a');
                    link.href = imgData;
                    link.download = code + '.png';

                    // Thêm thẻ <a> vào document và kích hoạt sự kiện click để tải xuống
                    document.body.appendChild(link);
                    link.click();

                    // Xóa thẻ <a> sau khi hoàn tất
                    document.body.removeChild(link);
                });
            });
        });
    </script>
@endpush

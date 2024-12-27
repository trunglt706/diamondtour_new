@php
    use App\Models\EventSubmissions;
    $status = EventSubmissions::get_status($data->status);
@endphp
@extends('user.default')
@section('title', 'Thông tin bài tham dự')
@section('content')
    {!! $data->script !!}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h6 class="hide-mobile">Bài tham dự: #{{ $data->id }}</h6>
            <a href="{{ route('user.event.detail', ['id' => $data->event->id]) }}">
                ({{ $data->event->title }})
            </a>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('user.event_submission.index') }}?event_id={{ $data->event_id }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <a href="{{ route('user.event_submission.edit', ['id' => $data->id]) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Cập nhật
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 d-flex">
            <ul class="list-group w-100 me-3">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Mã số:
                    <span>{{ $data->id }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Người tham dự:
                    <span>{{ $data->name }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    - Chức vụ:
                    <span>{{ $data->position }}</span>
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
                <img src="{{ $data->image ? get_url($data->image) : asset('user/img/user/no-avatar.jpg') }}"
                    class="img-thumbnail preview w-100px" alt="img">
            </div>
        </div>
    </div>
@endsection

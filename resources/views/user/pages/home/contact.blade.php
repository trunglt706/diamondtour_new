@if ($list->count() > 0)
    <ul class="list-group">
        @foreach ($list as $item)
            <li class="list-group-item">
                <a href="{{ route('user.contact.detail', ['id' => $item->id]) }}"
                    class="d-flex justify-content-between align-items-center">
                    {{ $item->name }} ({{ $item->phone }})
                    <span class="badge bg-light rounded-pill text-dark">
                        {{ $item->created_at ? date('H:i:s d/m/Y', strtotime($item->created_at)) : '' }}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
@else
    <div class="align-items-center d-flex justify-content-center flex-column h-100">
        <i class="fas fa-virus-slash fs-2"></i>
        <div>Không có dữ liệu</div>
    </div>
@endif

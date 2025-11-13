@php
    use App\Models\Review;
@endphp
@if ($list->count() > 0)
    @php
        $paginate = $list->appends(request()->all())->links();
    @endphp
    @foreach ($list as $item)
        @php
            $status = Review::get_status($item->status);
        @endphp
        <tr id="tr-{{ $item->id }}">
            <td class="text-center">
                <button data-bs-toggle="tooltip" title="Xóa" class="btn bg-gradient-orange-red btn-sm btn-delete"
                    onclick="confirmDelete('{{ $item->id }}')">
                    <i class="fas fa-trash text-white"></i>
                </button>
                <a data-bs-toggle="tooltip" title="Xem chi tiết"
                    href="{{ route('user.review.detail', ['id' => $item->id]) }}"
                    class="btn bg-gradient-custom-indigo btn-sm">
                    <i class="fas fa-eye"></i>
                </a>
                <a data-bs-toggle="tooltip" title="Cập nhật"
                    href="{{ route('user.review.detail', ['id' => $item->id]) }}"
                    class="btn bg-gradient bg-gray-200 btn-sm data-item">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td>
                <img src="{{ get_url($item->user_avatar) }}" class="img-fluid w-20px h-20px" alt="Image">
                {{ $item->user_name }}
            </td>
            <td class="text-center hide-mobile">
                @if ($item->destination_id)
                    <a href="{{ route('user.destination.detail', ['id' => $item->destination_id]) }}"
                        class="text-decoration-none">
                        {{ $item->destination->name }}
                    </a>
                @else
                    -
                @endif
            </td>
            <td class="text-center hide-mobile">
                <span
                    class="badge bg-{{ $status[1] }} text-{{ $status[1] }} bg-opacity-15 px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                    <i class="fa fa-circle text-{{ $status[1] }} fs-9px fa-fw me-5px"></i> {{ $status[0] }}
                </span>
            </td>
            <td class="hide-mobile">
                {!! $item->content !!}
            </td>
        </tr>
    @endforeach
    @if ($paginate != '')
        <tr>
            <td colspan="5">
                <div class="mt-2">
                    {{ $paginate }}
                </div>
            </td>
        </tr>
    @endif
@else
    <tr>
        <td colspan="5" class="text-center empty-data">
            <i class="fas fa-sad-cry fs-s2"></i> Không có dữ liệu
        </td>
    </tr>
@endif

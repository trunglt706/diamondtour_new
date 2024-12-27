@php
    use App\Models\TourCalendar;
@endphp
@if ($list->count() > 0)
    @php
        $paginate = $list->appends(request()->all())->links();
    @endphp
    @foreach ($list as $item)
        @php
            $status = TourCalendar::get_status($item->status);
        @endphp
        <tr id="tr-{{ $item->id }}">
            <td class="text-center">
                <button data-bs-toggle="tooltip" title="Xóa" class="btn bg-gradient-orange-red btn-sm btn-delete"
                    onclick="confirmDelete('{{ $item->id }}')">
                    <i class="fas fa-trash text-white"></i>
                </button>
                <a data-bs-toggle="tooltip" title="Xem chi tiết"
                    href="{{ route('user.tour_calendar.detail', ['id' => $item->id]) }}"
                    class="btn bg-gradient-custom-indigo btn-sm">
                    <i class="fas fa-eye"></i>
                </a>
                <a data-bs-toggle="tooltip" title="Cập nhật"
                    href="{{ route('user.tour_calendar.detail', ['id' => $item->id]) }}"
                    class="btn bg-gradient bg-gray-200 btn-sm data-item">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td>
                <a href="{{ route('user.tour.detail', ['id' => $item->tour_id]) }}" class="text-decoration-none">
                    {{ $item->tour ? $item->tour->name : '-' }}
                </a>
            </td>
            <td class="text-center hide-mobile">
                {{ $item->start ? date('d/m/Y', strtotime($item->start)) : 'Đang cập nhật' }}
            </td>
            {{-- <td class="text-center hide-mobile">
                {{ $item->end ? date('d/m/Y', strtotime($item->end)) : 'Đang cập nhật' }}
            </td> --}}
            {{-- <td class="text-center hide-mobile">
                {{ $item->price ? $item->price : 'Đang cập nhật' }}
            </td> --}}
            <td class="text-center hide-mobile">
                {{ $item->empty ? number_format($item->empty) : 'Đang cập nhật' }}
            </td>
            <td class="text-center hide-mobile">
                <span
                    class="badge bg-{{ $status[1] }} text-{{ $status[1] }} bg-opacity-15 px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                    {{ $status[0] }}
                </span>
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

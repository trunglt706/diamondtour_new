@php
    use App\Models\Destination;
@endphp
@if ($list->count() > 0)
    @php
        $paginate = $list->appends(request()->all())->links();
    @endphp
    @foreach ($list as $item)
        @php
            $status = Destination::get_status($item->status);
            $type = Destination::get_type($item->type);
        @endphp
        <tr id="tr-{{ $item->id }}">
            <td class="text-center">
                <button data-bs-toggle="tooltip" title="Xóa" class="btn bg-gradient-orange-red btn-sm btn-delete"
                    onclick="confirmDelete('{{ $item->id }}')">
                    <i class="fas fa-trash text-white"></i>
                </button>
                <a data-bs-toggle="tooltip" title="Xem chi tiết"
                    href="{{ route('user.destination.detail', ['id' => $item->id]) }}"
                    class="btn bg-gradient-custom-indigo btn-sm">
                    <i class="fas fa-eye"></i>
                </a>
            </td>
            <td>
                <img src="{{ asset('style/images/blank-sm.jpg') }}" data-src="{{ get_file($item->image) }}" loading="lazy" class="img-fluid w-30px h-20px" alt="Image">
                {{ $item->name }}
            </td>
            <td class="text-center hide-mobile">
                @if ($item->group)
                    <a href="{{ route('user.destination_group.detail', ['id' => $item->group_id]) }}"
                        class="text-decoration-none">
                        {{ $item->group->name }}
                    </a>
                @else
                    -
                @endif
            </td>
            <td class="text-center hide-mobile">
                <span
                    class="badge bg-{{ $type[1] }} text-{{ $type[1] }} bg-opacity-15 px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                    {{ $type[0] }}
                </span>
            </td>
            <td class="text-center hide-mobile">
                {{ $item->important > 0 ? $item->important : '' }}
            </td>
            <td class="text-center hide-mobile">
                {{ date('H:i:s d/m/Y', strtotime($item->created_at)) }}
            </td>
            <td class="text-center hide-mobile">
                <span
                    class="badge bg-{{ $status[1] }} text-{{ $status[1] }} bg-opacity-15 px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                    <i class="fa fa-circle text-{{ $status[1] }} fs-9px fa-fw me-5px"></i> {{ $status[0] }}
                </span>
            </td>
        </tr>
    @endforeach
    @if ($paginate != '')
        <tr>
            <td colspan="7">
                <div class="mt-2">
                    {{ $paginate }}
                </div>
            </td>
        </tr>
    @endif
@else
    <tr>
        <td colspan="7" class="text-center empty-data">
            <i class="fas fa-sad-cry fs-s2"></i> Không có dữ liệu
        </td>
    </tr>
@endif

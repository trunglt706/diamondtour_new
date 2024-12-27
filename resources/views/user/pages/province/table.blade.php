@if ($list->count() > 0)
    @php
        $paginate = $list->appends(request()->all())->links();
    @endphp
    @foreach ($list as $item)
        <tr id="tr-{{ $item->id }}">
            <td class="text-center">
                @if ($item->destinations_count == 0)
                    <button data-bs-toggle="tooltip" title="Xóa" class="btn bg-gradient-orange-red btn-sm btn-delete"
                        onclick="confirmDelete('{{ $item->id }}')">
                        <i class="fas fa-trash text-white"></i>
                    </button>
                @endif
                <a data-bs-toggle="tooltip" title="Xem chi tiết"
                    href="{{ route('user.province.detail', ['id' => $item->id]) }}"
                    class="btn bg-gradient-custom-indigo btn-sm">
                    <i class="fas fa-eye"></i>
                </a>
                <a data-bs-toggle="tooltip" title="Cập nhật"
                    href="{{ route('user.province.detail', ['id' => $item->id]) }}"
                    class="btn bg-gradient bg-gray-200 btn-sm data-item">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td>
                {{ $item->name }}
            </td>
            <td class="text-center">
                {{ $item->country ? $item->country->name : '-' }}
            </td>
        </tr>
    @endforeach
    @if ($paginate != '')
        <tr>
            <td colspan="3">
                <div class="mt-2">
                    {{ $paginate }}
                </div>
            </td>
        </tr>
    @endif
@else
    <tr>
        <td colspan="3" class="text-center empty-data">
            <i class="fas fa-sad-cry fs-s2"></i> Không có dữ liệu
        </td>
    </tr>
@endif

@php
    use App\Models\Menu;
@endphp
@if ($list->count() > 0)
    @php
        $paginate = $list->appends(request()->all())->links();
    @endphp
    @foreach ($list as $item)
        <tr id="tr-{{ $item->id }}">
            <td class="text-center">
                <a data-bs-toggle="tooltip" title="Xem chi tiết"
                    href="{{ route('user.menu.detail', ['id' => $item->id]) }}"
                    class="btn bg-gradient-custom-indigo btn-sm">
                    <i class="fas fa-eye"></i>
                </a>
            </td>
            <td>
                <img src="{{ get_url($item->background) }}" class="img-fluid w-30px h-20px" alt="">
                {{ $item->name }}
            </td>
            <td class="text-center hide-mobile">
                <a target="_blank" href="{{ $item->link ?? '#' }}" class="text-decoration-none">Tại đây</a>
            </td>
            <td class="hide-mobile">
                {{ $item->description }}
            </td>
        </tr>
    @endforeach
    @if ($paginate != '')
        <tr>
            <td colspan="4">
                <div class="mt-2">
                    {{ $paginate }}
                </div>
            </td>
        </tr>
    @endif
@else
    <tr>
        <td colspan="4" class="text-center empty-data">
            <i class="fas fa-sad-cry fs-s2"></i> Không có dữ liệu
        </td>
    </tr>
@endif

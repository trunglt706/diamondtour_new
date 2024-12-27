@if ($list->count() > 0)
    @php
        $paginate = $list->appends(request()->all())->links();
    @endphp
    @foreach ($list as $item)
        <tr id="tr-{{ $item->id }}">
            <td class="text-center">
                <a data-bs-toggle="tooltip" title="Xem chi tiết"
                    href="{{ route('user.log_action.detail', ['id' => $item->id]) }}"
                    class="btn bg-gradient-custom-indigo btn-sm">
                    <i class="fas fa-eye"></i>
                </a>
            </td>
            <td class="text-center hide-mobile">
                @if ($item->user)
                    <a class="text-decoration-none" href="{{ route('user.user.detail', ['id' => $item->user_id]) }}">
                        {{ $item->user->name }}
                    </a>
                @else
                    -
                @endif
            </td>
            <td class="text-center hide-mobile">
                {{ $item->created_at ? date('H:i:s d/m/Y', strtotime($item->created_at)) : '-' }}
            </td>
            <td class="text-center hide-mobile">
                {{ $item->ip }}
            </td>
            <td class="max-content">
                {!! $item->description !!}
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

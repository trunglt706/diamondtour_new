<div class="widget_tour_1">
    <div class="container">
        <div class="header-title header-title-style-3">
            <p class="header">{{ $item ? __('messages.tour.diem_den_theo_quoc_gia') : __('messages.tour.list') }}</p>
            {{-- <a class="read-more" href="">@lang('messages.xem_them')<span> &#x279D;</span></a> --}}
        </div>
        <div class="row">
            @foreach ($data['tours'] as $tour)
                @php
                    $_url = $item
                        ? route('demo.destination.detail', ['slug' => $tour->slug])
                        : route('demo.tour.detail', ['slug' => $tour->slug]);
                @endphp
                <div class="col-md-4 col-12">
                    <div class="tour-item">
                        <div class="img">
                            <a href="{{ $_url }}">
                                <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $tour->image ? get_file($tour->image) : asset('/style/images/post/butan.png') }}"
                                    alt="Image" loading="lazy" height="293px" width="416px">
                            </a>
                        </div>
                        <div class="title">
                            <div class="list-icon-share justify-content-between">
                                <a href="/">
                                    <i class="fas fa-calendar-week"></i>
                                    {{ $item->from ? date('d/m/Y', strtotime($item->from)) : __('messages.dang_cap_nhat') }}
                                </a>
                                <a href="/" class="vnd">
                                    {{ $item->price ? number_format($item->price) . 'Đ' : __('messages.dang_cap_nhat') }}
                                </a>
                            </div>
                            <div class="top">
                                <h3 class="header-tour-detail">
                                    <a href="{{ $_url }}">{{ get_data_lang($tour, 'name') }}</a>
                                </h3>
                                <a class="btn-read-more" href="{{ $_url }}">@lang('messages.view_now') ></a>
                            </div>
                            <div class="list-icon-share">
                                <a href="/">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $item->country_name ?? __('messages.dang_cap_nhat') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 text-center">
            {!! $data['tours']->appends(request()->all())->links() !!}
        </div>
    </div>
</div>

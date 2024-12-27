<section>
    <div class="box-discovery">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4">
                    <div class="block-discovery-content">
                        <h2>@lang('messages.hay_bat_dau_kham_pha')</h2>
                        <p>@lang('messages.cung_di_xa')</p>
                        <a href="{{ route('tour.index') }}" class="btn btn-more">@lang('messages.xem_them')</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="block-discovery-list">
                        <div class="row gx-3 gy-3 gx-lg-5 gy-lg-5">
                            @foreach ($data['tours'] as $item)
                                <div class="col-sm-6">
                                    <a href="{{ route('tour.detail', ['alias' => $item->slug]) }}"
                                        class="discovery-tour-item"
                                        style="background-image: url({{ get_url($item->image) }})">
                                        <h3>{{ $item->name }}</h3>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

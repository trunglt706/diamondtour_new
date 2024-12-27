<section>
    <div class="box-discovery-home">
        <div class="discovery-home--header">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 gx-4">
                    <div class="col">
                        <h2>@lang('messages.dao_qua_nhung_diem_den_noi_bat')</h2>
                    </div>
                    <div class="col">
                        <p>
                            @lang('messages.chiem_nguong_canh_quan')
                        </p>
                        <a href="{{ route('destination.index') }}" class="btn btn-more">@lang('messages.xem_them')</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-portfolio-gallery-container">
            <div class="row-items row row-cols-2 row-cols-md-5 g-0">
                @foreach ($data['destination'] as $index => $item)
                    @php
                        $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                        $_item_name = $item->$item_name ?? $item->name;
                    @endphp
                    <div class="col">
                        <div class="discovery-home-item" data-tab="portfolio-gallery-tab-{{ ++$index }}">
                            <div class="-content">
                                <p>@lang('messages.visit')</p>
                                <h2>{{ $_item_name }}</h2>
                            </div>
                            <div class="-content-more">
                                <a href="{{ route('destination.detail', ['alias' => $item->slug]) }}">
                                    @lang('messages.xem_them')
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="gallery-items">
                @foreach ($data['destination'] as $index => $item)
                    <div id="portfolio-gallery-tab-{{ ++$index }}" class="image-item"
                        data-background="{{ get_url($item->image) }}"
                        style="background-image:url({{ get_url($item->image) }});"></div>
                @endforeach
            </div>
        </div>
        @include('pages.blocks.testimonial')
    </div>
</section>

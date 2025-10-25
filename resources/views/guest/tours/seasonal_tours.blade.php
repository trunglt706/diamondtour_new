@php
    $t = isset($data['t']) ? $data['t'] : 0;
@endphp
@if ($data['seasonal_tours']->count() > 0)
    <div class="seasonal_tours js_widget_builder js_widget_post_style_1_3 widget_post_style_1 bg-isolation">
        <div class="container">
            <div class="row">
                <div class="box-content col-md-4">
                    <div class="header-title header-title-style-1">
                        <p class="header-text-top">@lang('messages.home.nhung_noi_de_di')</p>
                        <p class="header">@lang('messages.home.tour_theo_mua')</p>
                    </div>
                    <p class="description">
                        @lang('messages.home.tour_theo_mua_des')
                    </p>
                    <div class="box-item">
                        <div class="header-item font-Lora-Bold">
                            @lang('messages.home.diamond_tour_de_xuat')
                        </div>
                        <br><br>
                        <div class="row">
                            <a href="{{ route('demo.tour.category', ['slug' => 'season']) }}?q=xuan"
                                class="col-md-5 col-12 item">
                                <p type="button" class="text-title item-season" data-item="xuan">@lang('messages.home.mua_xuan')</p>
                            </a>
                            <a href="{{ route('demo.tour.category', ['slug' => 'season']) }}?q=ha"
                                class="col-md-5 col-12 item">
                                <p type="button" class="text-title item-season" data-item="ha">@lang('messages.home.mua_ha')</p>
                            </a>
                            <a href="{{ route('demo.tour.category', ['slug' => 'season']) }}?q=thu"
                                class="col-md-5 col-12 item">
                                <p type="button" class="text-title item-season" data-item="thu">@lang('messages.home.mua_thu')</p>
                            </a>
                            <a href="{{ route('demo.tour.category', ['slug' => 'season']) }}?q=dong"
                                class="col-md-5 col-12 item">
                                <p type="button" class="text-title item-season" data-item="dong">@lang('messages.home.mua_dong')</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-img col-md-8">
                    @foreach ($data['seasonal_tours'] as $item)
                        <a href="{{ route('demo.tour.detail', ['slug' => $item->slug]) }}?t={{ $t }}"
                            class="img hover-opacity-7 pointer">
                            <img src="{{ $item->image ? asset($item->image) : asset('/style/images/banner/Rectangle 206.png') }}"
                                alt="Image" height="442px" width="266px" loading="lazy">
                            <p class="img-title">
                                {{ get_data_lang($item, 'name') }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

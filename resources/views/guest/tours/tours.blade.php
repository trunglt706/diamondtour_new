@if ($data['tours']->count() > 0)
    <div class="js_widget_builder js_widget_post_style_1_2 widget_post_style_1">
        <div class="container">
            <div class="header-title header-title-style-1">
                <p class="header">@lang('messages.home.sap_cot_loi')</p>
                <p class="header-text-bottom">@lang('messages.home.cua_chung_toi')</p>
            </div>
            <div class="box-content">
                <div class="post">
                    <div class="row g-2">
                        @foreach ($data['tours'] as $item)
                            @php
                                $t = isset($data['t']) ? $data['t'] : 0;
                                $_url = route('demo.tour.category', ['slug' => $item->slug]) . '?t=' . $t;
                            @endphp
                            <div class="col-md-3 col-12">
                                <div class="item item-post-horizontal wow animated fadeIn">
                                    <div class="img">
                                        <a href="{{ $_url }}">
                                            <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $item->image ? get_file($item->image) : asset('user/img/user/no-avatar.jpg') }}"
                                                alt="Image" loading="lazy" height="190px" width="318px">
                                        </a>
                                    </div>
                                    <div class="title">
                                        <div class="schedule">
                                            <div class="time-trip">
                                                <i class="fa-regular fa-calendar"></i><span>{{ $item->days }}
                                                    @lang('messages.time.day')</span>
                                            </div>
                                            <div class="number-user">
                                                <i class="fa-regular fa-user"></i><span>{{ $item->personals }}</span>
                                            </div>
                                            <div class="rate">
                                                @for ($i = 0; $i < $item->starts; $i++)
                                                    <img src="{{ asset('/style/images/icon/Group.png') }}"
                                                        alt="star" loading="lazy" height="13px" width="14px">
                                                @endfor
                                            </div>
                                        </div>
                                        <h3 class="header">
                                            <a href="{{ $_url }}">
                                                {{ get_data_lang($item, 'name') }}
                                            </a>
                                        </h3>
                                        <div class="description">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <span>{{ $item->country ? $item->country->name : '(' . __('messages.dang_cap_nhat') . ')' }}</span>
                                        </div>
                                        <div class="read-more">
                                            <a href="{{ $_url }}">
                                                @lang('messages.trai_nghiem') <i class="fa-solid fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

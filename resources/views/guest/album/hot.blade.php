@if ($data['hot']->count() > 0)
    <div class="js_widget_builder widget_album_style_1">
        <div class="container">
            <div class="row">
                <div class="controls">
                    <button class=" button-prev">
                        <svg width="50" height="24" viewBox="0 0 50 24" fill="none" xmlns="/www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.656006 11C-0.606846 11 0.274555 12.4168 0.656006 12.837L10.8721 23.6848C11.2536 24.1051 11.872 24.1051 12.2535 23.6848C12.6349 23.2646 12.6349 22.5833 12.2535 22.1631L3.7048 13.1521H49.0232C49.5627 13.1521 50 12.6704 50 12.0761C50 11.4818 49.5627 11.0001 49.0232 11.0001H3.7048C3.7048 11.0001 0.858303 11 0.656006 11Z"
                                fill="white" />
                        </svg>
                    </button>
                    <button class=" button-next">
                        <svg width="50" height="24" viewBox="0 0 50 24" fill="none"
                            xmlns="/www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M49.344 13C50.6068 13 49.7254 11.5832 49.344 11.163L39.1279 0.315165C38.7464 -0.105054 38.128 -0.105054 37.7465 0.315165C37.3651 0.735383 37.3651 1.41669 37.7465 1.83691L46.2952 10.8479H0.976766C0.437313 10.8479 0 11.3296 0 11.9239C0 12.5182 0.437313 12.9999 0.976766 12.9999H46.2952C46.2952 12.9999 49.1417 13 49.344 13Z"
                                fill="white" />
                        </svg>
                    </button>
                </div>
                <div class=" mySwiper col-md-7 col-12">
                    <div class="swiper-wrapper">
                        @foreach ($data['hot'] as $item)
                            <div class="swiper-slide">
                                <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $item->image ? get_file($item->image) : asset('/style/images/banner/vikings-cosplay-2023-11-27-05-26-16-utc 1.png') }}"
                                    alt="Image 1" loading="lazy">
                            </div>
                        @endforeach
                        <!-- Add more slides as needed -->
                    </div>
                </div>
                <div class="swiper myContentSwiper col-md-5 col-12">
                    <div class="swiper-wrapper">
                        @foreach ($data['hot'] as $item)
                            @php
                                $_url = route('library.detail', ['slug' => $item->slug]);
                            @endphp
                            <div class="swiper-slide">
                                <div class="content">
                                    <div class="tag-title">
                                        <span>[</span>
                                        <p>@lang('messages.album.album_hot')</p><span>]</span>
                                    </div>
                                    <h2 class="title">{{ get_data_lang($item, 'name') }}</h2>
                                    <p class="description">
                                        {{ $item->description }}
                                    </p>
                                    <div class="list-item">
                                        <div class="item">
                                            <div class="icon">
                                                <img src="{{ asset('/style/images/icon/_x31_2.png') }}" alt="Image">
                                            </div>
                                            <div class="content-item">
                                                <p class="title">@lang('messages.album.address')</p>
                                                <p class="date">{{ $item->address ?? __('messages.dang_cap_nhat') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="icon">
                                                <img src="{{ asset('/style/images/icon/date.png') }}" alt="Image">
                                            </div>
                                            <div class="content-item">
                                                <p class="title">@lang('messages.album.time')</p>
                                                <p class="date">{{ $item->date ?? __('messages.dang_cap_nhat') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <a class="read-more" href="{{ $_url }}">@lang('messages.album.view_album')
                                        <span>&#x279D;</span></a>
                                </div>
                            </div>
                        @endforeach
                        <!-- Add more slides as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

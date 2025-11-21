@if ($data['likes'])
    @php
        $item = $data['likes'];
        $_url = route('library.detail', ['slug' => $item->slug]);
    @endphp
    <div class="widget_about_style_3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="content">
                        <div class="tag-title">
                            <span>[</span>
                            <p>@lang('messages.album.album_yeu_thich')</p><span>]</span>
                        </div>
                        <h2 class="title">{{ $item->name }}</h2>
                        <p class="description">
                            {{ $item->description }}
                        </p>
                        <div class="date-time">
                            <p class="date">{{ $item->date ?? __('messages.dang_cap_nhat') }}</p>
                            <p class="time">@lang('messages.home.admin')</p>
                        </div>
                        <div>
                            <a class="read-more" href="{{ $_url }}">@lang('messages.trai_nghiem')</a>
                        </div>
                    </div>
                </div>
                <div class="imgSwiper col-md-8 col-12">
                    <div class="swiper-wrapper">
                        @foreach ($item->libraries as $img)
                            <div class="swiper-slide">
                                <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ $img->image ? get_file($img->image) : asset('/style/images/banner/poster.png') }}"
                                    alt="Image" loading="lazy">
                            </div>
                        @endforeach
                        <!-- Add more slides as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

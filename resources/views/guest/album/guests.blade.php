@if ($data['guests']->count() > 0)
    <div class="widget_feedback_style_2 js_widget_feedback_style_2_2">
        <div class="container">
            <div class="content">
                <div class="tag-title">
                    <span>[</span>
                    <p>@lang('messages.album.album_guest')</p><span>]</span>
                </div>
                <h2 class="title">@lang('messages.album.album_guest_des')</h2>
            </div>
            <div class="list-feedback">
                <div class="swiper feedbackContentSwiper col-12">
                    <div class="swiper-wrapper">
                        @foreach ($data['guests'] as $item)
                            <div class="swiper-slide">
                                <div class="content">
                                    <div class="title">
                                        <h5>{{ $item->name }}</h2>
                                    </div>
                                    <p>
                                        {{ $item->description }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper feedbackAvaterSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($data['guests'] as $item)
                            <div class="swiper-slide">
                                <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ $item->image ? asset($item->image) : asset('/style/images/banner/vikings-cosplay-2023-11-27-05-26-16-utc 1.png') }}"
                                    alt="Image" loading="lazy" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

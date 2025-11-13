@if ($data['likes']->count() > 0)
    <div class="widget_album_like">
        <div class="container">
            <div class="header-title header-title-style-3">
                <p class="header text-center">@lang('messages.album.album_yeu_thich')</p>
                {{-- <a class="read-more" href="">Xem thêm<span> &#x279D;</span></a> --}}
            </div>
        </div>
        <div class="box-album">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($data['likes'] as $item)
                        <div class="swiper-slide">
                            <div class="tour-item">
                                <div class="img">
                                    <a href="{{ route('demo.library.detail', ['slug' => $item->slug]) }}">
                                        <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ asset('style/images/blank.jpg') }}" data-src="{{ asset($item->image) }}" alt="Image"
                                            loading="lazy">
                                    </a>
                                </div>
                                <div class="title">
                                    <div class="box-left">
                                        <h3 class="header-tour-detail"><a href="">{{ $item->name }}</a></h3>
                                        <div class="list-icon-share">
                                            <a href="#"><i class="fa-solid fa-share-nodes"></i>
                                                @lang('messages.share')</a>
                                            <a href="#"><i class="fa-solid fa-eye"></i> @lang('messages.Views')</a>
                                            <a href="#"><img src="/style/images/icon/Isolation_Mode.png"
                                                    alt="Image"> @lang('messages.comment')</a>
                                        </div>
                                    </div>
                                    {{-- <span class="tag">Chùa SERA</span> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
@endif

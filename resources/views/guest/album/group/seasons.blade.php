@if ($data['seasons']->count() > 0)
    <div class="widget_about_7">
        <div class="container">
            <div class="header-title header-title-style-3">
                <p class="header">@lang('messages.album.diem_den_trong_nha')</p>
            </div>
            <div class="">
                <div class="box-content">
                    <div class="bottom">
                        <div class="swiper-button-prev">
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </div>
                        <div class="swiper-button-next">
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </div>
                    </div>
                </div>
                <div class="box-image">
                    <div class="box-slider-img">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($data['seasons'] as $item)
                                    <div class="swiper-slide">
                                        <div class="img">
                                            <a href="{{ route('demo.library.detail', ['slug' => $item->slug]) }}">
                                                <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ asset($item->image) }}" alt="Image" title=""
                                                    loading="lazy">
                                            </a>
                                        </div>
                                        <h3 class="header-tour-detail"><a href="">{{ $item->name }}</a></h3>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

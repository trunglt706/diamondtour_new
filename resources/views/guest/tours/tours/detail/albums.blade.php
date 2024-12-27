@if ($data['albums']->count() > 0)
    <div class="widget_about_6">
        <div class="container">
            <div class="header-title header-title-style-3">
                <p class="header">@lang('messages.tour.diem_den_yeu_thich')</p>
                {{-- <a class="read-more" href="">Xem tất cả bài viết<span> &#x279D;</span></a> --}}
            </div>
            <div class="row-grid">
                @foreach ($data['albums'] as $key => $album)
                    <div class="img img-{{ ++$key }}">
                        <a data-fancybox="gallery" data-caption="{{ $item->name }}"
                            data-src="{{ asset($album->image) }}">
                            <img src="{{ $album->image ? asset($album->image) : asset('/style/images/banner/z3848305506961_009e59438bffdd018e14a5d5124d841b 1.png') }}"
                                alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

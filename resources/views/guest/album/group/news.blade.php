@php
    $news_count = $data['news']->count();
@endphp
@if ($news_count > 0)
    <div class="widget_tour_style_2">
        <div class="container">
            <div class="header-title header-title-style-3">
                <p class="header">@lang('messages.album.album_moi')</p>
                {{-- <a class="read-more" href="">Xem thêm<span> &#x279D;</span></a> --}}
            </div>
            <div class="box-content">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active" id="item1-content">
                        @foreach ($data['news'] as $key => $item)
                            {!! $key == 0 || $key % 4 == 0 ? '<div class="box-item-image"><div class="row-grid">' : '' !!}

                            <div class="img img-{{ ($key % 4) + 1 }}">
                                <a href="{{ route('demo.library.detail', ['slug' => $item->slug]) }}">
                                    <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ get_file($item->image) }}" alt="Image"
                                        loading="lazy">
                                </a>
                            </div>
                            {!! ($key + 1) % 4 == 0 || $key + 1 == count($data['news']) ? '</div></div>' : '' !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endif

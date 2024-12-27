@if ($data['shares']->count() > 0)
    <div class="widget-blog-style-4">
        <div class="container">
            <div class="header-title">
                <p class="title text-uppercase">@lang('messages.blog.blog_share_nhieu')</p>
                <p class="description">
                    @lang('messages.blog.blog_share_nhieu_des')
                </p>
            </div>
            <div class="list-blogs ">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($data['shares'] as $item)
                            @php
                                $_url = route('demo.blog.detail', ['slug' => $item->slug]);
                            @endphp
                            <div class="item swiper-slide">
                                <div class="box-item">
                                    <div class="img">
                                        <img src="{{ asset($item->image) }}" alt="Image" title=""
                                            loading="lazy" style="">
                                        <div class="list-icon">
                                            <a href="#"><i class="fa-solid fa-share-nodes"></i></a>
                                            <a href="#"><i class="fa-solid fa-comment"></i></a>
                                        </div>
                                    </div>
                                    <div class="title">
                                        <div class="date-type">
                                            <p class="date">
                                                {{ date('d/m/Y', strtotime($item->created_at)) }}
                                            </p>
                                            <p class="type">
                                                {{ get_data_lang($item, 'group_name') }}
                                            </p>
                                        </div>
                                        <p class="title-blogs">
                                            <a href="{{ $_url }}">
                                                {{ get_data_lang($item, 'name') }}
                                            </a>
                                        </p>
                                        <p class="description">
                                            {{ $item->description }}
                                        </p>
                                        <div class="read-more">
                                            <a href="{{ $_url }}">@lang('messages.view_now')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
@endif

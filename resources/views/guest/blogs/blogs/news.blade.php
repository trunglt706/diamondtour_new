@if ($data['news']->count() > 0)
    <div class="widget-blog-style-3">
        <div class="container">
            <div class="header-title">
                <p class="title text-uppercase">@lang('messages.blog.blog_new')</p>
                <p class="description">
                    @lang('messages.blog.blog_new_des')
                </p>
            </div>
            <div class="list-blogs ">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($data['news'] as $item)
                            @php
                                $_url = route('blog.detail', ['slug' => $item->slug]);
                            @endphp
                            <div class="item swiper-slide">
                                <a href="{{ $_url }}">
                                    <div class="img">
                                        <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ get_file($item->image) }}" alt="Image"
                                            loading="lazy">
                                    </div>
                                    <div class="title">
                                        <div class="content">
                                            <p class="date">
                                                {{ date('d/m/Y', strtotime($item->created_at)) }}
                                            </p>
                                            <p class="title-blogs">
                                                {{ get_data_lang($item, 'name') }}
                                            </p>
                                            <p class="description">
                                                {{ $item->description }}
                                            </p>
                                        </div>
                                        <div class="user-info">
                                            <div class="avt">
                                                <img src="/style/images/blogs/File233 1.png" alt="Image"
                                                    loading="lazy">
                                            </div>
                                            <p class="name">@lang('messages.home.admin')</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
@endif

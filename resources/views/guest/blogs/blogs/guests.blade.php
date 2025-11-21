@if ($data['guests']->count() > 0)
    <div class="widget-blog-style-2 bg-grey">
        <div class="container">
            <div class="header-title">
                <p class="title-top">@lang('messages.blog.new_share')</p>
                <p class="title text-uppercase">@lang('messages.blog.from_guest')</p>
                <img src="/style/images/blogs/Line.png" alt="Image" loading="lazy">
            </div>
            <div class="list-blogs ">
                @foreach ($data['guests'] as $item)
                    @php
                        $_url = route('blog.detail', ['slug' => $item->slug]);
                    @endphp
                    <div class="item">
                        <a href="">
                            <div class="img">
                                <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ get_file($item->image) }}" alt="Image" loading="lazy">
                            </div>
                            <div class="title">
                                <div class="user-info">
                                    <div class="avt">
                                        <img src="/style/images/blogs/File233 1.png" alt="Image"
                                            loading="lazy">
                                    </div>
                                    <div class="content">
                                        <p class="name">@lang('messages.blog.khach_vang_lai')</p>
                                        <p class="date">
                                            {{ date('d/m/Y', strtotime($item->created_at)) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="title-blogs">
                                    <p>
                                        {{ get_data_lang($item, 'name') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="navigation">
                <button class="btn number prev">
                    <p><i class="fa-solid fa-angle-left"></i></p>
                </button>
                <div class="list-item">
                    @foreach ($data['guests'] as $key => $item)
                        <div class="number">
                            <p>{{ ++$key }}</p>
                        </div>
                    @endforeach
                </div>
                <button class="btn number next">
                    <p><i class="fa-solid fa-angle-right"></i></p>
                </button>
            </div>
        </div>
    </div>
@endif

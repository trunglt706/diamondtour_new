@if ($data['favorits']->count() > 0)
    @php
        $first = $data['favorits'][0];
        $first_url = route('demo.blog.detail', ['slug' => $first->slug]);
    @endphp
    <div class="post-like">
        <div class="header-title">
            <p class="header">@lang('messages.blog.blog_yeu_thich')</p>
            <div class="img-bg"></div>
            <a class="read-more hide-mobile" href="{{ route('demo.blog.category', ['slug' => 'favorits']) }}">
                @lang('messages.view_all')<span> &#x279D;</span>
            </a>
        </div>
        <div class="row-grid">
            <div class="box-right">
                <div class="js_widget_builder js_widget_post_style_1_8 widget_post_style_1">
                    <div class="">
                        <div class="box-content">
                            <div class="post">
                                <div class="list-post">
                                    @foreach ($data['favorits'] as $key => $item)
                                        @if ($key > 0)
                                            @php
                                                $_url = route('demo.blog.detail', ['slug' => $item->slug]);
                                            @endphp
                                            <div class="col-md-12 col-12">
                                                <div class="item">
                                                    <div class="img">
                                                        <a href="{{ $_url }}">
                                                            <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ $item->image ? asset($item->image) : asset('/style/images/post/butan.png') }}"
                                                                alt="Image" title="" loading="lazy"
                                                                style="">
                                                        </a>
                                                    </div>
                                                    <div class="title">
                                                        <h3 class="header"><a
                                                                href="{{ $_url }}">{{ get_data_lang($item, 'name') }}</a>
                                                        </h3>
                                                        <div class="description show-mobile">{{ $item->description }}
                                                        </div>
                                                        <div class="br show-mobile">
                                                            <div class="line"></div>
                                                            <div class="read-more">
                                                                <a href="{{ $_url }}">
                                                                    <i class="fa-solid fa-angle-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="info">
                                                            <div class="date">
                                                                <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                                            </div>
                                                            <div class="edit">
                                                                <span>@lang('messages.home.admin')</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-left">
                <div class="js_widget_builder hide-mobile js_widget_post_style_1_9 widget_post_style_1">
                    <div class="">
                        <div class="box-content">
                            <div class="post">
                                <div class="list-post">
                                    <div class="col-12">
                                        <div class="item">
                                            <div class="img" style="height: auto !important;">
                                                <a href="{{ $first_url }}">
                                                    <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ $first->image ? asset($first->image) : asset('/style/images/post/main-post.jpg') }}"
                                                        alt="Image" title="" loading="lazy" style="">
                                                </a>
                                            </div>
                                            <div class="title">
                                                <div class="info">
                                                    <div class="date">
                                                        <span>{{ date('d/m/Y', strtotime($first->created_at)) }}</span>
                                                    </div>
                                                    <div class="edit">
                                                        <span>@lang('messages.home.admin')</span>
                                                    </div>
                                                </div>
                                                <h3 class="header"><a
                                                        href="{{ $first_url }}">{{ $first->name }}</a>
                                                </h3>
                                                <div class="description"><a
                                                        href="{{ $first_url }}">{{ $first->description }}</a></div>
                                                <a class="read-more" href="{{ $first_url }}">@lang('messages.view_now')<span>
                                                        &#x279D;</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="read-all show-mobile">
                    <a href="{{ route('demo.blog.category', ['slug' => 'favorits']) }}">
                        @lang('messages.view_all')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

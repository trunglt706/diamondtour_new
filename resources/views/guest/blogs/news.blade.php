@if ($data['news']['left']->count() > 0 || $data['news']['right']->count() > 0)
    <div class="post-new">
        <div class="header-title">
            <p class="header">@lang('messages.blog.blog_new')</p>
            <div class="img-bg"></div>
        </div>
        <div class="row-grid">
            <div class="box-right">
                <div class="js_widget_builder js_widget_post_style_1_6 widget_post_style_1">
                    <div class="">
                        <div class="box-content">
                            <div class="post">
                                <div class="list-post">
                                    @foreach ($data['news']['left'] as $item)
                                        @php
                                            $_url = route('demo.blog.detail', ['slug' => $item->slug]);
                                        @endphp
                                        <div class="col-md-12 col-12">
                                            <div class="item">
                                                <div class="img">
                                                    <a href="{{ $_url }}">
                                                        <img src="{{ $item->image ? asset($item->image) : asset('/style/images/post/butan.png') }}"
                                                            alt="Image" title="" loading="lazy" style="">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <h3 class="header">
                                                        <a
                                                            href="{{ $_url }}">{{ get_data_lang($item, 'name') }}</a>
                                                    </h3>
                                                    <div class="description">{{ $item->description }}</div>
                                                    <div class="br">
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
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-left">
                <div class="js_widget_builder hide-mobile js_widget_post_style_1_7 widget_post_style_1">
                    <div class="">
                        <div class="box-content">
                            <div class="post">
                                <div class="list-post">
                                    @foreach ($data['news']['right'] as $item)
                                        @php
                                            $_url = route('demo.blog.detail', ['slug' => $item->slug]);
                                        @endphp
                                        <div class="col-12">
                                            <div class="item">
                                                <div class="img">
                                                    <a href="{{ $_url }}">
                                                        <img src="{{ $item->image ? asset($item->image) : asset('/style/images/post/poooo.png') }}"
                                                            alt="Image" title="" loading="lazy" style="">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <div class="info">
                                                        <div class="date">
                                                            <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                                        </div>
                                                        <div class="edit">
                                                            <span>@lang('messages.home.admin')</span>
                                                        </div>
                                                    </div>
                                                    <h3 class="header">
                                                        <a href="{{ $_url }}">
                                                            {{ get_data_lang($item, 'name') }}
                                                        </a>
                                                    </h3>
                                                </div>
                                            </div>
                                            <br />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="read-all">
                    <a href="{{ route('demo.blog.category', ['slug' => 'news']) }}">
                        @lang('messages.view_all')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

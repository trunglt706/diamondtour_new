@if ($data['importants']->count() > 0)
    <div class="js_widget_builder js_widget_post_style_1_11 widget_post_style_1">
        <div class="box-container">
            <div class="header-title">
                <p class="header">@lang('messages.blog.tieu_diem')</p>
                <div class="img-bg"></div>
                <a class="read-more text-uppercase" href="{{ route('demo.blog.category', ['slug' => 'importants']) }}">
                    @lang('messages.view_all')<span> ➝</span>
                </a>
            </div>
            <div class="box-content">
                <div class="post">
                    <div class="row">
                        @foreach ($data['importants'] as $item)
                            @php
                                $_url = route('demo.blog.detail', ['slug' => $item->slug]);
                            @endphp
                            <div class="col-md-4 col-12">
                                <div class="item">
                                    <div class="img">
                                        <a href="{{ $_url }}">
                                            <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $item->image ? get_file($item->image) : asset('/style/images/post/butan.png') }}"
                                                alt="Image" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="title">
                                        <div class="tag">
                                            {{ get_data_lang($item, 'group_name') }}
                                        </div>
                                        <h3 class="header">
                                            <a href="{{ $_url }}">{{ $item->description }}</a>
                                        </h3>
                                        <div class="info">
                                            <div class="date">
                                                <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                            </div>
                                            <div class="edit">
                                                <span>@lang('messages.home.admin')</span>
                                            </div>
                                        </div>
                                        <a class="read-more text-uppercase"
                                            href="{{ $_url }}">@lang('messages.view_now')<span>
                                                &#x279D;</span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif

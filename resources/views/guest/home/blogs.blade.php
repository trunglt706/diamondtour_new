@if ($data['blogs']->count() > 0)
    <div class="js_widget_builder js_widget_post_style_1_1 widget_post_style_1">
        <div class="container">
            <div class="header-title header-title-style-1">
                <p class="header-text-top">@lang('messages.home.dung_bo_lo')</p>
                <p class="header">@lang('messages.home.info_noi_bac')</p>
            </div>
            <div class="box-content">
                <div class="post">
                    <div class="row">
                        @foreach ($data['blogs'] as $item)
                            @php
                                $_url = route('demo.blog.detail', ['slug' => $item->slug]);
                            @endphp
                            <div class="col-md-4 col-12">
                                <div class="item item-post-horizontal wow animated fadeIn item-overlay">
                                    <div class="img">
                                        <a href="{{ $_url }}">
                                            <img src="{{ $item->image ? asset($item->image) : asset('/style/images/post/Rectangle 136.png') }}"
                                                alt="{{ get_data_lang($item, 'name') }}" title="" loading="lazy"
                                                style="">
                                        </a>
                                    </div>
                                    <div class="title">
                                        <h3 class="header">
                                            <a href="{{ $_url }}">
                                                {{ get_data_lang($item, 'group_name') }}
                                            </a>
                                        </h3>
                                        <div class="description">
                                            <a href="{{ $_url }}">
                                                {{ get_data_lang($item, 'name') }}
                                            </a>
                                        </div>
                                        <div class="read-more text-uppercase">
                                            <a href="{{ $_url }}">
                                                @lang('messages.xem_them')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

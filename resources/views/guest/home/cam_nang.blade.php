@if ($data['cam_nang']->count() > 0)
    <div class="js_widget_builder js_widget_post_style_1_4 widget_post_style_1">
        <div class="container">
            <div class="header-title header-title-style-1">
                <p class="header-text-top">@lang('messages.home.thong_tin')</p>
                <p class="header">@lang('messages.menu.blog')</p>
            </div>
            <div class="box-content">
                <div class="post">
                    <div class="post-detail">
                        @foreach ($data['cam_nang'] as $item)
                            @php
                                $cam_nang_url = route('demo.blog.detail', ['slug' => $item->slug]);
                            @endphp
                            <div class="item item-post-horizontal wow animated fadeIn">
                                <div class="img">
                                    <a href="{{ $cam_nang_url }}">
                                        <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ $item->image ? asset($item->image) : asset('/style/images/post/Rectangle 212333.png') }}"
                                            alt="Image" loading="lazy" height="258px" width="317px">
                                    </a>
                                </div>
                                <div class="title">
                                    <span class="chip org">
                                        {{ get_data_lang($item, 'group_name') }}
                                    </span>
                                    <h3 class="header">
                                        <a href="{{ $cam_nang_url }}">
                                            {{ get_data_lang($item, 'name') }}
                                        </a>
                                    </h3>
                                    <div class="description">
                                        <a href="{{ $cam_nang_url }}">
                                            {{ $item->description }}
                                        </a>
                                    </div>
                                    <div class="info">
                                        <div class="date">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                        </div>
                                        <div class="edit">
                                            <i class="fa-solid fa-pen-clip"></i>
                                            <span>@lang('messages.home.admin')</span>
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
@endif

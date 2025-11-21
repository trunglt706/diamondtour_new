<br>
<div class="post-cate-and-style-10">
    <div class="row-grid">
        <div class="post-box-left">
            <div class="post-new">
                <div class="header-title">
                    <p class="header">@lang('messages.blog.xem_nhieu_nhat')</p>
                    <div class="img-bg"></div>
                    <a class="read-more hide-mobile" href="{{ route('blog.category', ['slug' => 'viewers']) }}">
                        @lang('messages.view_all')<span> &#x279D;</span>
                    </a>
                </div>
                <div class="js_widget_builder js_widget_post_style_1_10 widget_post_style_1">
                    <div class="">
                        <div class="box-content">
                            <div class="post">
                                <div class="list-post">
                                    @foreach ($data['viewers'] as $item)
                                        @php
                                            $_url = route('blog.detail', ['slug' => $item->slug]);
                                        @endphp
                                        <div class="col-md-12 col-12">
                                            <div class="item">
                                                <div class="img">
                                                    <a href="{{ $_url }}">
                                                        <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ $item->image ? get_file($item->image) : asset('/style/images/post/butan.png') }}"
                                                            alt="Image" loading="lazy">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <h3 class="header">
                                                        <a
                                                            href="{{ $_url }}">{{ get_data_lang($item, 'name') }}</a>
                                                    </h3>
                                                    <div class="description show-mobile">{{ $item->description }}
                                                    </div>
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
        </div>
        <div class="post-box-right">
            <div class="header-title">
                <p class="header">@lang('messages.blog.danh_muc')</p>
                <div class="img-bg"></div>
            </div>
            <div class="list-cate">
                @foreach ($data['categories'] as $item)
                    @php
                        $_url = route('blog.category', ['slug' => $item->slug]);
                    @endphp
                    <div class="cate">
                        <p class="name"><a href="{{ $_url }}">{{ get_data_lang($item, 'name') }}</a></p>
                        <p class="number">({{ number_format($item->blogs_count) }})</p>
                    </div>
                @endforeach
            </div>
            <br>
            <div class="img">
                <a href="">
                    <img src="/style/images/post/v.png" alt="Image">
                </a>
            </div>
        </div>
    </div>
</div>

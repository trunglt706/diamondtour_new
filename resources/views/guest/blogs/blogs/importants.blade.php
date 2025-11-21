@if ($data['importants']->count() > 0)
    <div class="widget-blog-style-1">
        <div class="container">
            <div class="header-title">
                <p class="title">@lang('messages.blog.blog_pho_bien')</p>
                <p class="description">
                    @lang('messages.blog.blog_pho_bien_des')
                </p>
            </div>
            <div class="list-post ">
                <div class="row">
                    @foreach ($data['importants'] as $item)
                        @php
                            $_url = route('blog.detail', ['slug' => $item->slug]);
                        @endphp
                        <div class="col-md-4 col-12">
                            <div class="item">
                                <div class="img">
                                    <a href="{{ $_url }}">
                                        <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ get_file($item->image) }}" alt="Image"
                                            loading="lazy">
                                    </a>
                                </div>
                                <div class="title">
                                    <h3 class="title-blogs">
                                        <a href="{{ $_url }}">
                                            {{ get_data_lang($item, 'name') }}
                                        </a>
                                    </h3>
                                    <div class="info">
                                        <p class="date">
                                            {{ date('d/m/Y', strtotime($item->created_at)) }}
                                        </p>
                                        <p><a href="#">@lang('messages.home.admin')</a></p>
                                        <p>
                                            <a href="#">
                                                {{ get_data_lang($item, 'group_name') }}
                                            </a>
                                        </p>
                                    </div>
                                    <p class="description">
                                        {{ $item->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

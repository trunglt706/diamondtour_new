@if ($data['hot'])
    @php
        $hot = $data['hot'];
        $_url = route('demo.blog.detail', ['slug' => $hot->slug]);
    @endphp
    <div class="post-hot mb-3">
        <div class="header-title">
            <p class="header">@lang('messages.blog.blog_hot')</p>
            <div class="img-bg"></div>
        </div>
        <div class="post-detail">
            <div class="row-grid">
                <div class="box-left">
                    <div class="img">
                        <img src="{{ $hot->image ? get_file($hot->image) : asset('/style/images/post/vvv.png') }}"
                            alt="Image">
                    </div>
                </div>
                <div class="box-right">
                    <div class="title">
                        <div class="title-top">
                            <h3 class="header">
                                <a href="{{ $_url }}">
                                    {{ get_data_lang($hot, 'name') }}
                                </a>
                            </h3>
                        </div>
                        <div class="title-center">
                            <div class="description">{{ $hot->description }}</div>
                            <div class="info">
                                <div class="date">
                                    <span>{{ date('d/m/Y', strtotime($hot->created_at)) }}</span>
                                </div>
                                <div class="edit">
                                    <span>@lang('messages.home.admin')</span>
                                </div>
                            </div>
                        </div>
                        <a class="read-more text-uppercase" href="{{ $_url }}">@lang('messages.view_all')<span>
                                &#x279D;</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

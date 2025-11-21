@if ($data['others']->count() > 0)
    <div class="widget_tour_1 js_widget_tour_1_2">
        <div class="container">
            <div class="header-title">
                <p class="header text-uppercase">@lang('messages.blog.blog_other')</p>
            </div>
            <div class="row">
                @foreach ($data['others'] as $other)
                    @php
                        $_url = route('blog.detail', ['slug' => $other->slug]);
                    @endphp
                    <div class="col-12">
                        <div class="tour-item">
                            <div class="img">
                                <a href="{{ $_url }}">
                                    <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ get_file($other->image) }}" alt="Image" loading="lazy">
                                </a>
                            </div>
                            <div class="title">
                                <div class="list-icon-share hide-mobile">
                                    <a href="#"><i class="fa-solid fa-share-nodes"></i> @lang('messages.share')</a>
                                    <a href="#"><i class="fa-solid fa-eye"></i> @lang('messages.Views')</a>
                                    <a href="#">
                                        <img src="/style/images/icon/Group2221.png" alt="Image">
                                        @lang('messages.comment')</a>
                                </div>
                                <div class="top">
                                    <h3 class="header-tour-detail">
                                        <a href="{{ $_url }}">{{ $other->name }}</a>
                                    </h3>
                                    <a class="btn-read-more" href="{{ $_url }}">@lang('messages.view_now') ></a>
                                </div>
                                <p class="description">
                                    {{ $other->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

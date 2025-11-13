@extends('guest.layout')
@section('title', $data['title'])
@section('keywords', '')
@section('description', $data['title'])
@section('image', '')
@section('style')
    <style>
        .widget-blog-style-1 {
            padding-top: 50px !important;
        }

        @media (max-width: 932px) {
            .widget-blog-style-1 {
                padding-top: 0 !important;
            }
        }
    </style>
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home blogs">
            @if ($data['list']->count() > 0)
                <div class="widget-blog-style-1">
                    <div class="container">
                        <div class="header-title">
                            <p class="title">{{ $data['title'] }}</p>
                        </div>
                        <div class="list-post ">
                            <div class="row">
                                @foreach ($data['list'] as $item)
                                    @php
                                        $_url = route('demo.blog.detail', ['slug' => $item->slug]);
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
                                                        <a
                                                            href="{{ route('demo.blog.category', ['slug' => $item->group_slug]) }}">
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
                            <div class="mt-4 d-flex justify-content-center">
                                {!! $data['list']->appends(request()->all())->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('/style/js/travel-detail.js') }}"></script>
    <script src="{{ asset('/style/js/post.js') }}"></script>
    <script src="{{ asset('/style/js/blogs.js') }}"></script>
    <script src="{{ asset('/style/js/blogs-detail.js') }}"></script>
@endsection

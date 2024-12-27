@php
    $description = $locale == 'vi' ? 'description' : 'description_' . $locale;
    $_description = $data['menu']->$description ?? $data['menu']->description;
    $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_name = $data['menu']->$name ?? $data['menu']->name;
@endphp
@extends('index')
@section('content')
    <article>
        @include('pages.blocks.breadcrumb', [
            'background' => $data['menu']->background,
            'title' => $_name,
            'description' => $_description,
        ])
        <section>
            <div class="box-blog-header">
                @if ($data['important1']->count() > 0)
                    <div class="container">
                        <div id="section-blog-page--content" class="row gx-4 section-blog-page--content">
                            <div class="blog-grid-sizer"></div>
                            @foreach ($data['important1'] as $key => $item)
                                @if ($key == 0)
                                    <div class="blog-grid-item size-w-66 size-h-596">
                                        <div class="blog-mansory--item"
                                            style="background-image: url({{ get_url($item->image) }});">
                                            <div class="-content">
                                                {{-- <a href="#" class="-category">danh mục</a> --}}
                                                <h2>
                                                    <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}">
                                                        {{ $item->name }}
                                                    </a>
                                                </h2>
                                                <p>{{ $item->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="blog-grid-item size-w-33 size-h-282">
                                        <div class="blog-mansory--item"
                                            style="background-image: url({{ get_url($item->image) }});">
                                            <div class="-content">
                                                {{-- <a href="#" class="-category">danh mục</a> --}}
                                                <h2>
                                                    <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}">
                                                        {{ $item->name }}
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($data['important2']->count() > 0)
                    <div class="container">
                        <div class="row gx-5">
                            @foreach ($data['important2'] as $item)
                                <div class="col-md-4">
                                    <div class="blog-normal-item">
                                        <div class="block-images">
                                            <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}">
                                                <img loading="lazy" src="{{ get_url($item->image) }}"
                                                    alt="{{ $item->name }}" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="block-content">
                                            {{-- <a href="#" class="-category">danh mục</a> --}}
                                            <h2>{{ $item->name }}</h2>
                                            <p>{{ $item->description }}</p>
                                            <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}" class="-more">
                                                @lang('messages.xem_them')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="container">
                            <div class="box-pagination mb-5 mt-3">
                            </div>
                        </div> --}}
                @endif
            </div>
        </section>
        @if ($data['nhatky']->count() > 0)
            <section>
                <div class="box-blog-slider">
                    <div class="container-fluid">
                        <div class="row block-blog-slider-content">
                            <div class="swiper blog-slider-swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($data['nhatky'] as $item)
                                        <div class="swiper-slide">
                                            <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}"
                                                class="blog-slider-item">
                                                <div class="-images">
                                                    <img loading="lazy" src="{{ get_url($item->image) }}"
                                                        alt="{{ $item->name }}" class="img-fluid">
                                                </div>
                                                <div class="-content">
                                                    {{-- <span class="-category">Journey diary</span> --}}
                                                    <h3>{{ $item->name }}</h3>
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row block-blog-slider-footer justify-content-center">
                            <a href="{{ route('blog.cat_blog', ['alias' => $data['nhatkyGroup']->slug]) }}">
                                @lang('messages.xem_them_bai_viet')
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if ($data['kinhnghiem']->count() > 0)
            @php
                $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                $_item_name = $data['kinhnghiemGroup']->$item_name ?? $data['kinhnghiemGroup']->name;
            @endphp
            <section>
                <div class="box-handbook">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="block-handbook-header">
                                    <h2>{{ $_item_name }}</h2>
                                    <a href="{{ route('blog.cat_blog', ['alias' => $data['kinhnghiemGroup']->slug]) }}">
                                        @lang('messages.xem_them_bai_viet')
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row gx-4">
                                    @foreach ($data['kinhnghiem'] as $item)
                                        <div class="col-md-4">
                                            <div class="blog-normal-item">
                                                <div class="block-images">
                                                    <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}">
                                                        <img loading="lazy" src="{{ get_url($item->image) }}"
                                                            alt="{{ $item->name }}" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="block-content">
                                                    {{-- <a href="#" class="-category">Category</a> --}}
                                                    <h2>{{ $item->name }}</h2>
                                                    <p>{{ $item->description }}</p>
                                                    <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}"
                                                        class="-more">
                                                        @lang('messages.xem_them')
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if ($data['vanhoaGroup']->count() > 0)
            @php
                $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                $_item_name = $data['vanhoaGroup']->$item_name ?? $data['vanhoaGroup']->name;
            @endphp
            <section>
                <div class="box-local-culture">
                    <div class="container">
                        <div class="block-local-culture-header d-flex flex-wrap align-items-center justify-content-between">
                            <h2>{{ $_item_name }}</h2>
                            <a href="{{ route('blog.cat_blog', ['alias' => $data['vanhoaGroup']->slug]) }}">
                                @lang('messages.xem_them_bai_viet')
                            </a>
                        </div>
                        <div class="row gx-5">
                            <div class="col-md-9">
                                <div class="block-local-culture-post-main">
                                    @foreach ($data['vanhoa1'] as $item)
                                        <div class="blog-normal-item">
                                            <div class="block-images">
                                                <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}">
                                                    <img loading="lazy" src="{{ get_url($item->image) }}"
                                                        alt="{{ $item->name }}" class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="block-content">
                                                {{-- <a href="#" class="-category">Category</a> --}}
                                                <h2>{{ $item->name }}</h2>
                                                <p>{{ $item->description }}</p>
                                                <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}"
                                                    class="-more">
                                                    @lang('messages.xem_them')
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="block-local-culture-post-other">
                                    @foreach ($data['vanhoa2'] as $item)
                                        <div class="blog-normal-item">
                                            <div class="block-content">
                                                {{-- <a href="#" class="-category">Category</a> --}}
                                                <h2>{{ $item->name }}</h2>
                                                <p>{{ $item->description }}</p>
                                                <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}"
                                                    class="-more">
                                                    @lang('messages.xem_them')
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @include('pages.blocks.newsletter')
    </article>
@endsection

@php
    $tags = $data['blog']->tags ? json_decode($data['blog']->tags) : [];
    $album = $data['blog']->album ? json_decode($data['blog']->album) : [];
    $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_item_name = $data['blog']->$item_name ?? $data['blog']->name;
@endphp
@extends('index')
@section('content')
    <article class="article-wrapper-post">
        @include('pages.blocks.breadcrumb', [
            'background' => $data['blog']->background ?? $data['menu']->background,
            'title' => __('messages.menu.blog'),
            'description' => $_item_name,
            'author' => '',
            'date_create' => '',
            'link' => route('blog.index'),
        ])

        <section>
            <div class="box-wrapper-single-post">
                @if ($album)
                    <div class="container mb-5">
                        <div class="single-post-list-grid">
                            @foreach ($album as $item)
                                <div class="single-post-list-col">
                                    <a href="{{ get_url($item) }}" data-fancybox="gallery">
                                        <img loading="lazy" src="{{ get_url($item) }}" loading="lazy" class="img-fluid"
                                            alt="image">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="block-single-post-content">
                                {!! $data['blog']->content !!}
                            </div>
                            <div class="block-single-post-bottom">
                                <div class="row row-cols-1 row-cols-sm-2">
                                    <div class="col">
                                        @if (count($tags) > 0)
                                            <div class="-post-tags">
                                                <h2>@lang('messages.tu_khoa_lien_ket')</h2>
                                                <ul>
                                                    @foreach ($tags as $item)
                                                        <li>
                                                            <a href="{{ route('search') }}?tag={{ $item }}">
                                                                {{ $item }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div class="-post-tags -social text-end">
                                            <h2>@lang('messages.chia_se_bai_viet')</h2>
                                            <div class="sharethis-inline-share-buttons"></div>
                                            {{-- <ul>
                                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                                <li><a href="#"><i class="fa-brands fa-square-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                                <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                            </ul> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($data['other']->count() > 0)
                                <div class="block-post-related">
                                    <h2>@lang('messages.bai_viet_lien_quan')</h2>
                                    <div class="row gx-3 gx-xl-5">
                                        @foreach ($data['other'] as $item)
                                            <div class="col-sm-4 col-lg-4">
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
                            @endif
                        </div>
                        <div class="col-lg-3">
                            <div class="block-suggested-tours">
                                <h2>@lang('messages.tour_lien_quan')</h2>
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-1">
                                    @foreach ($data['tours'] as $item)
                                        <div class="col">
                                            <a href="{{ route('tour.detail', ['alias' => $item->slug]) }}"
                                                class="destination-home-item"
                                                style="background-image: url({{ get_url($item->image) }})">
                                                <div class="-content">
                                                    <div class="-info">
                                                        <h2>{{ $item->name }}</h2>
                                                        <p>@lang('messages.kham_pha')</p>
                                                    </div>
                                                    {{-- <div class="-price">
                                                        <small>@lang('messages.chi_tu')</small>
                                                        <p>{{ number_format($item->price) }} {{ $item->currency }}</p>
                                                    </div> --}}
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('pages.blocks.newsletter')
    </article>
@endsection

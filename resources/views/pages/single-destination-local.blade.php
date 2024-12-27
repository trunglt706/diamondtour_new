@php
    $tags = $data['destination']->tags ? json_decode($data['destination']->tags) : [];
    $album = $data['destination']->album ? json_decode($data['destination']->album) : [];
    $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_name = $data['destination']->$name ?? $data['destination']->name;
@endphp
@extends('index')
@section('content')
    <article class="article-wrapper-post">
        @include('pages.blocks.breadcrumb', [
            'background' => $data['destination']->image,
            'title' => __('messages.destination'),
            'description' => $_name,
        ])
        <section>
            <div class="box-wrapper-single-post">
                <div class="container mb-5">
                    <div class="single-post-list-grid">
                        @foreach ($album as $item)
                            <div class="single-post-list-col">
                                <a href="{{ get_url($item) }}" data-fancybox="gallery">
                                    <img loading="lazy" src="{{ get_url($item) }}" class="img-fluid" alt="image">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="block-single-post-content">
                                {!! $data['destination']->content !!}
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
                                            <h2>@lang('messages.chia_se_diem_den')</h2>
                                            <div class="sharethis-inline-share-buttons"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($data['other'])
                                <div class="block-post-related">
                                    <h2>@lang('messages.diem_den_lien_quan')</h2>
                                    <div class="row gx-3 gx-xl-5">
                                        @foreach ($data['other'] as $item)
                                            <div class="col-sm-4 col-lg-4">
                                                <div class="blog-normal-item">
                                                    <div class="block-images">
                                                        <a
                                                            href="{{ route('destination.detail', ['alias' => $item->slug]) }}">
                                                            <img loading="lazy" src="{{ get_url($item->image) }}"
                                                                alt="{{ $item->name }}" class="img-fluid">
                                                        </a>
                                                    </div>
                                                    <div class="block-content">
                                                        {{-- <a href="#" class="-category">Category</a> --}}
                                                        <h2>{{ $item->name }}</h2>
                                                        <p>{!! $item->description !!}</p>
                                                        <a href="{{ route('destination.detail', ['alias' => $item->slug]) }}"
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
                            @if ($data['tours']->count() > 0)
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
                                                            <small>Chỉ từ</small>
                                                            <p>{{ number_format($item->price) }}đ</p>
                                                        </div> --}}
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('pages.blocks.newsletter')
    </article>
@endsection

@php
    $why = json_decode($data['destination']->why);
    $plan = json_decode($data['destination']->plan);
    $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_name = $data['menu']->$name ?? $data['menu']->name;
    $destination = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_destination = $data['destination']->$destination ?? $data['destination']->name;
    $tags = $data['destination']->tags ? json_decode($data['destination']->tags) : [];
@endphp
@extends('index')
@section('content')
    <article class="article-wrapper-single-tour">
        @include('pages.blocks.breadcrumb', [
            'background' => $data['destination']->background ?? $data['menu']->background,
            'title' => $_name,
            'description' => $_destination,
        ])
        <section>
            <div class="box-wrapper-single-destination">
                {{-- <div class="container">
                    <div class="block-destination-description">
                        {!! $data['destination']->content !!}
                    </div>
                </div> --}}
                <div class="box-image-row-single-destination">
                    <div class="col-left"
                        style="background-image: url({{ get_url($data['destination']->image_description) }})">
                        <div class="overlay-content container">
                            <div class="row row-column justify-content-end">
                                <div class="col-lg-6">
                                    <div class="--content">
                                        {!! $data['destination']->description !!}
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="block-tour-of-destination-related">
                                        <div class="swiper tour-related-slider-swiper">
                                            <div class="swiper-wrapper">
                                                @foreach ($data['tours'] as $item)
                                                    <div class="swiper-slide">
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
                                        <div class="swiper-navigation">
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-address-row-single-destination">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-lg-2">
                            <div class="col">
                                <div class="-content">
                                    {{-- <h2>Where is Bhutan?</h2> --}}
                                    <div class="-desc">
                                        {!! $data['destination']->content !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="-image">
                                    <img loading="lazy" src="{{ get_url($data['destination']->image_content) }}"
                                        class="img-fluid" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($why)
                    <div class="box-reason-row-single-destination"
                        style="background-image: url({{ get_url('assets/images/bg-destination-single.png') }});">
                        <div class="container">
                            <div class="block-section-header">
                                <h2>@lang('messages.tai_sao_lai_la_diem_den_nay')?</h2>
                            </div>
                            <div class="swiper reason-slider-swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($why as $item)
                                        <div class="swiper-slide">
                                            <div class="reason-item">
                                                <h2>{{ $item->title }}</h2>
                                                <p>{!! $item->content !!}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="swiper-navigation">
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($plan)
                    <div class="box-pricing-row-single-destination">
                        <div class="container">
                            <div class="block-section-header">
                                <h2>@lang('messages.ke_hoach_du_lich_va_chi_phi')</h2>
                            </div>
                            <div class="row row-cols-1">
                                <div class="col content">
                                    {!! $plan->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="container">
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
                </div>
                @if (count($data['reviews1']) > 0)
                    <div class="box-testimonial-row-single-destination">
                        <div class="container">
                            <div class="row row-cols-1 row-cols-md-2">
                                <div class="col">
                                    <div class="block-section-header">
                                        <h2>@lang('messages.chia_se_cua_khach_hang')</h2>
                                        {!! $data['destination']->talk !!}
                                    </div>
                                    <div class="-list-testimonial row row-cols-1 row-cols-lg-2">
                                        @foreach ($data['reviews1'] as $item)
                                            <div class="col">
                                                <div class="testimonial-item">
                                                    <div class="comment-content">
                                                        <p>{!! $item->content !!}</p>
                                                    </div>
                                                    <div class="comment-bio">
                                                        <div class="profile-image">
                                                            <img decoding="async"
                                                                src="{{ $item->user_avatar ? get_url($item->user_avatar) : get_url('assets/images/user/no-avatar.jpg') }}"
                                                                alt="{{ $item->user_name }}">
                                                        </div>
                                                        <span class="profile-info">
                                                            <strong class="profile-name">{{ $item->user_name }}</strong>
                                                            <p class="profile-des">{{ $item->name }}</p>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if ($data['reviews2'])
                                    <div class="col">
                                        <div class="-list-testimonial row row-cols-1 row-cols-lg-2">
                                            @foreach ($data['reviews2'] as $item)
                                                <div class="col">
                                                    <div class="testimonial-item">
                                                        <div class="comment-content">
                                                            <p>{!! $item->content !!}</p>
                                                        </div>
                                                        <div class="comment-bio">
                                                            <div class="profile-image">
                                                                <img decoding="async"
                                                                    src="{{ $item->user_avatar ? get_url($item->user_avatar) : get_url('assets/images/user/no-avatar.jpg') }}"
                                                                    alt="{{ $item->user_name }}">
                                                            </div>
                                                            <span class="profile-info">
                                                                <strong
                                                                    class="profile-name">{{ $item->user_name }}</strong>
                                                                <p class="profile-des">{{ $item->name }}</p>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if ($data['other'])
                    <div class="container" style="margin-top: 30px;">
                        <div class="block-post-related">
                            <h2>@lang('messages.diem_den_lien_quan')</h2>
                            <div class="row gx-3 gx-xl-5">
                                @foreach ($data['other'] as $item)
                                    <div class="col-sm-4 col-lg-4">
                                        <div class="blog-normal-item">
                                            <div class="block-images">
                                                <a href="{{ route('destination.detail', ['alias' => $item->slug]) }}">
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
                    </div>
                @endif
            </div>
        </section>
        @include('pages.blocks.newsletter')
    </article>
@endsection

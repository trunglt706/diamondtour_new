@php
    $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_name = $data['tour']->$name ?? $data['tour']->name;
@endphp
@extends('index')
@section('content')
    <article class="article-wrapper-single-tour">
        @include('pages.blocks.breadcrumb', [
            'background' => $data['tour']->background ?? $data['menu']->background,
            'title' => __('messages.menu.tour'),
            'description' => $_name,
            'link' => route('tour.index'),
        ])
        <section>
            <div class="box-wrapper-single-tour">
                <div class="container">
                    <div class="row card-find-tour align-items-center gx-4">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row row-cols-1 row-cols-md-3 gx-4">
                                <div class="col">
                                    <div class="tour-schedule-item">
                                        <p class="-label"><i class="fa-regular fa-clock d-inline-block me-2"></i>
                                            @lang('messages.thoi_gian')
                                        </p>
                                        <p class="-content">
                                            {{ $data['tour']->duration ?? __('messages.dang_cap_nhat') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="tour-schedule-item">
                                        <p class="-label"><i class="fa-regular fa-star d-inline-block me-2"></i>
                                            @lang('messages.chi_phi')</p>
                                        <p class="-content">
                                            @if ($data['tour']->price > 0)
                                                {{ number_format($data['tour']->price) }} {{ $data['tour']->currency }}
                                            @else
                                                @lang('messages.dang_cap_nhat')
                                            @endif

                                        </p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="tour-schedule-item">
                                        <p class="-label"><i class="fa-regular fa-calendar-days d-inline-block me-2"></i>
                                            @lang('messages.ngay_khoi_hanh')</p>
                                        <p class="-content">
                                            {{ $data['tour']->from ? date('d/m/Y', strtotime($data['tour']->from)) : __('messages.dang_cap_nhat') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-4">
                            <a href="{{ $data['tour']->schedule_file ?? '#' }}" class="btn w-100 btn-primary">
                                @lang('messages.tai_lich_trinh_ve_may')
                            </a>
                        </div>
                    </div>
                    <div class="single-tour-content">
                        <h2>@lang('messages.gioi_thieu')</h2>
                        {!! $data['tour']->content !!}
                    </div>
                    @if ($data['images'])
                        <div class="single-tour-list-grid-destination">
                            @foreach ($data['images'] as $item)
                                <div class="single-tour-list-col-destination">
                                    <div class="single-tour-destination--item">
                                        <div class="-image">
                                            <img loading="lazy" src="{{ get_url($item->image) }}" loading="lazy"
                                                class="img-fluid" alt="{{ $item->name }}">
                                        </div>
                                        <div class="-content">
                                            <h2>{{ $item->name }}</h2>
                                        </div>
                                        <a href="{{ get_url($item->image) }}" data-fancybox="gallery"
                                            data-caption="{{ $item->name }}"></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                @if ($data['tour']->schedules)
                    <div class="single-tour-list-schedule">
                        <div class="swiper carousel-list-schedule-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($data['tour']->schedules as $item)
                                    <div class="swiper-slide">
                                        <div class="tour-schedule--item">
                                            <div class="-image">
                                                <img loading="lazy" src="{{ get_url($item->image) }}" class="img-fluid"
                                                    alt="{{ $item->name }}">
                                                <div class="overlay-content">
                                                    <h2>{{ $item->name }}</h2>
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            </div>
                                            <div class="-content">
                                                <div class="-content--header">@lang('messages.lich_trinh_chi_tiet')</div>
                                                <div class="-content--innder">
                                                    <div class="block-style-accordion faq-question-list">
                                                        <div class="accordion accordion-flush"
                                                            id="accordionQuestionSection{{ $item->id }}">
                                                            @if ($item->details)
                                                                @foreach ($item->details as $key => $detail)
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header">
                                                                            <button
                                                                                class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#flush-collapseQuestionSection{{ $item->id }}{{ $detail->id }}"
                                                                                aria-expanded="false"
                                                                                aria-controls="flush-collapseQuestionSection{{ $item->id }}{{ $detail->id }}">
                                                                                <i
                                                                                    class="fa-solid fa-location-dot d-inline-block me-2"></i>
                                                                                {{ $detail->name }}
                                                                            </button>
                                                                        </h2>
                                                                        <div id="flush-collapseQuestionSection{{ $item->id }}{{ $detail->id }}"
                                                                            class="accordion-collapse collapsed hide collapse {{ $key == 0 ? 'show' : '' }}"
                                                                            data-bs-parent="#accordionQuestionSection{{ $item->id }}">
                                                                            <div class="accordion-body">
                                                                                {!! $detail->description !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-navigation">
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                @endif
                <div class="block-description-single-tour">
                    <div class="container">
                        <div class="block-destination-header">
                            <ul class="nav nav-pills justify-content-center" id="pills-description-single-tour"
                                role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-uppercase active" id="pills-includes-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-includes" type="button" role="tab"
                                        aria-controls="pills-includes" aria-selected="true">@lang('messages.bao_gom')</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-uppercase" id="pills-excludes-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-excludes" type="button" role="tab"
                                        aria-controls="pills-excludes" aria-selected="false">@lang('messages.khong_bao_gom')</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-uppercase" id="pills-terms-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-terms" type="button" role="tab"
                                        aria-controls="pills-terms" aria-selected="false">@lang('messages.dieu_khoan')</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-uppercase" id="pills-notice-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-notice" type="button" role="tab"
                                        aria-controls="pills-notice" aria-selected="false">@lang('messages.luu_y')</button>
                                </li>
                            </ul>
                        </div>
                        <div class="block-destination-content">
                            <div class="tab-content" id="pills-description-single-tour-content">
                                <div class="tab-pane fade show active single-tour-content" id="pills-includes"
                                    role="tabpanel" aria-labelledby="pills-includes-tab" tabindex="0">
                                    {!! $data['tour']->include !!}
                                </div>
                                <div class="tab-pane fade single-tour-content" id="pills-excludes" role="tabpanel"
                                    aria-labelledby="pills-excludes-tab" tabindex="0">
                                    {!! $data['tour']->exclude !!}
                                </div>
                                <div class="tab-pane fade single-tour-content" id="pills-terms" role="tabpanel"
                                    aria-labelledby="pills-excludes-tab" tabindex="0">
                                    {!! $data['tour']->term !!}
                                </div>
                                <div class="tab-pane fade single-tour-content" id="pills-notice" role="tabpanel"
                                    aria-labelledby="pills-excludes-tab" tabindex="0">
                                    {!! $data['tour']->notice !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('pages.blocks.register_tour')
    </article>
@endsection

@php
    $description = $locale == 'vi' ? 'description' : 'description_' . $locale;
    $_description = $data['menu']->$description ?? $data['menu']->description;
    $images = $data['menu']->images ? json_decode($data['menu']->images) : [];
    $images = !empty($images) ? $images : [$data['menu']->background];
@endphp
@extends('index')
@section('content')
    <article>
        <section>
            <div class="box-slider-home">
                <div class="swiper carousel-home-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($images as $item)
                            <div class="swiper-slide">
                                <div class="carousel-home--item animate-ken-burns animate-ken-burns--in">
                                    <img loading="lazy" src="{{ get_url($item) ?? get_url('assets/images/slider.png') }}"
                                        alt="image" class="img-fluid">
                                    <div class="-content">
                                        {{-- <div class="-tag">
                                        <ul>
                                            <li><a href="#">Feel The Experience</a></li>
                                        </ul>
                                    </div> --}}
                                        <h2>
                                            {{ $_description }}
                                        </h2>
                                        <a href="{{ route('tour.index') }}" class="btn btn-view">
                                            @lang('messages.bat_dau_kham_pha')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-wrapper-widget">
                        {{-- <ul class="-social">
                            @foreach ($socials as $item)
                                <li>
                                    <a target="_blank" href="{{ $item->link }}">{!! $item->icon !!}</a>
                                </li>
                            @endforeach
                        </ul> --}}
                        <div class="scroll-top-sec">
                            <a href="#sec-tour-home" data-text="@lang('messages.scroll')">
                                <img loading="lazy" src="{{ get_url('assets/images/arrow-down.png') }}" alt="scroll"
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            @if ($data['calendars']->count() > 0)
                <div class="container">
                    <div class="box-tours-special-home">
                        <div class="swiper tours-special-home-slider-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($data['calendars'] as $item)
                                    <div class="swiper-slide">
                                        <a href="{{ route('tour.detail', ['alias' => $item->tour->slug]) }}"
                                            class="destination-home-item"
                                            style="background-image: url({{ get_url($item->tour->image) }})">
                                            <div class="-label-hot">HOT</div>
                                            <div class="-content">
                                                <div class="-info-special">
                                                    <div class="--start">@lang('messages.tg_khoi_hanh')
                                                        {{ date('d/m/Y', strtotime($item->start)) }}</div>
                                                    <h2>
                                                        {{ $item->tour->name }}
                                                    </h2>
                                                    @if ($item->tour->withCountry)
                                                        <div class="--location">
                                                            <i class="fa-solid fa-location-dot text-warning me-2"></i>
                                                            {{ $item->tour->withCountry->name }}
                                                        </div>
                                                    @endif
                                                </div>
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
                        <div class="text-center">
                            <a href="{{ route('tour.calendar') }}">
                                @lang('messages.xem_them_lich_khoi_hanh')
                            </a>
                        </div>
                    </div>
                </div>
        </section>
        @endif
        @if ($data['tour_groups'])
            <section id="sec-tour-home">
                <div class="box-tour-home">
                    <div class="container">
                        <div id="section-tour-home--content" class="section-tour-home--content">
                            <div class="th-grid-sizer"></div>
                            @foreach ($data['tour_groups'] as $index => $item)
                                @php
                                    $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                    $_item_name = $item->$item_name ?? $item->name;
                                @endphp
                                @switch($index)
                                    @case(0)
                                        <div class="th-grid-item size-w-33 size-h-672">
                                            <a href="{{ route('tour.cat_tours', ['alias' => $item->slug]) }}"
                                                class="tour-home--item"
                                                style="background-image: url({{ get_url($item->image) }});">
                                                <div class="-content">
                                                    <h2>{{ $_item_name }}</h2>
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @break

                                    @case(3)
                                        <div class="th-grid-item size-w-66 size-h-320">
                                            <a href="{{ route('tour.cat_tours', ['alias' => $item->slug]) }}"
                                                class="tour-home--item"
                                                style="background-image: url({{ get_url($item->image) }});">
                                                <div class="-content">
                                                    <h2>{{ $_item_name }}</h2>
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @break

                                    @case(4)
                                        <div class="th-grid-item size-w-66 size-h-320">
                                            <a href="{{ route('tour.cat_tours', ['alias' => $item->slug]) }}"
                                                class="tour-home--item"
                                                style="background-image: url({{ get_url($item->image) }});">
                                                <div class="-content">
                                                    <h2>{{ $_item_name }}</h2>
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @break

                                    @case(5)
                                        <div class="th-grid-item size-w-33 size-h-320">
                                            <a href="{{ route('tour.cat_tours', ['alias' => $item->slug]) }}"
                                                class="tour-home--item"
                                                style="background-image: url({{ get_url($item->image) }});">
                                                <div class="-content">
                                                    <h2>{{ $_item_name }}</h2>
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @break

                                    @default
                                        <div class="th-grid-item size-w-33 size-h-320">
                                            <a href="{{ route('tour.cat_tours', ['alias' => $item->slug]) }}"
                                                class="tour-home--item"
                                                style="background-image: url({{ get_url($item->image) }});">
                                                <div class="-content">
                                                    <h2>{{ $_item_name }}</h2>
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @break
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @include('pages.blocks.companion')
        @include('pages.blocks.discovery-home')
        @include('pages.blocks.about-home')
        @include('pages.blocks.destination-home')
        @include('pages.blocks.faq-home')
        @include('pages.blocks.post-home')
        @include('pages.blocks.newsletter')
        @if ($data['event'])
            <div class="modal" tabindex="-1" id="modalEvent">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body position-relative">
                            <button style="position: absolute; top: 10px; right: 10px;" type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                            <a href="{{ route('event.detail', ['slug' => $data['event']->slug]) }}">
                                <img src="{{ get_url($data['event']->background) }}" alt="event" class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </article>
@endsection
@section('script_module')
    <script>
        $(document).ready(function() {
            if ($('#modalEvent').length) {
                $('#modalEvent').modal('show');
            }
        })
    </script>
@endsection

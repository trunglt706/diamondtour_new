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
            <div class="box-wrapper-destination">
                <div class="container">
                    @if ($data['nationals']->count() > 0)
                        <div class="block-list-by-country">
                            <div class="block-section-header">
                                <h2>{{ $seo['destination-country'] }}</h2>
                                {{-- <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                                Aenean massa.</p> --}}
                            </div>
                            <div class="block-discovery-list">
                                <div class="row gx-3 gy-3 gx-lg-4 gy-lg-4">
                                    @foreach ($data['nationals'] as $item)
                                        @php
                                            $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                            $_item_name = $item->$item_name ?? $item->name;
                                        @endphp
                                        <div class="col-sm-6 col-md-4">
                                            <a href="{{ route('destination.detail', ['alias' => $item->slug]) }}"
                                                class="discovery-tour-item"
                                                style="background-image: url({{ get_url($item->image) }})">
                                                <h3>{{ $_item_name }}</h3>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($data['locals']->count() > 0)
                        <div class="block-list-by-sites">
                            <div class="container">
                                <div class="block-section-header text-center">
                                    <h2>{{ $seo['destination-province'] }}</h2>
                                    {{-- <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa.</p> --}}
                                </div>
                                {{-- <div class="block-destination-header">
                                <ul class="nav nav-pills justify-content-center" id="pills-destination-home" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-destination-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-destination" type="button" role="tab"
                                            aria-controls="pills-destination" aria-selected="true">DESTINATION</button>
                                    </li>
                                </ul>
                            </div> --}}
                                <div class="block-destination-content">
                                    <div class="tab-content" id="pills-destination-home-content">
                                        <div class="tab-pane fade show active" id="pills-destination" role="tabpanel"
                                            aria-labelledby="pills-destination-tab" tabindex="0">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 gx-5">
                                                @foreach ($data['locals'] as $item)
                                                    @php
                                                        $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                                        $_item_name = $item->$item_name ?? $item->name;
                                                    @endphp
                                                    <div class="col">
                                                        <a href="{{ route('destination.detail', ['alias' => $item->slug]) }}"
                                                            class="destination-home-item"
                                                            style="background-image: url({{ get_url($item->image) }})">
                                                            <div class="-content">
                                                                <div class="-info">
                                                                    <h2>{{ $_item_name }}</h2>
                                                                    <p>
                                                                        <i
                                                                            class="fa-solid fa-location-dot d-inline-block me-2"></i>
                                                                        {{ $item->group ? $item->group->name : '-' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-pagination">
                                        {!! $data['locals']->appends(request()->all())->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @include('pages.blocks.faq-home')
        {{-- @include('pages.blocks.distinctive-value') --}}
        <section>
            <div class="box-distinctive-value">
                <div class="container">
                    <div class="distinctive-value--header">
                        <h2>@lang('messages.gia_tri_khac_biet')</h2>
                        <p>
                            @lang('messages.chung_toi_cung_phan_dau')
                        </p>
                    </div>
                    <div class="distinctive-value--content">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gx-4">
                            <div class="col">
                                <div class="distinctive-value-item">
                                    <div class="-image">
                                        <img loading="lazy" src="{{ get_url('assets/images/distinctive-value-1.png') }}"
                                            class="img-fluid" alt="image">
                                    </div>
                                    <div class="-content">@lang('messages.gia_tour_canh_tranh')</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="distinctive-value-item">
                                    <div class="-image">
                                        <img loading="lazy" src="{{ get_url('assets/images/distinctive-value-2.png') }}"
                                            class="img-fluid" alt="image">
                                    </div>
                                    <div class="-content">@lang('messages.chat_luong_hang_dau')</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="distinctive-value-item">
                                    <div class="-image">
                                        <img loading="lazy" src="{{ get_url('assets/images/distinctive-value-3.png') }}"
                                            class="img-fluid" alt="image">
                                    </div>
                                    <div class="-content">@lang('messages.trach_nhiem_tan_tam')</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="distinctive-other-image row gx-5">
                        <div class="col-md-8">
                            <div class="-image">
                                <img loading="lazy" src="{{ get_url($seo['destination-image-1']) }}" class="img-fluid"
                                    alt="image">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="-image">
                                <img loading="lazy" src="{{ get_url($seo['destination-image-2']) }}" class="img-fluid"
                                    alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('pages.blocks.newsletter')
    </article>
@endsection

@php
    $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_name = $data['group']->$name ?? $data['group']->name;
    $description = $locale == 'vi' ? 'description' : 'description_' . $locale;
    $_description = $data['group']->$description ?? $data['group']->description;
@endphp
@extends('index')
@section('content')
    <style>
        .box-breadcrumb-cover {
            height: 500px
        }
    </style>
    <article class="article-wrapper-tour">
        @include('pages.blocks.breadcrumb', [
            'background' => $data['group']->image,
            'description' => $_name,
            'sub' => $_description,
        ])
        <section>
            <div class="box-wrapper-tour">
                @if ($data['list']->count() > 0)
                    <div class="block-tour-list">
                        <div class="container">
                            <div id="section-tour--content" class="section-tour--content">
                                <div class="th-grid-sizer"></div>
                                @foreach ($data['list'] as $index => $item)
                                    @if ($index == 0 || $index == 5 || $index == 7)
                                        <div class="th-grid-item size-w-66 size-h-320">
                                            <a href="{{ route('tour.detail', ['alias' => $item->slug]) }}" class="tour-item"
                                                style="background-image: url({{ get_url($item->image) }});">
                                                <div class="overlay-content">
                                                    <div class="-content-top">
                                                        <div class="-inner-title">
                                                            <h2>{{ $item->name }}</h2>
                                                            <small>{{ $item->withCountry ? $item->withCountry->name : '' }}</small>
                                                        </div>
                                                        <div class="-inner-date">
                                                            {{ $item->from ? date('d/m/Y', strtotime($item->from)) : '' }}
                                                        </div>
                                                    </div>
                                                    <div class="-content-bottom">
                                                        <div class="-inner-content">
                                                            <p>{{ $item->description ?? '' }}</p>
                                                        </div>
                                                        <p class="-inner-price">
                                                            {{ $item->price > 0 ? number_format($item->price) . 'đ' : 'Đang cập nhật' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @elseif($index == 1 || $index == 3 || $index == 4 || $index == 6)
                                        <div class="th-grid-item size-w-33 size-h-320">
                                            <a href="{{ route('tour.detail', ['alias' => $item->slug]) }}" class="tour-item"
                                                style="background-image: url({{ get_url($item->image) }});">
                                                <div class="overlay-content">
                                                    <div class="-content-top">
                                                        <div class="-inner-title">
                                                            <h2>{{ $item->name }}</h2>
                                                            <small>{{ $item->withCountry ? $item->withCountry->name : '' }}</small>
                                                        </div>
                                                        <div class="-inner-date">
                                                            {{ $item->from ? date('d/m/Y', strtotime($item->from)) : '' }}
                                                        </div>
                                                    </div>
                                                    <div class="-content-bottom">
                                                        <div class="-inner-content">
                                                            <p>{{ $item->description ?? '' }}</p>
                                                        </div>
                                                        <p class="-inner-price">
                                                            {{ $item->price > 0 ? number_format($item->price) . 'đ' : 'Đang cập nhật' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @else
                                        <div class="th-grid-item size-w-33 size-h-672">
                                            <a href="{{ route('tour.detail', ['alias' => $item->slug]) }}"
                                                class="tour-item"
                                                style="background-image: url({{ get_url($item->image) }});">
                                                <div class="overlay-content">
                                                    <div class="-content-top">
                                                        <div class="-inner-title">
                                                            <h2>{{ $item->name }}</h2>
                                                            <small>{{ $item->withCountry ? $item->withCountry->name : '' }}</small>
                                                        </div>
                                                        <div class="-inner-date">
                                                            {{ $item->from ? date('d/m/Y', strtotime($item->from)) : '' }}
                                                        </div>
                                                    </div>
                                                    <div class="-content-bottom">
                                                        <div class="-inner-content">
                                                            <p>{{ $item->description ?? '' }}</p>
                                                        </div>
                                                        <p class="-inner-price">
                                                            {{ $item->price > 0 ? number_format($item->price) . 'đ' : 'Đang cập nhật' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="box-pagination">
                        {!! $data['list']->appends(request()->all())->links() !!}
                    </div>
                @else
                    <div class="block-tour-list mb-5">
                        <div class="container">
                            @include('pages.blocks.empty-content')
                        </div>
                    </div>
                @endif
            </div>
        </section>
        @include('pages.blocks.register_tour')
    </article>
@endsection

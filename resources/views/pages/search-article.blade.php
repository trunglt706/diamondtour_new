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
            <div class="box-wrapper-search">
                <div class="container">
                    <div class="block-section-header">
                        <h2>@lang('messages.danh_sach_tu_khoa') "<span id="list-keyword">{{ $data['tag'] }}</span>"</h2>
                    </div>
                    <div id="auto-focus-highlight" class="my-5">
                        @if ($data['blogs'])
                            <div class="section-type-article-item">
                                <div class="block-section-header">
                                    <h2>@lang('messages.menu.blog')</h2>
                                </div>
                                <div class="row-type-article-content">
                                    <ol>
                                        @foreach ($data['blogs'] as $item)
                                            @php
                                                $name_blog = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                                $_name_blog = $item->$name_blog ?? $item->name;
                                            @endphp
                                            <li>
                                                <h2>
                                                    <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}">
                                                        {{ $_name_blog }}
                                                    </a>
                                                </h2>
                                                <p>{!! $item->description !!}</p>
                                                @php
                                                    $tags = $item->tags ? json_decode($item->tags) : [];
                                                @endphp
                                                <div class="-tags">
                                                    @foreach ($tags as $item)
                                                        <a href="{{ route('search') }}?tag={{ $item }}">
                                                            {{ $item }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                                <div class="box-pagination">
                                    {!! $data['blogs']->appends(request()->all())->links() !!}
                                </div>
                            </div>
                        @endif
                        @if ($data['destinations'])
                            <div class="section-type-article-item">
                                <div class="block-section-header">
                                    <h2>@lang('messages.destination')</h2>
                                </div>
                                <div class="row-type-article-content">
                                    <ol>
                                        @foreach ($data['destinations'] as $item)
                                            @php
                                                $name_destination = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                                $_name_destination = $item->$name_destination ?? $item->name;
                                            @endphp
                                            <li>
                                                <h2>
                                                    <a href="{{ route('destination.detail', ['alias' => $item->slug]) }}">
                                                        {{ $_name_destination }}
                                                    </a>
                                                </h2>
                                                <p>{!! $item->description !!}</p>
                                                @php
                                                    $tags = $item->tags ? json_decode($item->tags) : [];
                                                @endphp
                                                <div class="-tags">
                                                    @foreach ($tags as $item)
                                                        <a href="{{ route('search') }}?tag={{ $item }}">
                                                            {{ $item }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                                <div class="box-pagination">
                                    {!! $data['destinations']->appends(request()->all())->links() !!}
                                </div>
                            </div>
                        @endif
                        @if ($data['tours'])
                            <div class="section-type-article-item">
                                <div class="block-section-header">
                                    <h2>@lang('messages.menu.tour')</h2>
                                </div>
                                <div class="row-type-article-content">
                                    <ol>
                                        @foreach ($data['tours'] as $item)
                                            @php
                                                $name_tour = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                                $_name_tour = $item->$name_tour ?? $item->name;
                                            @endphp
                                            <li>
                                                <h2>
                                                    <a href="{{ route('tour.detail', ['alias' => $item->slug]) }}">
                                                        {{ $_name_tour }}
                                                    </a>
                                                </h2>
                                                <p>{!! $item->description !!}</p>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                                <div class="box-pagination">
                                    {!! $data['tours']->appends(request()->all())->links() !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @include('pages.blocks.newsletter')
    </article>
@endsection

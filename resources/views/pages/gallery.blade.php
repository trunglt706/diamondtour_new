@php
    $pagination = $data['list']->appends(request()->all())->links();
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
            <div class="box-wrapper-gallery">
                <div class="container">
                    @if ($data['list']->count() > 0)
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gx-3 gx-lg-5">
                            @foreach ($data['list'] as $item)
                                @php
                                    $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                    $_item_name = $item->$item_name ?? $item->name;
                                @endphp
                                <div class="col">
                                    <a href="{{ route('library.detail', ['alias' => $item->slug]) }}"
                                        class="gallery-group-item">
                                        <div class="-image">
                                            <img loading="lazy" src="{{ get_url($item->image) }}" class="img-fluid"
                                                loading="lazy" alt="image">
                                        </div>
                                        <div class="-content">
                                            <h2>{{ $_item_name }}</h2>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        @if ($pagination)
                            <div class="box-pagination">
                                {!! $pagination !!}
                            </div>
                        @endif
                    @else
                        @include('pages.blocks.empty-content')
                    @endif
                </div>
            </div>
        </section>
        @include('pages.blocks.newsletter')
    </article>
@endsection

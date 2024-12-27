@php
    $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $menu_name = $data['menu']->$name ?? $data['menu']->name;
    $_name = $data['group']->$name ?? $data['group']->name;
@endphp
@extends('index')
@section('content')
    <article>
        @include('pages.blocks.breadcrumb', [
            'background' => $data['group']->background
                ? $data['menu']->background
                : 'assets/images/breadcrumb-gallery.jpg',
            'title' => $menu_name,
            'description' => $_name,
            'link' => route('library.index'),
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
                                    <a href="{{ get_url($item->image) }}" data-fancybox="gallery" class="gallery-item"
                                        data-caption="{{ $_item_name }}">
                                        <div class="-image">
                                            <img src="{{ get_url($item->image) }}" class="img-fluid"
                                                alt="{{ $item->id }}">
                                            <div class="overlay-content">{{ $_item_name }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="box-pagination">
                            {!! $data['list']->appends(request()->all())->links() !!}
                        </div>
                    @else
                        @include('pages.blocks.empty-content')
                    @endif
                </div>
            </div>
        </section>
        @include('pages.blocks.newsletter')
    </article>
@endsection

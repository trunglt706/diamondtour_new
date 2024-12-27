@php
    $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_name = $data['group']->$name ?? $data['group']->name;
@endphp
@extends('index')
@section('content')
    <article class="article-wrapper-tour">
        @include('pages.blocks.breadcrumb', [
            'background' => $data['group']->image,
            'title' => __('messages.danh_muc_destination'),
            'description' => $_name,
        ])
        <section>
            <div class="box-wrapper-tour">
                <div class="container mb-5">
                    @if ($data['list']->count() > 0)
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gx-3 gx-lg-5">
                            @foreach ($data['list'] as $item)
                                @php
                                    $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                    $_item_name = $item->$item_name ?? $item->name;
                                @endphp
                                <div class="col mb-4">
                                    <a href="{{ route('destination.detail', ['alias' => $item->slug]) }}"
                                        class="cat-post-item">
                                        <div class="-image">
                                            <img loading="lazy" src="{{ get_url($item->image) }}" class="img-fluid w-100"
                                                alt="{{ $_item_name }}">
                                        </div>
                                        <div class="-content">
                                            <h2>{{ $_item_name }}</h2>
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

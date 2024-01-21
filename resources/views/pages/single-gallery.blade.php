@extends('index')
@section('content')
    <article>
        @include('pages.blocks.breadcrumb', [
            'background' => $data['group']->image,
            'title' => $data['menu']->name,
            'description' => $data['group']->name,
        ])

        <section>
            <div class="box-wrapper-gallery">
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 gx-3 gx-lg-4">
                        @foreach ($data['list'] as $item)
                            <div class="col">
                                <a href="{{ $item->image }}" data-fancybox="gallery" class="gallery-item">
                                    <div class="-image">
                                        <img src="{{ $item->image }}" class="img-fluid" alt="{{ $item->id }}">
                                        <div class="overlay-content">{{ $item->name }}</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="box-pagination">
                        {!! $data['list']->appends(request()->all())->links() !!}
                    </div>
                </div>
            </div>
        </section>
        @include('pages.blocks.newsletter')
    </article>
@endsection

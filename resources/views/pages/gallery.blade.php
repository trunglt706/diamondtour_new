@extends('index')
@section('content')
    <article>
        @include('pages.blocks.breadcrumb', [
            'background' => $data['menu']->background,
            'title' => $data['menu']->name,
            'description' => $data['menu']->description,
        ])
        <section>
            <div class="box-wrapper-gallery">
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gx-3 gx-lg-5">
                        @foreach ($data['list'] as $item)
                            <div class="col">
                                <a href="{{ route('library.detail', ['alias' => $item->slug]) }}" class="gallery-group-item">
                                    <div class="-image">
                                        <img src="{{ $item->image }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="-content">
                                        <h2>{{ $item->name }}</h2>
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

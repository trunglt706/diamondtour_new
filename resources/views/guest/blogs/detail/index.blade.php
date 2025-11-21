@php
    $item = $data['blog'];
    $albums = $item->album ? json_decode($item->album) : [];
    $tags = $item->tags ? json_decode($item->tags) : [];
@endphp
@extends('guest.layout')
@section('title', get_data_lang($item, 'name'))
@section('keywords', '')
@section('description', $item->description)
@section('image', asset($item->image))
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/blogs/detail.css') }}">
@endsection

@push('head')
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "{{ get_data_lang($item, 'name') }}",
  "description": "{{ $item->description ?? Str::limit(strip_tags($item->description), 150) }}",
  "author": {
    "@type": "Person",
    "name": "Diamondtour"
  },
  "datePublished": "{{ $item->created_at->toIso8601String() }}",
  "dateModified": "{{ $item->updated_at->toIso8601String() }}",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ url()->current() }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{ config('app.name') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('/style/images/logo.png') }}"
    }
  },
  "image": {
    "@type": "ImageObject",
    "url": "{{ asset($item->image) }}",
    "width": 1200,
    "height": 630
  }
}
</script>
@endpush

@section('content')
    <section class="main-content">
        <div class="wrapper home blogs-detail">
            <div class="widget-slider-blogs-style-1">
                <div class="container">
                    {{-- start albums --}}
                    @include('guest.blogs.detail.albums')
                    {{-- end albums --}}

                    <h1 class="mt-4 text-uppercase text-center">{{ get_data_lang($item, 'name') }}</h1>
                    <div class="content">
                        {!! $item->content !!}
                    </div>
                    <div class="block-single-post-bottom">
                        <div class="row row-cols-1 row-cols-sm-2">
                            <div class="col">
                                @if (count($tags) > 0)
                                    <div class="-post-tags">
                                        <h2>@lang('messages.tu_khoa_lien_ket')</h2>
                                        <ul>
                                            @foreach ($tags as $item)
                                                <li>
                                                    <a href="{{ route('search') }}?t=blog&q={{ $item }}">
                                                        {{ $item }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col">
                                <div class="-post-tags -social text-end">
                                    <h2>@lang('messages.chia_se_bai_viet')</h2>
                                    <div class="sharethis-inline-share-buttons"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- start others --}}
            @include('guest.blogs.detail.others')
            {{-- end others --}}
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('/style/js/travel-detail.js') }}"></script>
    <script src="{{ asset('/style/js/post.js') }}"></script>
    <script src="{{ asset('/style/js/blogs.js') }}"></script>
    <script src="{{ asset('/style/js/blogs-detail.js') }}"></script>
@endsection

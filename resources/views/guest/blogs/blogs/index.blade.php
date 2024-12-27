@extends('guest.layout')
@section('title', 'Blogs')
@section('keywords', '')
@section('description', '')
@section('image', '')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <style>
        @media (max-width: 932px) {

            .main-content {
                padding-top: 50px;
            }

            .widget-blog-style-1 .header-title p.title {
                font-size: 26px !important;
            }
        }
    </style>
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home blogs">
            {{-- start importants --}}
            @include('guest.blogs.blogs.importants')
            {{-- end importants --}}

            {{-- start guests --}}
            @include('guest.blogs.blogs.guests')
            {{-- end guests --}}

            {{-- start news --}}
            @include('guest.blogs.blogs.news')
            {{-- end news --}}

            {{-- start shares --}}
            @include('guest.blogs.blogs.shares')
            {{-- end shares --}}
        </div>
    </section>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('/style/js/travel-detail.js') }}"></script>
    <script src="{{ asset('/style/js/post.js') }}"></script>
    <script src="{{ asset('/style/js/blogs.js') }}"></script>
    <script src="{{ asset('/style/js/blogs-detail.js') }}"></script>
@endsection

@extends('guest.layout')
@section('title', 'Blogs')
@section('keywords', '')
@section('description', '')
@section('image', '')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/blogs/blogs.css') }}">
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
    <script src="{{ asset('/style/js/travel-detail.js') }}"></script>
    <script src="{{ asset('/style/js/post.js') }}"></script>
    <script src="{{ asset('/style/js/blogs.js') }}"></script>
    <script src="{{ asset('/style/js/blogs-detail.js') }}"></script>
@endsection

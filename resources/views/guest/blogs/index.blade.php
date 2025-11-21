@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/blogs/index.css') }}">
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home post">
            {{-- start slider --}}
            @include('guest.blogs.sliders')
            {{-- end slider --}}

            <div class="container">
                {{-- start news --}}
                @include('guest.blogs.news')
                {{-- end news --}}

                {{-- start favorits --}}
                @include('guest.blogs.favorits')
                {{-- end favorits --}}

                {{-- start ads --}}
                @include('guest.blogs.ads')
                {{-- end ads --}}

                {{-- start viewers --}}
                @include('guest.blogs.viewers')
                {{-- end viewers --}}
            </div>

            {{-- start newletter --}}
            @include('guest.blogs.newletter')
            {{-- end newletter --}}

            <div class="container">

                {{-- start hot --}}
                @include('guest.blogs.hot')
                {{-- end hot --}}

                {{-- start importants --}}
                @include('guest.blogs.importants')
                {{-- end importants --}}
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('/style/js/travel-detail.js') }}"></script>
    <script src="{{ asset('/style/js/post.js') }}"></script>
    <script src="{{ asset('/style/js/blogs.js') }}"></script>
    <script src="{{ asset('/style/js/blogs-detail.js') }}"></script>
@endsection

@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/album/index.css') }}">
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home album">
            {{-- start slider --}}
            @include('guest.album.sliders')
            {{-- end slider --}}

            {{-- start news --}}
            @include('guest.album.news')
            {{-- end news --}}

            {{-- start hot --}}
            @include('guest.album.hot')
            {{-- end hot --}}

            {{-- start important --}}
            @include('guest.album.important')
            {{-- end important --}}

            {{-- start like --}}
            @include('guest.album.like')
            {{-- end like --}}

            {{-- start guests --}}
            @include('guest.album.guests')
            {{-- end guests --}}

            {{-- start view --}}
            @include('guest.album.view')
            {{-- end view --}}
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('/style/js/album.js') }}"></script>
    <script src="{{ asset('/style/js/list-album.js') }}"></script>
@endsection

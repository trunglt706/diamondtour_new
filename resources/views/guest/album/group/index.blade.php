@extends('guest.layout')
@section('title', get_data_lang($data['tour_group'], 'name'))
@section('keywords', '')
@section('description', $data['tour_group']->description)
@section('image', asset($data['tour_group']->image))
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/album/group.css') }}">
@endsection
@section('content')
    <section class="main-content">
        {{-- start banners --}}
        @include('guest.album.group.banners')
        {{-- end banners --}}

        {{-- start report --}}
        {{-- @include('guest.album.group.report') --}}
        {{-- end report --}}

        {{-- start video --}}
        @include('guest.album.group.video')
        {{-- end video --}}

        {{-- start likes --}}
        @include('guest.album.group.likes')
        {{-- end likes --}}

        {{-- start news --}}
        @include('guest.album.group.news')
        {{-- end news --}}

        {{-- start seasons --}}
        @include('guest.album.group.seasons')
        {{-- end seasons --}}

    </section>
@endsection
@section('script')
    <script src="{{ asset('/style/js/list-album.js') }}"></script>
    <script src="{{ asset('/style/js/album.js') }}"></script>
@endsection

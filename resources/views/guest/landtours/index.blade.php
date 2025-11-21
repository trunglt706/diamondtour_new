@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/landtours/index.css') }}">
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home travel">
            {{-- start slider --}}
            @include('guest.landtours.sliders')
            {{-- end slider --}}

            {{-- start blog --}}
            @include('guest.tours.blogs')
            {{-- end blog --}}

            {{-- start tour --}}
            @include('guest.tours.tours')
            {{-- end tour --}}

            {{-- start design --}}
            @include('guest.tours.design')
            {{-- end design --}}

            {{-- start seasonal tour --}}
            @include('guest.tours.seasonal_tours')
            {{-- end seasonal tour --}}

            {{-- start activity --}}
            @include('guest.tours.activity')
            {{-- end activity --}}

            {{-- start faq --}}
            @include('guest.tours.faq')
            {{-- end faq --}}
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('/style/js/home.js') }}"></script>
@endsection

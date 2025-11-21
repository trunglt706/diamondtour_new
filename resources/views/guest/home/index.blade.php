@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/home/index.css') }}">
@endsection

@push('head')
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "{{ config('app.name') }}",
  "url": "{{ url('/') }}",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{{ url('/search?q={search_term_string}') }}",
    "query-input": "required name=search_term_string"
  }
}
</script>
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "TravelAgency",
  "name": "Công ty cổ phần đầu tư và phát triển du lịch Kim Cương - Diamondtour",
  "description": "Diamondtour luôn bám vững theo tiêu chí đặt khách hàng là trung tâm, minh bạch và đề cao chất lượng dịch vụ.",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('/style/images/logo.png') }}",
  "telephone": "+84912115515",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Số 15 ngõ 1, phố Phan Huy Chú, Yết Kiêu, Hà Đông, Hà Nội",
    "addressLocality": "Hà Nội",
    "addressRegion": "Hà Nội",
    "postalCode": "12111",
    "addressCountry": "VN"
  },
  "openingHours": "Mo-Fr 09:00-18:00",
  "sameAs": [
    "https://m.me/diamondtourvn",
    "https://zalo.me/0905615666"
  ]
}
</script>
@endpush

@section('content')
    <section class="main-content">
        <div class="wrapper home">
            {{-- start slider --}}
            @include('guest.home.sliders')
            {{-- end slider --}}

            {{-- start toolbar --}}
            @include('guest.home.toolbar')
            {{-- end toolbar --}}

            {{-- start blog --}}
            @include('guest.home.blogs')
            {{-- end blog --}}

            {{-- start tour --}}
            @include('guest.home.tours')
            {{-- end tour --}}

            {{-- start seasonal tour --}}
            @include('guest.home.seasonal_tours')
            {{-- end seasonal tour --}}

            {{-- start why us --}}
            @include('guest.home.why_us')
            {{-- end why us --}}

            {{-- start event --}}
            @include('guest.home.event')
            {{-- end event --}}

            {{-- start feedback --}}
            @include('guest.home.feedbacks')
            {{-- end feedback --}}

            {{-- start cam nang --}}
            @include('guest.home.cam_nang')
            {{-- end cam nang --}}
        </div>
    </section>
@endsection
@section('script')
    <script>
        const url = "{{ route('search') }}";
        const startDate = "{{ request()->get('start') }}";
        const endDate = "{{ request()->get('end') }}";
    </script>
    <script src="{{ asset('style/js/home/index.js') }}"></script>
    <script src="{{ asset('/style/js/home.js') }}"></script>
@endsection

@php
    $description = $locale == 'vi' ? 'description' : 'description_' . $locale;
    $_description = $data['menu']->$description ?? $data['menu']->description;
    $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_name = $data['menu']->$name ?? $data['menu']->name;
@endphp
@extends('index')
@section('content')
    <style>
        .box-image-row-single-page .col-right {
            margin-top: -36%;
        }
    </style>
    <article>
        @include('pages.blocks.breadcrumb', [
            'background' => $data['menu']->background,
            'title' => $_name,
            'description' => $_description,
        ])`
        <section>
            <div class="box-wrapper-single-page">
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-2 gx-4">
                        <div class="col">
                            <h2 class="single-page-head-title">@lang('messages.gioi_thieu')</h2>
                            <div class="single-page-head-content">
                                {!! $seo['about-content'] !!}
                            </div>
                        </div>
                        @include('pages.blocks.tour-guide')
                    </div>
                </div>
            </div>
            @php
                $about_images = $seo['about-images'];
                $about_images = $about_images ? json_decode($about_images) : [];
            @endphp
            @if (count($about_images) >= 3)
                <div class="box-image-row-single-page">
                    <div class="col-left" style="background-image: url({{ get_url($about_images[0]) }})">
                    </div>
                    <div class="col-right" style="background-image: url({{ get_url($about_images[1]) }})">
                    </div>
                </div>
                <div class="box-image-row-single-page d-sm-block d-none">
                    <div class="col-right-content">
                        <div class="container-fluid">
                            <div class="row row-cols-2 gx-4">
                                <div class="col">
                                    <div class="-image-child-item">
                                        <img loading="lazy" src="{{ get_url($about_images[2]) }}" class="img-fluid"
                                            alt="@lang('messages.gioi_thieu')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
        @include('pages.blocks.distinctive-value')
        @include('pages.blocks.companion-private')
        <div class="companion-home"></div>
        <div class="tours-home"></div>
    </article>
@endsection

@section('script_module')
    <script type="text/javascript">
        load_companion();
        load_tours();

        function load_companion() {
            $.ajax({
                method: "GET",
                url: "{{ route('home.load_companion') }}",
                async: true,
                success: function(rs) {
                    $('.companion-home').html(rs);
                },
            });
        }

        function load_tours() {
            $.ajax({
                method: "GET",
                url: "{{ route('home.load_tours') }}?type=about",
                async: true,
                success: function(rs) {
                    $('.tours-home').html(rs);
                },
            });
        }
    </script>
@endsection

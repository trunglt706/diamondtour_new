@extends('index')
@section('content')
    <article>
        @include('pages.blocks.breadcrumb', [
            'background' => asset('assets/images/bg_blog.png'),
            'title' => 'Điểm đến',
            'description' => 'Các địa danh thú vị',
        ])

        <section>
            <div class="box-wrapper-destination">
                <div class="container">
                    <div class="block-list-by-country">
                        <div class="block-section-header">
                            <h2>The Most Favorite Destination in Asia</h2>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                                Aenean massa.</p>
                        </div>
                        <div class="block-discovery-list">
                            <div class="row gx-3 gy-3 gx-lg-4 gy-lg-4">
                                @for ($i = 0; $i < 6; $i++)
                                    <div class="col-sm-6 col-md-4">
                                        <a href="{{ route('destination.detail', ['alias' => $i]) }}"
                                            class="discovery-tour-item"
                                            style="background-image: url({{ asset('assets/images/tour-discovery-1.jpg') }})">
                                            <h3>Tây Tạng</h3>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="block-list-by-sites">
                        <div class="container">
                            <div class="block-section-header text-center">
                                <h2>Find Out The Best Travel Choice in Asia</h2>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa.</p>
                            </div>
                            <div class="block-destination-header">
                                <ul class="nav nav-pills justify-content-center" id="pills-destination-home" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-destination-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-destination" type="button" role="tab"
                                            aria-controls="pills-destination" aria-selected="true">DESTINATION</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="block-destination-content">
                                <div class="tab-content" id="pills-destination-home-content">
                                    <div class="tab-pane fade show active" id="pills-destination" role="tabpanel"
                                        aria-labelledby="pills-destination-tab" tabindex="0">
                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 gx-5">
                                            @for ($i = 0; $i < 8; $i++)
                                                <div class="col">
                                                    <a href="{{ route('blog.detail', ['alias' => $i]) }}"
                                                        class="destination-home-item"
                                                        style="background-image: url({{ asset('assets/images/destination-home-1.jpg') }})">
                                                        <div class="-content">
                                                            <div class="-info">
                                                                <h2>Chùa Samye</h2>
                                                                <p><i
                                                                        class="fa-solid fa-location-dot d-inline-block me-2"></i>
                                                                    Tây Tạng</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('pages.blocks.faq-home')
        {{-- @include('pages.blocks.distinctive-value') --}}
        <section>
            <div class="box-distinctive-value">
                <div class="container">
                    <div class="distinctive-value--header">
                        <h2>We Are The Most Popular Travel & Tour Company</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                            mus.</p>
                    </div>
                    <div class="distinctive-value--content">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gx-4">
                            <div class="col">
                                <div class="distinctive-value-item">
                                    <div class="-image">
                                        <img src="{{ asset('assets/images/distinctive-value-1.png') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="-content">Giá tour cạnh tranh, linh hoạt</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="distinctive-value-item">
                                    <div class="-image">
                                        <img src="{{ asset('assets/images/distinctive-value-2.png') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="-content">Chất lượng hàng đầu</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="distinctive-value-item">
                                    <div class="-image">
                                        <img src="{{ asset('assets/images/distinctive-value-3.png') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="-content">Trách nhiệm, tận tâm cao</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="distinctive-other-image row gx-5">
                        <div class="col-md-8">
                            <div class="-image">
                                <img src="{{ asset('assets/images/other-image-distinctive-1.jpg') }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="-image">
                                <img src="{{ asset('assets/images/other-image-distinctive-2.jpg') }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('pages.blocks.newsletter')

    </article>
@endsection

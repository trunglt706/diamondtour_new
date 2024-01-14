@extends('index')
@section('content')
    <article>
        <section>
            <div class="box-slider-home">
                <div class="swiper carousel-home-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="carousel-home--item animate-ken-burns animate-ken-burns--in">
                                <img src="{{ asset('assets/images/slider.png" ') }}" alt="" class="img-fluid">
                                <div class="-content">
                                    <div class="-tag">
                                        <ul>
                                            <li><a href="#">Feel The Experience</a></li>
                                            <li><a href="#">123</a></li>
                                        </ul>
                                    </div>
                                    <h2>Explore The Majestic Asia Landscape Now</h2>
                                    <a href="#" class="btn btn-view">Explore</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="carousel-home--item animate-ken-burns animate-ken-burns--in">
                                <img src="{{ asset('assets/images/slider-1.jpg') }}" alt="" class="img-fluid">
                                <div class="-content">
                                    <div class="-tag">
                                        <ul>
                                            <li><a href="#">Feel The Experience</a></li>
                                        </ul>
                                    </div>
                                    <h2>Explore The Majestic Asia Landscape Now</h2>
                                    <a href="#" class="btn btn-view">Explore</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="carousel-home--item animate-ken-burns animate-ken-burns--in">
                                <img src="{{ asset('assets/images/slider-2.jpg') }}" alt="" class="img-fluid">
                                <div class="-content">
                                    <div class="-tag">
                                        <ul>
                                            <li><a href="#">Feel The Experience</a></li>
                                        </ul>
                                    </div>
                                    <h2>Explore The Majestic Asia Landscape Now</h2>
                                    <a href="#" class="btn btn-view">Explore</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="carousel-home--item animate-ken-burns animate-ken-burns--in">
                                <img src="{{ asset('assets/images/slider-1.jpg') }}" alt="" class="img-fluid">
                                <div class="-content">
                                    <div class="-tag">
                                        <ul>
                                            <li><a href="#">Feel The Experience</a></li>
                                        </ul>
                                    </div>
                                    <h2>Explore The Majestic Asia Landscape Now</h2>
                                    <a href="#" class="btn btn-view">Explore</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="carousel-home--item animate-ken-burns animate-ken-burns--in">
                                <img src="{{ asset('assets/images/slider-2.jpg') }}" alt="" class="img-fluid">
                                <div class="-content">
                                    <div class="-tag">
                                        <ul>
                                            <li><a href="#">Feel The Experience</a></li>
                                        </ul>
                                    </div>
                                    <h2>Explore The Majestic Asia Landscape Now</h2>
                                    <a href="#" class="btn btn-view">Explore</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-wrapper-widget">
                        <ul class="-social">
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-square-facebook"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                        <div class="scroll-top-sec">
                            <a href="#sec-tour-home" data-text="SCROLL">
                                <img src="{{ asset('assets/images/arrow-down.png') }}" class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="sec-tour-home">
            <div class="box-tour-home">
                <div class="container">
                    <div id="section-tour-home--content" class="section-tour-home--content">
                        <div class="th-grid-sizer"></div>
                        <div class="th-grid-item size-w-33 size-h-672">
                            <a href="#" class="tour-home--item"
                                style="background-image: url({{ asset('assets/images/tour_home_1.png') }});">
                                <div class="-content">
                                    <h2>Silk Road</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                                </div>
                            </a>
                        </div>
                        <div class="th-grid-item size-w-33 size-h-320">
                            <a href="#" class="tour-home--item"
                                style="background-image: url({{ asset('assets/images/tour_home_2.png') }});">
                                <div class="-content">
                                    <h2>Picture of China</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                                </div>
                            </a>
                        </div>
                        <div class="th-grid-item size-w-33 size-h-320">
                            <a href="#" class="tour-home--item"
                                style="background-image: url({{ asset('assets/images/tour_home_3.png') }});">
                                <div class="-content">
                                    <h2>Pilgrimage - Buddhist relics</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                                </div>
                            </a>
                        </div>
                        <div class="th-grid-item size-w-66 size-h-320">
                            <a href="#" class="tour-home--item"
                                style="background-image: url({{ asset('assets/images/tour_home_4.png') }});">
                                <div class="-content">
                                    <h2>Himalaya Culture</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('pages.blocks.companion')
        @include('pages.blocks.discovery-home')
        @include('pages.blocks.about-home')
        @include('pages.blocks.destination-home')
        @include('pages.blocks.faq-home')
        @include('pages.blocks.post-home')
        @include('pages.blocks.newsletter')
    </article>
@endsection

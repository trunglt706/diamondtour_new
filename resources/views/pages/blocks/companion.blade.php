<section>
    <div class="box-companion">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4">
                    <div class="block-companion-content">
                        <h2>{{ $seo['dong_hanh-title'] }}</h2>
                        <p>{{ $seo['dong_hanh-description'] }}</p>
                        <div class="block-companion-list">
                            <div class="companion-item">
                                <div class="-image">
                                    <img loading="lazy" src="{{ get_url('assets/images/companion-icon-1.png') }}"
                                        class="img-fluid" width="50px" height="50px" alt="image">
                                </div>
                                <div class="-content">
                                    <h3>{{ $seo['dong_hanh-title_1'] }}</h3>
                                    <p>{{ $seo['dong_hanh-content_1'] }}</p>
                                </div>
                            </div>
                            <div class="companion-item">
                                <div class="-image">
                                    <img loading="lazy" src="{{ get_url('assets/images/companion-icon-2.png') }}"
                                        class="img-fluid" width="50px" height="50px" alt="image">
                                </div>
                                <div class="-content">
                                    <h3>{{ $seo['dong_hanh-title_2'] }}</h3>
                                    <p>{{ $seo['dong_hanh-content_2'] }}</p>
                                </div>
                            </div>
                            <div class="companion-item">
                                <div class="-image">
                                    <img loading="lazy" src="{{ get_url('assets/images/companion-icon-3.png') }}"
                                        class="img-fluid" width="50px" height="50px" alt="image">
                                </div>
                                <div class="-content">
                                    <h3>{{ $seo['dong_hanh-title_3'] }}</h3>
                                    <p>{{ $seo['dong_hanh-content_3'] }}</p>
                                </div>
                            </div>
                            <div class="companion-item">
                                <div class="-image">
                                    <img loading="lazy" src="{{ get_url('assets/images/companion-icon-4.png') }}"
                                        class="img-fluid" width="50px" height="50px" alt="image">
                                </div>
                                <div class="-content">
                                    <h3>{{ $seo['dong_hanh-title_4'] }}</h3>
                                    <p>{{ $seo['dong_hanh-content_4'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="block-companion-banner">
                        <img loading="lazy" src="{{ get_url($seo['dong_hanh-background']) }}" class="img-fluid"
                            alt="image">
                        <div class="overlay-content">
                            <div class="row justify-content-end">
                                <div class="col-sm-4">
                                    <a href="{{ $seo['dong_hanh-video_1'] }}" data-fancybox="video-gallery"
                                        class="image-overlay-item">
                                        <div class="-image"
                                            style="background-image: url({{ get_url($seo['dong_hanh-thum-video-1']) }})">
                                            <div class="-icon"><i class="fa-solid fa-play"></i></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="{{ $seo['dong_hanh-video_2'] }}" data-fancybox="video-gallery"
                                        class="image-overlay-item">
                                        <div class="-image"
                                            style="background-image: url({{ get_url($seo['dong_hanh-thum-video-2']) }})">
                                            <div class="-icon"><i class="fa-solid fa-play"></i></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

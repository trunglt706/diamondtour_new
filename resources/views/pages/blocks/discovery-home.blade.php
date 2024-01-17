<section>
    <div class="box-discovery-home">
        <div class="discovery-home--header">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 gx-4">
                    <div class="col">
                        <h2>Discover A Mesmerizing Nature Landscape & Stunning Culture</h2>
                    </div>
                    <div class="col">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
                        <a href="#" class="btn btn-more">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-portfolio-gallery-container">
            <div class="row-items row row-cols-2 row-cols-md-5 g-0">
                <div class="col">
                    <div class="discovery-home-item" data-tab="portfolio-gallery-tab-0">
                        <div class="-content">
                            <p>visit</p>
                            <h2>Tây Tạng</h2>
                        </div>
                        <div class="-content-more">
                            <a href="#">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="discovery-home-item" data-tab="portfolio-gallery-tab-1">
                        <div class="-content">
                            <p>visit</p>
                            <h2>Trung Quốc</h2>
                        </div>
                        <div class="-content-more">
                            <a href="#">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="discovery-home-item" data-tab="portfolio-gallery-tab-2">
                        <div class="-content">
                            <p>visit</p>
                            <h2>Ấn Độ</h2>
                        </div>
                        <div class="-content-more">
                            <a href="#">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="discovery-home-item" data-tab="portfolio-gallery-tab-3">
                        <div class="-content">
                            <p>visit</p>
                            <h2>Pakistan</h2>
                        </div>
                        <div class="-content-more">
                            <a href="#">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="discovery-home-item" data-tab="portfolio-gallery-tab-4">
                        <div class="-content">
                            <p>visit</p>
                            <h2>Nepal</h2>
                        </div>
                        <div class="-content-more">
                            <a href="#">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gallery-items">
                <div id="portfolio-gallery-tab-0" class="image-item"
                    data-background="{{ asset('assets/images/destination-home-pv-1.jpg') }}"
                    style="background-image:url({{ asset('assets/images/destination-home-pv-1.jpg') }});"></div>
                <div id="portfolio-gallery-tab-1" class="image-item"
                    data-background="{{ asset('assets/images/destination-home-pv-2.jpg') }}"
                    style="background-image:url({{ asset('assets/images/destination-home-pv-2.jpg') }});"></div>
                <div id="portfolio-gallery-tab-2" class="image-item"
                    data-background="{{ asset('assets/images/destination-home-pv-3.jpg') }}"
                    style="background-image:url({{ asset('assets/images/destination-home-pv-3.jpg') }});"></div>
                <div id="portfolio-gallery-tab-3" class="image-item"
                    data-background="{{ asset('assets/images/destination-home-pv-4.jpg') }}"
                    style="background-image:url({{ asset('assets/images/destination-home-pv-4.jpg') }});"></div>
                <div id="portfolio-gallery-tab-4" class="image-item"
                    data-background="{{ asset('assets/images/destination-home-pv-5.jpg') }}"
                    style="background-image:url({{ asset('assets/images/destination-home-pv-5.jpg') }});"></div>
            </div>
        </div>
        @include('pages.blocks.testimonial')
    </div>
</section>

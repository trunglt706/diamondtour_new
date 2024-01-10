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
              <a href="#" class="tour-home--item" style="background-image: url({{ asset('assets/images/tour_home_1.png')}});">
                <div class="-content">
                  <h2>Silk Road</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                </div>
              </a>
            </div>
            <div class="th-grid-item size-w-33 size-h-320">
              <a href="#" class="tour-home--item" style="background-image: url({{ asset('assets/images/tour_home_2.png')}});">
                <div class="-content">
                  <h2>Picture of China</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                </div>
              </a>
            </div>
            <div class="th-grid-item size-w-33 size-h-320">
              <a href="#" class="tour-home--item" style="background-image: url({{ asset('assets/images/tour_home_3.png')}});">
                <div class="-content">
                  <h2>Pilgrimage - Buddhist relics</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                </div>
              </a>
            </div>
            <div class="th-grid-item size-w-66 size-h-320">
              <a href="#" class="tour-home--item" style="background-image: url({{ asset('assets/images/tour_home_4.png')}});">
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
    <section>
      <div class="box-introduce">
        <div class="container">
          <div class="row gx-5">
            <div class="col-md-6">
              <h2>Travel beyond And Above your Expectations</h2>
            </div>
            <div class="col-md-6">
              <div class="-content">
                <p>Donec mattis, nulla at tincidunt finibus, dolor dui bibendum tellus, eget placerat purus dolor vitae ipsum. Vestibulum rutrum rhoncus porta. Sed in magna pretium, imperdiet massa nec, iaculis velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris vitae purus turpis. Etiam in justo mi.</p>
                <p>Vestibulum dignissim, elit ut pharetra hendrerit, massa ex ultrices nulla, tempor ornare nisl magna eu ipsum. Etiam id convallis neque. Fusce tempus iaculis leo sed laoreet. Nam fermentum non urna eget bibendum. Suspendisse commodo dapibus justo, viverra laoreet dolor aliquet nec.</p>
              </div>
            </div>
          </div>
          <div class="row gx-5">
            <div class="col-md-6">
              <div class="-cover">
                <img src="{{ asset('assets/images/introduce_1.png')}}" alt="" class="img-fluid">
              </div>
            </div>
            <div class="col-md-6">
              <div class="thumb row row-cols-2">
                <div class="col">
                  <div class="thumb-item">
                    <img src="{{ asset('assets/images/introduce_2.png')}}" alt="" class="img-fluid">
                  </div>
                </div>
                <div class="col">
                  <div class="thumb-item">
                    <img src="{{ asset('assets/images/introduce_3.png')}}" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="box-destinations">
        <div class="container">
          <div class="block-destinations-header">
            <h2>Destinations</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
          </div>
        </div>
        <div class="container-fluid">
          <div class="row block-destinations-content">
            <div class="swiper destinations-swiper">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" class="destinations-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/destinations_item.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                    </div>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" class="destinations-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/destinations_item.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                    </div>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" class="destinations-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/destinations_item.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                    </div>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" class="destinations-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/destinations_item.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                    </div>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" class="destinations-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/destinations_item.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                    </div>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" class="destinations-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/destinations_item.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @include('pages.blocks.newsletter')
  </article>
@endsection

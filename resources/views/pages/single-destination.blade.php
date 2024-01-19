@extends('index')
@section('content')
    <article class="article-wrapper-single-tour">
        @include('pages.blocks.breadcrumb', [
            'background' => asset('assets/images/bg-destination-single.png'),
            'title' => 'Chi tiết destination',
            'description' => 'Ha Long Bay, Vietnam',
        ])
        <section>
          <div class="box-wrapper-single-destination">
            <div class="box-image-row-single-destination">
              <div class="col-left" style="background-image: url({{ asset('assets/images/bg-destination-single.png') }})">
                <div class="overlay-content container">
                  <div class="row justify-content-end">
                    <div class="col-lg-6">
                      <div class="--content">
                        <h2>Ha Long Bay, Vietnam</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-address-row-single-destination">
              <div class="container">
                <div class="row row-cols-1 row-cols-lg-2">
                  <div class="col">
                    <div class="-content">
                      <h2>Where is Bhutan?</h2>
                      <div class="-desc">
                        <p>Morbi mollis odio ut tellus lacinia, vitae rutrum est pharetra. Etiam velit lorem, varius at libero eget, lacinia convallis nisl. Quisque nec enim est. Pellentesque consequat commodo leo eget mollis. Sed consequat vel sem a vestibulum. Sed accumsan ullamcorper sapien, vitae venenatis lorem porta a. Integer risus lacus, dapibus sed interdum a, posuere at ligula. Morbi dapibus eget nunc eu ultricies. Ut nec risus ut quam rhoncus vehicula. Suspendisse tincidunt tincidunt dictum. Suspendisse vestibulum libero justo, a condimentum nisi fermentum vel. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque nec diam consequat, ultrices massa sit amet, ultrices arcu. Proin sed sapien at leo dapibus feugiat.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec commodo aliquet lobortis. Donec accumsan risus a nisi faucibus scelerisque. Nullam ultrices vulputate pretium. Donec molestie vel mi quis dapibus. Nulla facilisi. Pellentesque efficitur sit amet erat quis cursus. Vestibulum sed turpis in nibh placerat molestie sit amet vitae ipsum. Fusce lacus mauris, feugiat non tortor ac, mollis lobortis libero. Integer suscipit velit libero, a convallis purus maximus eu. Maecenas enim ex, faucibus ut finibus eget, facilisis sit amet ligula. Etiam sed purus ac diam hendrerit porta. Sed posuere, justo non rhoncus pretium, neque neque tempor ex, nec fermentum enim nulla venenatis risus. Proin eleifend velit a erat rhoncus, nec pulvinar ante rutrum. Praesent eu lorem sapien. Nam sed pulvinar nulla</p>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="-image">
                      <img src="{{ asset('assets/images/address-single-destination.png') }}" class="img-fluid" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-reason-row-single-destination" style="background-image: url({{ asset('assets/images/bg-destination-single.png') }});">
              <div class="container">
                <div class="block-section-header">
                  <h2>Why should be Bhutan?</h2>
                </div>
                <div class="swiper reason-slider-swiper">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="reason-item">
                        <h2>Reason 1</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="reason-item">
                        <h2>Reason 2</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="reason-item">
                        <h2>Reason 3</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="reason-item">
                        <h2>Reason 4</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="reason-item">
                        <h2>Reason 5</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-navigation">
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
              </div>
            </div>
            <div class="box-pricing-row-single-destination">
              <div class="container">
                <div class="block-section-header">
                  <h2>Pricing and Plans</h2>
                </div>
                <div class="row row-cols-1 row-cols-lg-2">
                  <div class="col">
                    <div class="-pricing-left-content">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>
                      <div class="row row-cols-1 row-cols-sm-2">
                        <div class="col">
                          <div class="-pricing-image-item">
                            <img src="{{ asset('assets/images/slider.png') }}" class="img-fluid" alt="">
                          </div>
                        </div>
                        <div class="col">
                          <div class="-pricing-image-item">
                            <img src="{{ asset('assets/images/slider-1.jpg') }}" class="img-fluid" alt="">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="-pricing-right-content">
                      <p>Morbi mollis odio ut tellus lacinia, vitae rutrum est pharetra. Etiam velit lorem, varius at libero eget, lacinia convallis nisl. Quisque nec enim est. Pellentesque consequat commodo leo eget mollis. Sed consequat vel sem a vestibulum. Sed accumsan ullamcorper sapien, vitae venenatis lorem porta a. Integer risus lacus, dapibus sed interdum a, posuere at ligula. Morbi dapibus eget nunc eu ultricies. Ut nec risus ut quam rhoncus vehicula. Suspendisse tincidunt tincidunt dictum. Suspendisse vestibulum libero justo, a condimentum nisi fermentum vel. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque nec diam consequat, ultrices massa sit amet, ultrices arcu. Proin sed sapien at leo dapibus feugiat.</p>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec commodo aliquet lobortis. Donec accumsan risus a nisi faucibus scelerisque. Nullam ultrices vulputate pretium. Donec molestie vel mi quis dapibus. Nulla facilisi. Pellentesque efficitur sit amet erat quis cursus. Vestibulum sed turpis in nibh placerat molestie sit amet vitae ipsum. Fusce lacus mauris, feugiat non tortor ac, mollis lobortis libero. Integer suscipit velit libero, a convallis purus maximus eu. Maecenas enim ex, faucibus ut finibus eget, facilisis sit amet ligula. Etiam sed purus ac diam hendrerit porta. Sed posuere, justo non rhoncus pretium, neque neque tempor ex, nec fermentum enim nulla venenatis risus. Proin eleifend velit a erat rhoncus, nec pulvinar ante rutrum. Praesent eu lorem sapien. Nam sed pulvinar nulla.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-testimonial-row-single-destination">
              <div class="container">
                <div class="row row-cols-1 row-cols-md-2">
                  <div class="col">
                    <div class="block-section-header">
                      <h2>What people talk about us</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>
                    </div>
                    <div class="-list-testimonial row row-cols-1 row-cols-lg-2">
                      <div class="col">
                        <div class="testimonial-item">
                          <div class="comment-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
                          </div>
                          <div class="comment-bio">
                            <div class="profile-image">
                              <img decoding="async" src="{{ asset('assets/images/testimonial-item.jpg') }}" alt="Louna Daniel">
                            </div>
                            <span class="profile-info">
                              <strong class="profile-name">Louna Daniel</strong>
                              <p class="profile-des">Designation</p>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="testimonial-item">
                          <div class="comment-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
                          </div>
                          <div class="comment-bio">
                            <div class="profile-image">
                              <img decoding="async" src="{{ asset('assets/images/testimonial-item.jpg') }}" alt="Louna Daniel">
                            </div>
                            <span class="profile-info">
                              <strong class="profile-name">Louna Daniel</strong>
                              <p class="profile-des">Designation</p>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="-list-testimonial row row-cols-1 row-cols-lg-2">
                      <div class="col">
                        <div class="testimonial-item">
                          <div class="comment-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
                          </div>
                          <div class="comment-bio">
                            <div class="profile-image">
                              <img decoding="async" src="{{ asset('assets/images/testimonial-item.jpg') }}" alt="Louna Daniel">
                            </div>
                            <span class="profile-info">
                              <strong class="profile-name">Louna Daniel</strong>
                              <p class="profile-des">Designation</p>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="testimonial-item">
                          <div class="comment-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
                          </div>
                          <div class="comment-bio">
                            <div class="profile-image">
                              <img decoding="async" src="{{ asset('assets/images/testimonial-item.jpg') }}" alt="Louna Daniel">
                            </div>
                            <span class="profile-info">
                              <strong class="profile-name">Louna Daniel</strong>
                              <p class="profile-des">Designation</p>
                            </span>
                          </div>
                        </div>
                      </div>
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

@extends('index')
@section('content')
  <article>
    @include('pages.blocks.breadcrumb', [
      'background'  => asset('assets/images/bg_blog.png'),
      'title'       => 'Blog',
      'description' => 'Nơi chia sẻ thông tin hành trình',
    ])

    <section>
      <div class="box-blog-header">
        <div class="container">
          <div id="section-blog-page--content" class="row gx-4 section-blog-page--content">
            <div class="blog-grid-sizer"></div>
            <div class="blog-grid-item size-w-66 size-h-596">
              <div class="blog-mansory--item" style="background-image: url({{ asset('assets/images/blog-mansory-1.png') }});">
                <div class="-content">
                  <a href="#" class="-category">Category</a>
                  <h2><a href="#">Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</a></h2>
                  <p>Nullam pellentesque bibendum justo. In lobortis vestibulum justo. Aliquam pellentesque feugiat tortor sed pellentesque. Proin ornare urna quis aliquet auctor. Sed eu quam enim. Suspendisse potenti</p>
                </div>
              </div>
            </div>
            <div class="blog-grid-item size-w-33 size-h-282">
              <div class="blog-mansory--item" style="background-image: url({{ asset('assets/images/blog-mansory-2.png') }});">
                <div class="-content">
                  <a href="#" class="-category">Category</a>
                  <h2><a href="#">Praesent nisl nibh, bibendum et erat in, iaculis molestie</a></h2>
                </div>
              </div>
            </div>
            <div class="blog-grid-item size-w-33 size-h-282">
              <div class="blog-mansory--item" style="background-image: url({{ asset('assets/images/blog-mansory-3.png') }});">
                <div class="-content">
                  <a href="#" class="-category">Category</a>
                  <h2><a href="#">Curabitur nisi tellus, tempus vitae fermentum gravida</a></h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row gx-5">
            <div class="col-md-4">
              <div class="blog-normal-item">
                <div class="block-images">
                  <a href="#"><img src="{{ asset('assets/images/blog-normal-1.png') }}" alt="" class="img-fluid"></a>
                </div>
                <div class="block-content">
                  <a href="#" class="-category">Category</a>
                  <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                  <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                  <a href="#" class="-more">Read more</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="blog-normal-item">
                <div class="block-images">
                  <a href="#"><img src="{{ asset('assets/images/blog-normal-2.png') }}" alt="" class="img-fluid"></a>
                </div>
                <div class="block-content">
                  <a href="#" class="-category">Category</a>
                  <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                  <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                  <a href="#" class="-more">Read more</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="blog-normal-item">
                <div class="block-images">
                  <a href="#"><img src="{{ asset('assets/images/blog-normal-3.png') }}" alt="" class="img-fluid"></a>
                </div>
                <div class="block-content">
                  <a href="#" class="-category">Category</a>
                  <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                  <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                  <a href="#" class="-more">Read more</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="box-pagination mb-5 mt-3">
            <nav>
              <ul class="pagination justify-content-center">
                <li class="disabled page-item"><span class="page-link"><i class="fa-solid fa-chevron-left"></i></span></li>
                <li class="active page-item"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link"><i class="fa-solid fa-chevron-right"></i></a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="box-blog-slider">
        <div class="container-fluid">
          <div class="row block-blog-slider-content">
            <div class="swiper blog-slider-swiper">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" class="blog-slider-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/blog-slider-1.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <span class="-category">Journey diary</span>
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                      <p>Nullam pellentesque bibendum justo. In lobortis vestibulum justo. Aliquam pellentesque feugiat tortor sed pellentesque. Proin ornare urna quis aliquet auctor. Sed eu quam enim. Suspendisse potenti</p>
                    </div>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" class="blog-slider-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/blog-slider-1.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <span class="-category">Journey diary</span>
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                      <p>Nullam pellentesque bibendum justo. In lobortis vestibulum justo. Aliquam pellentesque feugiat tortor sed pellentesque. Proin ornare urna quis aliquet auctor. Sed eu quam enim. Suspendisse potenti</p>
                    </div>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" class="blog-slider-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/blog-slider-1.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <span class="-category">Journey diary</span>
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                      <p>Nullam pellentesque bibendum justo. In lobortis vestibulum justo. Aliquam pellentesque feugiat tortor sed pellentesque. Proin ornare urna quis aliquet auctor. Sed eu quam enim. Suspendisse potenti</p>
                    </div>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" class="blog-slider-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/blog-slider-1.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <span class="-category">Journey diary</span>
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                      <p>Nullam pellentesque bibendum justo. In lobortis vestibulum justo. Aliquam pellentesque feugiat tortor sed pellentesque. Proin ornare urna quis aliquet auctor. Sed eu quam enim. Suspendisse potenti</p>
                    </div>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" class="blog-slider-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/blog-slider-1.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <span class="-category">Journey diary</span>
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                      <p>Nullam pellentesque bibendum justo. In lobortis vestibulum justo. Aliquam pellentesque feugiat tortor sed pellentesque. Proin ornare urna quis aliquet auctor. Sed eu quam enim. Suspendisse potenti</p>
                    </div>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" class="blog-slider-item">
                    <div class="-images">
                      <img src="{{ asset('assets/images/blog-slider-1.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="-content">
                      <span class="-category">Journey diary</span>
                      <h3>Ut aliquet magna viverra tincidunt. Suspendisse et massa vulputate</h3>
                      <p>Nullam pellentesque bibendum justo. In lobortis vestibulum justo. Aliquam pellentesque feugiat tortor sed pellentesque. Proin ornare urna quis aliquet auctor. Sed eu quam enim. Suspendisse potenti</p>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="box-handbook">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="block-handbook-header">
                <h2>Handbook - Experience</h2>
                <a href="#">Load all aricles</a>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row gx-4">
                <div class="col-md-4">
                  <div class="blog-normal-item">
                    <div class="block-images">
                      <a href="#"><img src="{{ asset('assets/images/blog-normal-1.png') }}" alt="" class="img-fluid"></a>
                    </div>
                    <div class="block-content">
                      <a href="#" class="-category">Category</a>
                      <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                      <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                      <a href="#" class="-more">Read more</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="blog-normal-item">
                    <div class="block-images">
                      <a href="#"><img src="{{ asset('assets/images/blog-normal-2.png') }}" alt="" class="img-fluid"></a>
                    </div>
                    <div class="block-content">
                      <a href="#" class="-category">Category</a>
                      <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                      <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                      <a href="#" class="-more">Read more</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="blog-normal-item">
                    <div class="block-images">
                      <a href="#"><img src="{{ asset('assets/images/blog-normal-3.png') }}" alt="" class="img-fluid"></a>
                    </div>
                    <div class="block-content">
                      <a href="#" class="-category">Category</a>
                      <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                      <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                      <a href="#" class="-more">Read more</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="box-local-culture">
        <div class="container">
          <div class="block-local-culture-header d-flex flex-wrap align-items-center justify-content-between">
            <h2>Local culture</h2>
            <a href="#">Load all aricles</a>
          </div>
          <div class="row gx-5">
            <div class="col-md-9">
              <div class="block-local-culture-post-main">
                <div class="blog-normal-item">
                  <div class="block-images">
                    <a href="#"><img src="{{ asset('assets/images/post-culture-1.png') }}" alt="" class="img-fluid"></a>
                  </div>
                  <div class="block-content">
                    <a href="#" class="-category">Category</a>
                    <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                    <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                    <a href="#" class="-more">Read more</a>
                  </div>
                </div>
                <div class="blog-normal-item">
                  <div class="block-images">
                    <a href="#"><img src="{{ asset('assets/images/post-culture-2.png') }}" alt="" class="img-fluid"></a>
                  </div>
                  <div class="block-content">
                    <a href="#" class="-category">Category</a>
                    <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                    <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                    <a href="#" class="-more">Read more</a>
                  </div>
                </div>
                <div class="blog-normal-item">
                  <div class="block-images">
                    <a href="#"><img src="{{ asset('assets/images/post-culture-3.png') }}" alt="" class="img-fluid"></a>
                  </div>
                  <div class="block-content">
                    <a href="#" class="-category">Category</a>
                    <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                    <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                    <a href="#" class="-more">Read more</a>
                  </div>
                </div>
                <div class="blog-normal-item">
                  <div class="block-images">
                    <a href="#"><img src="{{ asset('assets/images/post-culture-4.png') }}" alt="" class="img-fluid"></a>
                  </div>
                  <div class="block-content">
                    <a href="#" class="-category">Category</a>
                    <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                    <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                    <a href="#" class="-more">Read more</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="block-local-culture-post-other">
                <div class="blog-normal-item">
                  <div class="block-content">
                    <a href="#" class="-category">Category</a>
                    <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                    <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                    <a href="#" class="-more">Read more</a>
                  </div>
                </div>
                <div class="blog-normal-item">
                  <div class="block-content">
                    <a href="#" class="-category">Category</a>
                    <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                    <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                    <a href="#" class="-more">Read more</a>
                  </div>
                </div>
                <div class="blog-normal-item">
                  <div class="block-content">
                    <a href="#" class="-category">Category</a>
                    <h2>Aliquam erat volutpat. Mauris non pulvinar justo, a finibus ...</h2>
                    <p>In hac habitasse platea dictumst. Sed viverra suscipit pellentesque. Sed nec viverra lacus. Praesent eu ante vitae arcu maximus efficitur...</p>
                    <a href="#" class="-more">Read more</a>
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

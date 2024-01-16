@extends('index')
@section('content')
  <article class="article-wrapper-tour">
    @include('pages.blocks.breadcrumb', [
      'background'  => asset('assets/images/bg-tour-list.png'),
      'title'       => 'Tour',
      'description' => 'Những Tour được lựa chọn nhiều nhất',
    ])

    <section>
      <div class="box-wrapper-tour">
        <div class="block-tour-header-find">
          <div class="container">
            <form>
              <div class="card-find-tour">
                <div class="find-tour-control form-group">
                  <label for="fr-tour-continental" class="form-label">Khu vực</label>
                  <select class="selectpicker" data-style="btn btn-outline-default" data-wdith="100%" title="Chọn châu lục" name="fr-tour-continental">
                    <option value="">Đông Nam Á</option>
                    <option value="">Châu Âu</option>
                    <option value="">Châu Á</option>
                  </select>
                </div>
                <div class="find-tour-control form-group">
                  <label for="fr-tour-from" class="form-label">Từ ngày</label>
                  <div class="input-group">
                    <input type="text" id="fr-tour-from" name="fr-tour-from" class="form-control datepicker"  value="15/01/2024" autocomplete="off">
                    <div class="input-group-text">
                      <i class="far fa-calendar-alt calendar-icon"></i>
                    </div>
                  </div>
                </div>
                <div class="find-tour-control form-group">
                  <label for="fr-tour-to" class="form-label">Đến ngày</label>
                  <div class="input-group">
                    <input type="text" id="fr-tour-to" name="fr-tour-to" class="form-control datepicker"  value="15/01/2024" autocomplete="off">
                    <div class="input-group-text">
                      <i class="far fa-calendar-alt calendar-icon"></i>
                    </div>
                  </div>
                </div>
                <div class="find-tour-control form-group">
                  <label for="fr-tour-price" class="form-label">Giá trừ</label>
                  <select class="selectpicker" data-style="btn btn-outline-default" data-wdith="100%" title="Chọn mức giá" name="fr-tour-price">
                    <option value="">20$</option>
                    <option value="">20$</option>
                    <option value="">50$</option>
                    <option value="">100$</option>
                  </select>
                </div>
                <div class="find-tour-control">
                  <button type="submit" class="btn w-100 mh-50 btn-primary" name="button">Tìm kiếm</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="block-tour-list">
          <div class="container">
            <div id="section-tour--content" class="section-tour--content">
              <div class="th-grid-sizer"></div>
              <div class="th-grid-item size-w-66 size-h-320">
                <a href="#" class="tour-item" style="background-image: url({{ asset('assets/images/tour_home_2.png') }});">
                  <div class="overlay-content">
                    <div class="-content-top">
                      <div class="-inner-title">
                        <h2>Taj Mahaj</h2>
                        <small>India</small>
                      </div>
                      <div class="-inner-date">18/3-20/3</div>
                    </div>
                    <div class="-content-bottom">
                      <div class="-inner-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                      </div>
                      <div class="-inner-price">
                        <p class="-label">Start from</p>
                        <p class="-price">$32</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="th-grid-item size-w-33 size-h-320">
                <a href="#" class="tour-item" style="background-image: url({{ asset('assets/images/tour_home_3.png') }});">
                  <div class="overlay-content">
                    <div class="-content-top">
                      <div class="-inner-title">
                        <h2>Taj Mahaj</h2>
                        <small>India</small>
                      </div>
                      <div class="-inner-date">18/3-20/3</div>
                    </div>
                    <div class="-content-bottom">
                      <div class="-inner-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                      </div>
                      <div class="-inner-price">
                        <p class="-label">Start from</p>
                        <p class="-price">$32</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="th-grid-item size-w-33 size-h-672">
                <a href="#" class="tour-item" style="background-image: url({{ asset('assets/images/tour_home_1.png') }});">
                  <div class="overlay-content">
                    <div class="-content-top">
                      <div class="-inner-title">
                        <h2>Taj Mahaj</h2>
                        <small>India</small>
                      </div>
                      <div class="-inner-date">18/3-20/3</div>
                    </div>
                    <div class="-content-bottom">
                      <div class="-inner-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                      </div>
                      <div class="-inner-price">
                        <p class="-label">Start from</p>
                        <p class="-price">$32</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="th-grid-item size-w-33 size-h-320">
                <a href="#" class="tour-item" style="background-image: url({{ asset('assets/images/tour_home_2.png') }});">
                  <div class="overlay-content">
                    <div class="-content-top">
                      <div class="-inner-title">
                        <h2>Taj Mahaj</h2>
                        <small>India</small>
                      </div>
                      <div class="-inner-date">18/3-20/3</div>
                    </div>
                    <div class="-content-bottom">
                      <div class="-inner-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                      </div>
                      <div class="-inner-price">
                        <p class="-label">Start from</p>
                        <p class="-price">$32</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="th-grid-item size-w-33 size-h-320">
                <a href="#" class="tour-item" style="background-image: url({{ asset('assets/images/tour_home_3.png') }});">
                  <div class="overlay-content">
                    <div class="-content-top">
                      <div class="-inner-title">
                        <h2>Taj Mahaj</h2>
                        <small>India</small>
                      </div>
                      <div class="-inner-date">18/3-20/3</div>
                    </div>
                    <div class="-content-bottom">
                      <div class="-inner-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                      </div>
                      <div class="-inner-price">
                        <p class="-label">Start from</p>
                        <p class="-price">$32</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="th-grid-item size-w-66 size-h-320">
                <a href="#" class="tour-item" style="background-image: url({{ asset('assets/images/tour_home_4.png') }});">
                  <div class="overlay-content">
                    <div class="-content-top">
                      <div class="-inner-title">
                        <h2>Taj Mahaj</h2>
                        <small>India</small>
                      </div>
                      <div class="-inner-date">18/3-20/3</div>
                    </div>
                    <div class="-content-bottom">
                      <div class="-inner-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                      </div>
                      <div class="-inner-price">
                        <p class="-label">Start from</p>
                        <p class="-price">$32</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="th-grid-item size-w-33 size-h-320">
                <a href="#" class="tour-item" style="background-image: url({{ asset('assets/images/tour_home_2.png') }});">
                  <div class="overlay-content">
                    <div class="-content-top">
                      <div class="-inner-title">
                        <h2>Taj Mahaj</h2>
                        <small>India</small>
                      </div>
                      <div class="-inner-date">18/3-20/3</div>
                    </div>
                    <div class="-content-bottom">
                      <div class="-inner-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                      </div>
                      <div class="-inner-price">
                        <p class="-label">Start from</p>
                        <p class="-price">$32</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="th-grid-item size-w-66 size-h-320">
                <a href="#" class="tour-item" style="background-image: url({{ asset('assets/images/tour_home_3.png') }});">
                  <div class="overlay-content">
                    <div class="-content-top">
                      <div class="-inner-title">
                        <h2>Taj Mahaj</h2>
                        <small>India</small>
                      </div>
                      <div class="-inner-date">18/3-20/3</div>
                    </div>
                    <div class="-content-bottom">
                      <div class="-inner-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ...</p>
                      </div>
                      <div class="-inner-price">
                        <p class="-label">Start from</p>
                        <p class="-price">$32</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="box-pagination">
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
    </section>

    @include('pages.blocks.newsletter')

  </article>
@endsection

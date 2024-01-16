@extends('index')
@section('content')
    <article class="article-wrapper-single-tour">
        @include('pages.blocks.breadcrumb', [
            'background' => asset('assets/images/slider-1.jpg'),
            'title' => 'Chi tiết tour',
            'description' => 'NƠI KỲ QUAN HỘI TỤ: JORDAN – ISRAEL – PALESTINE',
        ])
        <section>
          <div class="box-wrapper-single-tour">
            <div class="container">
              <div class="row card-find-tour align-items-center gx-4">
                <div class="col-md-8">
                  <div class="row row-cols-1 row-cols-md-3 gx-4">
                    <div class="col">
                      <div class="tour-schedule-item">
                        <p class="-label"><i class="fa-regular fa-clock d-inline-block me-2"></i> Thời gian</p>
                        <p class="-content">9N 8Đ</p>
                      </div>
                    </div>
                    <div class="col">
                      <div class="tour-schedule-item">
                        <p class="-label"><i class="fa-regular fa-star d-inline-block me-2"></i> Chi phí</p>
                        <p class="-content">Đang cập nhật...</p>
                      </div>
                    </div>
                    <div class="col">
                      <div class="tour-schedule-item">
                        <p class="-label"><i class="fa-regular fa-calendar-days d-inline-block me-2"></i> Ngày khởi hành</p>
                        <p class="-content">Đang cập nhật...</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn w-100 btn-primary">Tải lịch trình về máy</button>
                </div>
              </div>
              <div class="single-tour-content">
                <h2>Giới thiệu</h2>
                <p>“Rất ít nơi trên trái đất khuấy động niềm đam mê khám phá như cách mà bao năm qua Trung Đông vẫn dâng tặng. Trong sa mạc mênh mang của những điều muốn trải nghiệm tại Trung Đông, cung đường Israel, Jordan, Palestine – nơi “KỲ QUAN HỘI TỤ” nổi bật như hai viên trân bảo huyền bí mà bạn nhất định cần sưu tầm trong đời. Đó không chỉ là một chuyến đi, hơn thế, là cuộc hành hương để đắm chìm vào thiên nhiên kỳ vĩ và những giá trị văn hoá, lịch sử lớn lao của nhân loại.”</p>
                <p>Jordan – được bao phủ bởi sa mạc Arabia nhưng vùng đất này là nơi giao thoa của rất nhiều nền văn hóa lớn với những câu chuyện truyền thuyết tồn tại lâu đời.</p>
                <p>Israel – lá cờ tiên phong trên thế giới trong lĩnh vực cải tạo đất hoang mạc thành đất nông nghiệp trù phú.</p>
                <p>Palestine với vị trí trung tâm của thế giới cổ đại. Palestine trở thành một cây cầu nối liền Châu Á với Châu Phi, nối Địa Trung Hải với Biển Đỏ và Đại Tây Dương với Ấn Độ Dương.</p>
              </div>
              <div class="single-tour-list-grid-destination">
                <div class="single-tour-list-col-destination">
                  <div class="single-tour-destination--item">
                    <div class="-image">
                      <img src="{{ asset('assets/images/jelusalem1.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="-content"><h2>Biển chết</h2></div>
                    <a href="{{ asset('assets/images/jelusalem1.jpg') }}" data-fancybox="gallery"></a>
                  </div>
                </div>
                <div class="single-tour-list-col-destination">
                  <div class="single-tour-destination--item">
                    <div class="-image">
                      <img src="{{ asset('assets/images/jelusalem2.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="-content"><h2>Biển chết</h2></div>
                    <a href="{{ asset('assets/images/jelusalem2.jpg') }}" data-fancybox="gallery"></a>
                  </div>
                </div>
                <div class="single-tour-list-col-destination">
                  <div class="single-tour-destination--item">
                    <div class="-image">
                      <img src="{{ asset('assets/images/jelusalem3.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="-content"><h2>Biển chết</h2></div>
                    <a href="{{ asset('assets/images/jelusalem3.jpg') }}" data-fancybox="gallery"></a>
                  </div>
                </div>
                <div class="single-tour-list-col-destination">
                  <div class="single-tour-destination--item">
                    <div class="-image">
                      <img src="{{ asset('assets/images/jelusalem4.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="-content"><h2>Biển chết</h2></div>
                    <a href="{{ asset('assets/images/jelusalem4.jpg') }}" data-fancybox="gallery"></a>
                  </div>
                </div>
                <div class="single-tour-list-col-destination">
                  <div class="single-tour-destination--item">
                    <div class="-image">
                      <img src="{{ asset('assets/images/jelusalem5.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="-content"><h2>Biển chết</h2></div>
                    <a href="{{ asset('assets/images/jelusalem5.jpg') }}" data-fancybox="gallery"></a>
                  </div>
                </div>
                <div class="single-tour-list-col-destination">
                  <div class="single-tour-destination--item">
                    <div class="-image">
                      <img src="{{ asset('assets/images/jelusalem6.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="-content"><h2>Biển chết</h2></div>
                    <a href="{{ asset('assets/images/jelusalem6.jpg') }}" data-fancybox="gallery"></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="single-tour-list-schedule">
              <div class="swiper carousel-list-schedule-swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="tour-schedule--item">
                      <div class="-image">
                        <img src="{{ asset('assets/images/jelusalem5.jpg') }}" class="img-fluid" alt="">
                        <div class="overlay-content">
                          <h2>Ngày 1</h2>
                          <p>VIỆT NAM - NAZARETH</p>
                        </div>
                      </div>
                      <div class="-content">
                        <div class="-content--header">Lịch Trình Chi Tiết</div>
                        <div class="-content--innder">
                          <div class="block-style-accordion faq-question-list">
                            <div class="accordion accordion-flush" id="accordionQuestionSectionOne">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseQuestionSectionOneOne" aria-expanded="false" aria-controls="flush-collapseQuestionSectionOneOne">
                                    <i class="fa-solid fa-location-dot d-inline-block me-2"></i> Jordan
                                  </button>
                                </h2>
                                <div id="flush-collapseQuestionSectionOneOne" class="accordion-collapse collapse" data-bs-parent="#accordionQuestionSectionOne">
                                  <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.

                                    Felis cursus efficitur. Integer eros orci, sollicitudin nec eros et, condimentum bibendum ante. Fusce efficitur efficitur risus, non fringilla tortor hendrerit sed. In eu risus tincidunt, interdum nunc sit amet, mollis lacus. Nulla nec arcu eu tellus bibendum vehicula nec eu diam. Aliquam pellentesque, leo a pulvinar tempus
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseQuestionSectionOneTwo" aria-expanded="false" aria-controls="flush-collapseQuestionSectionOneTwo">
                                    <i class="fa-solid fa-location-dot d-inline-block me-2"></i> Nhà thờ truyền tin
                                  </button>
                                </h2>
                                <div id="flush-collapseQuestionSectionOneTwo" class="accordion-collapse collapse" data-bs-parent="#accordionQuestionSectionOne">
                                  <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.

                                    Felis cursus efficitur. Integer eros orci, sollicitudin nec eros et, condimentum bibendum ante. Fusce efficitur efficitur risus, non fringilla tortor hendrerit sed. In eu risus tincidunt, interdum nunc sit amet, mollis lacus. Nulla nec arcu eu tellus bibendum vehicula nec eu diam. Aliquam pellentesque, leo a pulvinar tempus
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="tour-schedule--item">
                      <div class="-image">
                        <img src="{{ asset('assets/images/jelusalem5.jpg') }}" class="img-fluid" alt="">
                        <div class="overlay-content">
                          <h2>Ngày 1</h2>
                          <p>VIỆT NAM - NAZARETH</p>
                        </div>
                      </div>
                      <div class="-content">
                        <div class="-content--header">Lịch Trình Chi Tiết</div>
                        <div class="-content--innder">
                          <div class="block-style-accordion faq-question-list">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseQuestionSectionOneOne" aria-expanded="false" aria-controls="flush-collapseQuestionSectionOneOne">
                                    <i class="fa-solid fa-location-dot d-inline-block me-2"></i> Jordan
                                  </button>
                                </h2>
                                <div id="flush-collapseQuestionSectionOneOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.

                                    Felis cursus efficitur. Integer eros orci, sollicitudin nec eros et, condimentum bibendum ante. Fusce efficitur efficitur risus, non fringilla tortor hendrerit sed. In eu risus tincidunt, interdum nunc sit amet, mollis lacus. Nulla nec arcu eu tellus bibendum vehicula nec eu diam. Aliquam pellentesque, leo a pulvinar tempus
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseQuestionSectionOneTwo" aria-expanded="false" aria-controls="flush-collapseQuestionSectionOneTwo">
                                    <i class="fa-solid fa-location-dot d-inline-block me-2"></i> Nhà thờ truyền tin
                                  </button>
                                </h2>
                                <div id="flush-collapseQuestionSectionOneTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.

                                    Felis cursus efficitur. Integer eros orci, sollicitudin nec eros et, condimentum bibendum ante. Fusce efficitur efficitur risus, non fringilla tortor hendrerit sed. In eu risus tincidunt, interdum nunc sit amet, mollis lacus. Nulla nec arcu eu tellus bibendum vehicula nec eu diam. Aliquam pellentesque, leo a pulvinar tempus
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-navigation">
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
            <div class="block-description-single-tour">
              <div class="container">
                <div class="block-destination-header">
                  <ul class="nav nav-pills justify-content-center" id="pills-description-single-tour" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link text-uppercase active" id="pills-includes-tab" data-bs-toggle="pill" data-bs-target="#pills-includes" type="button" role="tab" aria-controls="pills-includes" aria-selected="true">Bao gồm</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link text-uppercase" id="pills-excludes-tab" data-bs-toggle="pill" data-bs-target="#pills-excludes" type="button" role="tab" aria-controls="pills-excludes" aria-selected="false">Không bao gồm</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link text-uppercase" id="pills-terms-tab" data-bs-toggle="pill" data-bs-target="#pills-terms" type="button" role="tab" aria-controls="pills-terms" aria-selected="false">Điều khoản</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link text-uppercase" id="pills-notice-tab" data-bs-toggle="pill" data-bs-target="#pills-notice" type="button" role="tab" aria-controls="pills-notice" aria-selected="false">lưu ý</button>
                    </li>
                  </ul>
                </div>
                <div class="block-destination-content">
                  <div class="tab-content" id="pills-description-single-tour-content">
                    <div class="tab-pane fade show active" id="pills-includes" role="tabpanel" aria-labelledby="pills-includes-tab" tabindex="0">
                      <h2>Sed ad rem redeamus</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id aliis narrare gestiant? At negat Epicurus-hoc enim vestrum lumen estquemquam, qui honeste non vivat, iucunde posse vivere. Hoc enim constituto in philosophia constituta sunt omnia. Omnia contraria, quos etiam insanos esse vultis. Duo Reges: constructio interrete.

                        Hic ambiguo ludimur. Aut unde est hoc contritum vetustate proverbium: quicum in tenebris? Nec mihi illud dixeris: Haec enim ipsa mihi sunt voluptati, et erant illa Torquatis. Sed ego in hoc resisto; Cum id fugiunt, re eadem defendunt, quae Peripatetici, verba. Utilitatis causa amicitia est quaesita. Atque his de rebus et splendida est eorum et illustris oratio. Certe non potest. Quae diligentissime contra Aristonem dicuntur a Chryippo. Alia quaedam dicent, credo, magna antiquorum esse peccata, quae ille veri investigandi cupidus nullo modo ferre potuerit. Facete M. Eadem nunc mea adversum te oratio est.

                        Nam si beatus umquam fuisset, beatam vitam usque ad illum a Cyro extructum rogum pertulisset.
                        Aliter enim nosmet ipsos nosse non possumus.
                        Ego vero volo in virtute vim esse quam maximam;
                        Miserum hominem! Si dolor summum malum est, dici aliter non potest.

                        Gracchum patrem non beatiorem fuisse quam fillum, cum alter stabilire rem publicam studuerit, alter evertere. An dubium est, quin virtus ita maximam partem optineat in rebus humanis, ut reliquas obruat? Hoc enim identidem dicitis, non intellegere nos quam dicatis voluptatem. Hic nihil fuit, quod quaereremus. Quacumque enim ingredimur, in aliqua historia vestigium ponimus. Longum est enim ad omnia respondere, quae a te dicta sunt. Quae si potest singula consolando levare, universa quo modo sustinebit?

                        Haec non erant eius, qui innumerabilis mundos infinitasque regiones, quarum nulla esset ora, nulla extremitas, mente peragravisset.
                        Mihi, inquam, qui te id ipsum rogavi?
                      </p>
                    </div>
                    <div class="tab-pane fade" id="pills-excludes" role="tabpanel" aria-labelledby="pills-excludes-tab" tabindex="0">

                    </div>
                    <div class="tab-pane fade" id="pills-terms" role="tabpanel" aria-labelledby="pills-excludes-tab" tabindex="0">

                    </div>
                    <div class="tab-pane fade" id="pills-notice" role="tabpanel" aria-labelledby="pills-excludes-tab" tabindex="0">

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

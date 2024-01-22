@extends('index')
@section('content')
  <article class="article-private-schedule">
    @include('pages.blocks.breadcrumb', [
      'background'  => asset('assets/images/bg_blog.png'),
      'title'       => 'Thiết kế lịch trình riêng',
      'description' => 'Thiết kế lịch trình riêng',
    ])

    <div class="box-private-schedule">
      <div class="container">
        <section class="horizontal-wizard">
          <div class="bs-stepper horizontal-wizard-example">
            <div class="bs-stepper-header" role="tablist">
              <div class="step" data-target="#private-schedule-1" role="tab" id="private-schedule-1-trigger">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-box">1</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title mb-2">Bạn muốn đi đâu?</span>
                  </span>
                </button>
              </div>
              <div class="line">
                <i class="fa-solid fa-chevron-right fa-xs"></i>
              </div>
              <div class="step" data-target="#private-schedule-2" role="tab" id="private-schedule-2-trigger">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-box">2</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title mb-2">Kế hoạch của bạn</span>
                  </span>
                </button>
              </div>
              <div class="line">
                <i class="fa-solid fa-chevron-right fa-xs"></i>
              </div>
              <div class="step" data-target="#private-schedule-3" role="tab" id="private-schedule-3-trigger">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-box">3</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title mb-2">Yêu cầu của bạn</span>
                  </span>
                </button>
              </div>
              <div class="line">
                <i class="fa-solid fa-chevron-right fa-xs"></i>
              </div>
              <div class="step" data-target="#private-schedule-4" role="tab" id="private-schedule-4-trigger">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-box">4</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title mb-2">Lưu ý của bạn</span>
                  </span>
                </button>
              </div>
              <div class="line">
                <i class="fa-solid fa-chevron-right fa-xs"></i>
              </div>
              <div class="step" data-target="#private-schedule-5" role="tab" id="private-schedule-5-trigger">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-box">5</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title mb-2">Thông tin liên hệ</span>
                  </span>
                </button>
              </div>
            </div>
            <div class="bs-stepper-content">
              <div id="private-schedule-1" class="content" role="tabpanel" aria-labelledby="private-schedule-1-trigger">
                <div class="content-header">
                  <h4 class="mb-0">Thông tin khởi hành</h4>
                </div>
                <form>
                  <label class="form-label">Bạn đang dự định đi đâu?</label>
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <select class="select2 w-100" name="region" id="region">
                        <option label=" ">Chọn theo vùng/khu vực</option>
                        <option value="1">Lộng lẫy châu Phi</option>
                        <option value="2">Huyền bí Trung Đông</option>
                        <option value="3">Đặc sắc châu Á: Stan &amp; Caucasus</option>
                        <option value="4">Hùng vỹ Himalaya</option>
                        <option value="5">Vàng son Thổ &amp; Hy Lạp</option>
                        <option value="6">Các vùng/khu vực khác</option>
                      </select>
                    </div>
                    <div class="mb-3 col-md-6">
                      <select class="select2 w-100" name="group" id="group">
                        <option label=" ">Chọn theo (nhóm) quốc gia</option>
                        <option value="35">Ai Cập - Jordan</option><option value="34">Ai Cập - Jordan - Israel - Palestine</option><option value="40">Arab Saudi  - Oman - Bahrain</option><option value="48">Các nhóm quốc gia khác</option><option value="47">Caucasus</option><option value="45">Georgia - Azerbaijan - Armernia</option><option value="44">Hy Lạp - Thổ Nhĩ Kỳ</option><option value="38">Israel  &amp; Palestine</option><option value="39">Jordan - Israel - Palestine</option><option value="37">Kenya - Madagascar</option><option value="43">Kenya - Tanzania</option><option value="36">Kenya - Tanzania</option><option value="42">Nam Phi - Namibia</option><option value="41">Oman - Bahrain</option><option value="46">Stan Countries</option>
                      </select>
                    </div>
                    <div class="mb-3 col-md-12">
                      <select class="select2 w-100" name="country" id="country">
                        <option label=" ">Chọn (các) quốc gia trong hành trình của bạn</option>
                        <option value="37">Ai Cập</option><option value="53">Arab Saudi</option><option value="55">Azerbaijan</option><option value="52">Bahrain</option><option value="41">Bhutan</option><option value="58">Caucasus</option><option value="54">Georgia</option><option value="46">Iran</option><option value="49">Israel</option><option value="45">Israel &amp; Palestine</option><option value="48">Jordan</option><option value="38">Kenya</option><option value="40">Namibia</option><option value="42">Nepal</option><option value="51">Oman</option><option value="43">Pakistan</option><option value="50">Palestine</option><option value="47">Stan Countries</option><option value="39">Tanzania</option><option value="44">Tây Tạng</option><option value="57">Thổ Nhĩ Kỳ</option><option value="56">[Armernia]</option>
                      </select>
                    </div>
                  </div>
                  <div id="select_time_start" class="row row-cols-1 row-cols-md-1">
                    <div class="mb-3 col">
                      <label class="form-label" for="time-tour">Bạn dự định đi vào thời gian nào?</label>
                      <select class="select2 w-100" name="time-tour" id="time-tour">
                        <option value="0">Chọn thời gian</option>
                        <option value="calendar">Chọn thời gian khởi hành dự kiến</option>
                        <option value="none">Chưa xác định thời gian cụ thể</option>
                      </select>
                    </div>
                    <div id="select_time_start_custom" class="mb-3 col d-none">
                      <label class="form-label" for="expected_date">Ngày dự kiến</label>
                      <div class="input-group">
                        <input type="text" id="expected_date" name="expected_date" data-date-min-date="23/1/2024" class="form-control datepicker" autocomplete="off">
                        <div class="input-group-text">
                          <i class="far fa-calendar-alt calendar-icon"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="block-footer-action d-flex justify-content-between mt-3">
                  <button class="btn btn-outline-secondary btn-prev" disabled>
                    <i class="fa-solid fa-chevron-left d-inline-block me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Trước</span>
                  </button>
                  <button class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none">Tiếp</span>
                    <i class="fa-solid fa-chevron-right d-inline-block ms-sm-1 ms-0"></i>
                  </button>
                </div>
              </div>
              <div id="private-schedule-2" class="content" role="tabpanel" aria-labelledby="private-schedule-2-trigger">
                <form>
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="day-plan">Số ngày dự kiến</label>
                      <div id="set-day-plan" class="row align-items-center row-cols-1 row-sm-cols-2 row-mh-38">
                        <div class="col">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="choose_date_number" id="choose_date_number" value="0" checked="">
                            <label class="form-check-label" for="choose_date_number">Chưa xác định</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="choose_date_number" id="expected_date_number" value="1">
                            <label class="form-check-label" for="expected_date_number">Dự kiến</label>
                          </div>
                        </div>
                        <div id="col-day-plan" class="col d-none">
                          <input type="number" class="form-control" name="expected_date_number" id="day-plan">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="vacation">Thời gian dự kiến có phải 1 dịp đặc biệt nào không?</label>
                      <div class="d-flex align-items-center row-mh-38">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="special_occasion" id="special_occasion_1" value="1">
                          <label class="form-check-label" for="special_occasion_1">Có</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="special_occasion" id="special_occasion_0" value="0" checked="">
                          <label class="form-check-label" for="special_occasion_0">Không</label>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="budget">Ngân sách dự kiến</label>
                      <select class="select2 w-100" name="budget" id="budget">
                        <option>10 triệu</option>
                        <option>20 triệu</option>
                        <option>30 triệu</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="message">Số lượng thành viên tham gia</label>
                      <div class="row row-cols-1 row-cols-sm-2">
                        <div class="col">
                          <div class="input-group input-group-merge mb-2">
                            <span class="input-group-text">Người lớn</span>
                            <input type="number" class="form-control text-end" name="adults" min="0" id="adults" value="1">
                          </div>
                        </div>
                        <div class="col">
                          <div class="input-group input-group-merge mb-2">
                            <span class="input-group-text">Trẻ em</span>
                            <input type="number" class="form-control text-end" name="children" min="0" id="children" value="0">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="depart_at">Nhóm bạn sẽ khởi hành từ đâu?</label>
                      <select class="select2 w-100" name="depart_at" id="depart_at">
                        <option label=''>Chọn địa điểm khởi hành</option>
                        <option value="Hà Nội">Hà Nội</option>
                        <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                        <option value="Ngoài Việt Nam">Ngoài Việt Nam</option>
                      </select>
                    </div>
                  </div>
                </form>
                <div class="block-footer-action d-flex justify-content-between mt-3">
                  <button class="btn btn-outline-secondary btn-prev" >
                    <i class="fa-solid fa-chevron-left d-inline-block me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Trước</span>
                  </button>
                  <button class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none">Tiếp</span>
                    <i class="fa-solid fa-chevron-right d-inline-block ms-sm-1 ms-0"></i>
                  </button>
                </div>
              </div>
              <div id="private-schedule-3" class="content" role="tabpanel" aria-labelledby="private-schedule-3-trigger">
                <form>
                  <div class="mb-3">
                    <label class="form-label" for="ticket">Bạn có muốn bao gồm vé máy bay trong hành trình?</label>
                    <div class="">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ticket" id="ticket_check" value="1" checked="">
                        <label class="form-check-label" for="ticket_check">Có</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ticket" id="ticket_no" value="0">
                        <label class="form-check-label" for="ticket_no">Không</label>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="demand-message">Các yêu cầu về cảnh điểm hoặc các hoạt động trong chương trình</label>
                    <textarea name="demand-message" id="demand-message" class="form-control" placeholder="Ví dụ: Trek núi Sinai, lặn biển Đỏ, tham quan Grand Museum" rows="8" cols="80"></textarea>
                  </div>
                </form>
                <div class="block-footer-action d-flex justify-content-between mt-3">
                  <button class="btn btn-outline-secondary btn-prev">
                    <i class="fa-solid fa-chevron-left d-inline-block me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Trước</span>
                  </button>
                  <button class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none">Tiếp</span>
                    <i class="fa-solid fa-chevron-right d-inline-block ms-sm-1 ms-0"></i>
                  </button>
                </div>
              </div>
              <div id="private-schedule-4" class="content" role="tabpanel" aria-labelledby="private-schedule-4-trigger">
                <form>
                  <div class="mb-3">
                    <label class="form-label">Phong cách khi đi du lịch của (nhóm) bạn?</label>
                    <select class="select2 w-100" name="style" id="style">
                      <option label=" ">Chọn phong cách</option>
                      <option value="Trải nghiệm">Trải nghiệm</option>
                      <option value="Mạo hiểm">Mạo hiểm</option>
                      <option value="Luxury">Luxury</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="tour_guide_check">Ngoài HDV địa phương, (nhóm) bạn có cần trưởng đoàn là HDV người Việt đi theo cùng đoàn?</label>
                    <div class="">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tour_guide" id="tour_guide_check" value="1" checked="">
                        <label class="form-check-label" for="tour_guide_check">Có</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tour_guide" id="tour_guide_no" value="0">
                        <label class="form-check-label" for="tour_guide_no">Không</label>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="note-message">Các lưu ý đặc biệt khác</label>
                    <textarea name="note-message" id="note-message" class="form-control" placeholder="Nhập nội dung" rows="8" cols="80"></textarea>
                  </div>
                </form>
                <div class="block-footer-action d-flex justify-content-between mt-3">
                  <button class="btn btn-outline-secondary btn-prev">
                    <i class="fa-solid fa-chevron-left d-inline-block me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Trước</span>
                  </button>
                  <button class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none">Tiếp</span>
                    <i class="fa-solid fa-chevron-right d-inline-block ms-sm-1 ms-0"></i>
                  </button>
                </div>
              </div>
              <div id="private-schedule-5" class="content" role="tabpanel" aria-labelledby="private-schedule-5-trigger">
                <div class="content-header">
                  <h4 class="mb-0">Thông tin liên hệ</h4>
                </div>
                <form>
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="first_name">Họ <span class="text-danger">*</span></label>
                      <input type="text" id="first_name" name="first_name" class="form-control" placeholder="" />
                    </div>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="last_name">Tên <span class="text-danger">*</span></label>
                      <input type="text" id="last_name" name="last_name" class="form-control" placeholder="" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="email">Đĩa chỉ email</label>
                      <input type="email" id="email" name="email" class="form-control" placeholder="" />
                    </div>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="phone">Số điện thoại <span class="text-danger">*</span></label>
                      <input type="text" id="phone" name="phone" class="form-control" placeholder="" />
                    </div>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="promos" name="promos" value="checked" checked="">
                    <label class="form-check-label" for="promos">Tôi muốn biết thêm về chương trình khuyến mãi</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter" value="checked" checked="">
                    <label class="form-check-label" for="newsletter">Tôi muốn nhận tin tức từ DIAMONDTOUR</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" value="checked" checked="">
                    <label class="form-check-label" for="agree_terms">Tôi đồng ý với điều kiện và điều khoản</label>
                  </div>
                </form>
                <div class="block-footer-action d-flex justify-content-between mt-3">
                  <button class="btn btn-outline-secondary btn-prev" >
                    <i class="fa-solid fa-chevron-left d-inline-block me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Trước</span>
                  </button>
                  <button class="btn btn-success btn-submit">Tư vấn ngay</button>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </article>
@endsection
@section('plugins_style')
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2-theme.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('assets/plugins/bsStepper/css/bs-stepper.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('assets/plugins/bsStepper/css/form-wizard.css') }}" type="text/css" />
@endsection
@section('plugins_script')
  <script src="{{ asset('assets/plugins/bsStepper/js/bs-stepper.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/validate/jquery.validate.min.js') }}"></script>
@endsection
@section('script_module')
  <script type="text/javascript">
  $(function () {
          "use strict";
          var e = document.querySelectorAll(".bs-stepper"),
              n = $(".select2"),
              i = document.querySelector(".horizontal-wizard-example");
          if (void 0 !== typeof e && null !== e)
              for (var l = 0; l < e.length; ++l)
                  e[l].addEventListener("show.bs-stepper", function (e) {
                      for (var n = e.detail.indexStep, i = $(e.target).find(".step").length - 1, r = $(e.target).find(".step"), t = 0; t < n; t++) {
                          r[t].classList.add("crossed");
                          for (var o = n; o < i; o++) r[o].classList.remove("crossed");
                      }
                      if (0 == e.detail.to) {
                          for (var l = n; l < i; l++) r[l].classList.remove("crossed");
                          r[0].classList.remove("crossed");
                      }
                  });
          if (
              (n.each(function () {
                  var e = $(this);
                  e.wrap('<div class="position-relative"></div>'), e.select2({ placeholder: "Select value", dropdownParent: e.parent() });
              }),
              void 0 !== typeof i && null !== i)
          ) {
              var d = new Stepper(i);
              $(i)
                  .find("form")
                  .each(function () {
                      $(this).validate({
                          rules: {
                              first_name: { required: !0 },
                              last_name: { required: !0 },
                              phone: { required: !0 },
                              // username: { required: !0 },
                              // email: { required: !0 },
                              // password: { required: !0 },
                              // "confirm-password": { required: !0, equalTo: "#password" },
                              // "first-name": { required: !0 },
                              // "last-name": { required: !0 },
                              // address: { required: !0 },
                              // landmark: { required: !0 },
                              // country: { required: !0 },
                              // language: { required: !0 },
                              // twitter: { required: !0, url: !0 },
                              // facebook: { required: !0, url: !0 },
                              // google: { required: !0, url: !0 },
                              // linkedin: { required: !0, url: !0 },
                          },
                      });
                  }),
                  $(i)
                      .find(".btn-next")
                      .each(function () {
                          $(this).on("click", function (e) {
                              $(this).parent().siblings("form").valid() ? d.next() : e.preventDefault();
                          });
                      }),
                  $(i)
                      .find(".btn-prev")
                      .on("click", function () {
                          d.previous();
                      }),
                  $(i)
                      .find(".btn-submit")
                      .on("click", function () {
                          $(this).parent().siblings("form").valid() && alert("Submitted..!!");
                      });
          }
      });

      $(document).on('change', '#time-tour', function(e) {
        let get_value = $(this).val();
        if(get_value === 'calendar'){
          $(this).closest('#select_time_start').removeClass('row-cols-md-1').addClass('row-cols-md-2');
          $(this).closest('#select_time_start').find('#select_time_start_custom').removeClass('d-none');
        }else{
          $(this).closest('#select_time_start').removeClass('row-cols-md-2').addClass('row-cols-md-1');
          $(this).closest('#select_time_start').find('#select_time_start_custom').addClass('d-none');
        }
      });

      $(document).on('change', 'input[name="choose_date_number"]', function(e) {
        let get_id = $(this).attr('id');
        if(get_id == 'expected_date_number'){
          $(this).closest('#set-day-plan').removeClass('row-cols-md-1').addClass('row-cols-md-2');
          $(this).closest('#set-day-plan').find('#col-day-plan').removeClass('d-none');
        }else{
          $(this).closest('#set-day-plan').removeClass('row-cols-md-2').addClass('row-cols-md-1');
          $(this).closest('#set-day-plan').find('#col-day-plan').addClass('d-none');
        }
      });
  </script>
@endsection

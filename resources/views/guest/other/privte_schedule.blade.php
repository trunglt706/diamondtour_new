@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2-theme.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/bsStepper/css/bs-stepper.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/bsStepper/css/form-wizard.css') }}" type="text/css" />
    <style>
        @media (max-width: 932px) {
            .main-content {
                padding-top: 50px !important;
            }

            .widget_banner.widget_banner_style_3 .box-content .title {
                font-size: 20px !important;
                line-height: 30px !important;
            }
        }
    </style>
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home competition">
            {{-- start slider --}}
            <div class="widget_banner widget_banner_style_3">
                <div class="box-content">
                    <a href="#"><img src="{{ asset($data['menu']->background) }}" alt="Image"></a>
                    <p class="title text-uppercase">@lang('messages.thiet_ke_lich_trinh_rieng')</p>
                </div>
            </div>
            {{-- end slider --}}

            <div class="container py-4">
                <section class="horizontal-wizard">
                    <form action="{{ route('demo.privte_schedule_post') }}" method="POST">
                        @csrf
                        <div class="bs-stepper horizontal-wizard-example">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step" data-target="#private-schedule-1" role="tab"
                                    id="private-schedule-1-trigger">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-box">1</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title mb-2">@lang('messages.ke_hoach_cua_ban')</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i class="fa-solid fa-chevron-right fa-xs"></i>
                                </div>
                                <div class="step" data-target="#private-schedule-2" role="tab"
                                    id="private-schedule-2-trigger">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-box">2</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title mb-2">@lang('messages.du_kien_khoi_hanh')</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i class="fa-solid fa-chevron-right fa-xs"></i>
                                </div>
                                <div class="step" data-target="#private-schedule-3" role="tab"
                                    id="private-schedule-3-trigger">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-box">3</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title mb-2">@lang('messages.yeu_cau_cua_ban')</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i class="fa-solid fa-chevron-right fa-xs"></i>
                                </div>
                                <div class="step" data-target="#private-schedule-4" role="tab"
                                    id="private-schedule-4-trigger">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-box">4</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title mb-2">@lang('messages.thong_tin_lien_he')</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <div id="private-schedule-1" class="content" role="tabpanel"
                                    aria-labelledby="private-schedule-1-trigger">
                                    <div class="content-header">
                                        <h4 class="mb-0">@lang('messages.thong_tin_khoi_hanh')</h4>
                                    </div>
                                    <label class="form-label">@lang('messages.ban_du_dinh_di_dau')?</label>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <select class="select2 w-100" name="country_id" id="group">
                                                <option value="" selected>-- @lang('messages.chon_quoc_gia') --</option>
                                                @foreach ($data['countries'] as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <select class="select2 w-100" name="tour_group_id" id="region">
                                                <option value="">-- @lang('messages.chon_danh_muc_tour') --</option>
                                                @foreach ($data['tour_groups'] as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div id="select_go_with_someone" class="row row-cols-1 row-cols-md-1">
                                        <div class="mb-3 col">
                                            <label class="form-label" for="someone-select">@lang('messages.se_di_cung_ai')?</label>
                                            <select class="select2 w-100" name="someone_id" id="someone-select">
                                                @foreach ($data['objects'] as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                                <option value="other">@lang('messages.khac')</option>
                                            </select>
                                        </div>
                                        <div id="someone_custom" class="mb-3 col d-none">
                                            <label class="form-label" for="someone_other">@lang('messages.nguoi_di_cung')</label>
                                            <input type="text" id="someone_other" name="someone_other"
                                                class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="message">@lang('messages.sl_thanh_vien')</label>
                                            <div class="row row-cols-1 row-cols-sm-2">
                                                <div class="col">
                                                    <div class="input-group input-group-merge mb-2">
                                                        <span class="input-group-text">@lang('messages.nguoi_lon')</span>
                                                        <input type="number" class="form-control text-end"
                                                            name="adults" min="1" id="adults" value="1">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="input-group input-group-merge mb-2">
                                                        <span class="input-group-text">@lang('messages.tre_em')</span>
                                                        <input type="number" class="form-control text-end"
                                                            name="children" min="0" id="children"
                                                            value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="age">@lang('messages.do_tuoi_cua_thanh_vien')?</label>
                                            <select class="select2 w-100" name="age_id" id="age">
                                                @foreach ($data['ages'] as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="block-footer-action d-flex justify-content-between mt-3">
                                        <button type="button" class="btn btn-outline-secondary btn-prev" disabled>
                                            <i class="fa-solid fa-chevron-left d-inline-block me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">@lang('messages.before')</span>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none">@lang('messages.next')</span>
                                            <i class="fa-solid fa-chevron-right d-inline-block ms-sm-1 ms-0"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="private-schedule-2" class="content" role="tabpanel"
                                    aria-labelledby="private-schedule-2-trigger">
                                    <div id="place_start" class="row row-cols-1 row-cols-md-1">
                                        <div class="mb-3 col">
                                            <label class="form-label" for="place_start-select">
                                                @lang('messages.diem_khoi_hanh')?
                                            </label>
                                            <select class="select2 w-100" name="place_id" id="place_start-select">
                                                @foreach ($data['provinces'] as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                                <option value="other">@lang('messages.khac')</option>
                                            </select>
                                        </div>
                                        <div id="place_start_custom" class="mb-3 col d-none">
                                            <label class="form-label" for="place_start_other">@lang('messages.chi_tiet_diem_khoi_hanh')</label>
                                            <input type="text" id="place_start_other" name="place_start_other"
                                                class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div id="select_time_start" class="row row-cols-1 row-cols-md-1">
                                        <div class="mb-3 col">
                                            <label class="form-label" for="time_tour">@lang('messages.du_dinh_tg_di')?</label>
                                            <select class="select2 w-100" name="time_tour" id="time_tour">
                                                <option value="none" selected>@lang('messages.chua_xac_dinh_tg')</option>
                                                <option value="calendar">@lang('messages.chon_tg_khoi_hanh')</option>
                                            </select>
                                        </div>
                                        <div id="select_time_start_custom" class="mb-3 col d-none">
                                            <label class="form-label" for="expected_date">@lang('messages.ngay_du_kien')</label>
                                            <input type="date" id="expected_date" name="expected_date"
                                                value="{{ date('d/m/Y') }}" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="budget">@lang('messages.ngan_sach_du_kien')</label>
                                            <select class="select2 w-100" name="balance_id" id="budget">
                                                @foreach ($data['balances'] as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="day-plan">@lang('messages.so_ngay_du_kien')</label>
                                            <div id="set-day-plan"
                                                class="row align-items-center row-cols-1 row-sm-cols-2 row-mh-38">
                                                <div class="col">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="choose_date_number" id="choose_date_number"
                                                            value="0" checked="">
                                                        <label class="form-check-label"
                                                            for="choose_date_number">@lang('messages.chu_xac_dinh')</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="choose_date_number" id="expected_date_number"
                                                            value="1">
                                                        <label class="form-check-label" for="expected_date_number">
                                                            @lang('messages.du_kien')
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="col-day-plan" class="col d-none">
                                                    <input type="number" class="form-control"
                                                        name="expected_date_number" id="day-plan">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-footer-action d-flex justify-content-between mt-3">
                                        <button type="button" class="btn btn-outline-secondary btn-prev">
                                            <i class="fa-solid fa-chevron-left d-inline-block me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">@lang('messages.before')</span>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none">@lang('messages.next')</span>
                                            <i class="fa-solid fa-chevron-right d-inline-block ms-sm-1 ms-0"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="private-schedule-3" class="content" role="tabpanel"
                                    aria-labelledby="private-schedule-3-trigger">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">@lang('messages.phong_cach_du_lich')?</label>
                                            <select class="select2 w-100" name="style_id" id="style">
                                                @foreach ($data['styles'] as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">@lang('messages.dich_vu_mong_muon')?</label>
                                            <select class="select2 w-100" name="service_id" id="service">
                                                @foreach ($data['services'] as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="tour_guide_check">
                                            @lang('messages.co_can_huong_dan_vien_theo_doan')?
                                        </label>
                                        <div class="">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tour_guide"
                                                    id="tour_guide_check" value="1">
                                                <label class="form-check-label"
                                                    for="tour_guide_check">@lang('messages.yes')</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tour_guide"
                                                    id="tour_guide_no" value="0" checked="">
                                                <label class="form-check-label"
                                                    for="tour_guide_no">@lang('messages.no')</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="note-message">
                                            @lang('messages.yeu_cau_lien_quan_ctrinh')
                                        </label>
                                        <textarea name="message" id="note-message" name="message" class="form-control" placeholder="@lang('messages.Trekking_EBC')"
                                            rows="4" cols="80"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="note_special">
                                            @lang('messages.luu_y_dac_biet')
                                        </label>
                                        <textarea name="special" id="note_special" class="form-control" placeholder="@lang('messages.vd_tien_su_benh_ly')" rows="4"
                                            cols="80"></textarea>
                                    </div>
                                    <div class="block-footer-action d-flex justify-content-between mt-3">
                                        <button type="button" class="btn btn-outline-secondary btn-prev">
                                            <i class="fa-solid fa-chevron-left d-inline-block me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">@lang('messages.before')</span>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none">@lang('messages.next')</span>
                                            <i class="fa-solid fa-chevron-right d-inline-block ms-sm-1 ms-0"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="private-schedule-4" class="content" role="tabpanel"
                                    aria-labelledby="private-schedule-4-trigger">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">@lang('messages.fullname') <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="name" required name="name"
                                            class="form-control" placeholder="" />
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="email">@lang('messages.email_address')</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="phone">@lang('messages.phone') <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="phone" required name="phone"
                                                class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="agree_terms"
                                            name="agree_terms" value="1" checked="">
                                        <label class="form-check-label" for="agree_terms">@lang('messages.dong_y_dieu_khoan')</label>
                                    </div>
                                    <div class="block-footer-action d-flex justify-content-between mt-3">
                                        <button type="button" class="btn btn-outline-secondary btn-prev">
                                            <i class="fa-solid fa-chevron-left d-inline-block me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">@lang('messages.before')</span>
                                        </button>
                                        <button class="btn btn-success btn-submit">
                                            <span class="align-middle d-sm-inline-block d-none">@lang('messages.tu_van_ngay')</span>
                                            <i class="fa-solid fa-chevron-right d-inline-block ms-sm-1 ms-0"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/bsStepper/js/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            "use strict";
            var e = document.querySelectorAll(".bs-stepper"),
                n = $(".select2"),
                i = document.querySelector(".horizontal-wizard-example");
            if (void 0 !== typeof e && null !== e)
                for (var l = 0; l < e.length; ++l)
                    e[l].addEventListener("show.bs-stepper", function(e) {
                        for (var n = e.detail.indexStep, i = $(e.target).find(".step").length - 1, r = $(e
                                .target).find(".step"), t = 0; t < n; t++) {
                            r[t].classList.add("crossed");
                            for (var o = n; o < i; o++) r[o].classList.remove("crossed");
                        }
                        if (0 == e.detail.to) {
                            for (var l = n; l < i; l++) r[l].classList.remove("crossed");
                            r[0].classList.remove("crossed");
                        }
                    });
            if (
                (n.each(function() {
                        var e = $(this);
                        e.wrap('<div class="position-relative"></div>'), e.select2({
                            placeholder: "-- Chọn --",
                            dropdownParent: e.parent()
                        });
                    }),
                    void 0 !== typeof i && null !== i)
            ) {
                var d = new Stepper(i);
                $(i)
                    .find(".btn-next")
                    .each(function() {
                        $(this).on("click", function(e) {
                            d.next();
                        });
                    }),
                    $(i)
                    .find(".btn-prev")
                    .on("click", function() {
                        d.previous();
                    });
            }
        });

        $(document).on('change', '#time_tour', function(e) {
            let get_value = $(this).val();
            if (get_value === 'calendar') {
                $(this).closest('#select_time_start').removeClass('row-cols-md-1').addClass('row-cols-md-2');
                $(this).closest('#select_time_start').find('#select_time_start_custom').removeClass('d-none');
            } else {
                $(this).closest('#select_time_start').removeClass('row-cols-md-2').addClass('row-cols-md-1');
                $(this).closest('#select_time_start').find('#select_time_start_custom').addClass('d-none');
            }
        });
        $(document).on('change', '#someone-select', function(e) {
            let get_value = $(this).val();
            if (get_value !== 'other') {
                $(this).closest('#select_go_with_someone').removeClass('row-cols-md-2').addClass('row-cols-md-1');
                $(this).closest('#select_go_with_someone').find('#someone_custom').addClass('d-none');
            } else {
                $(this).closest('#select_go_with_someone').removeClass('row-cols-md-1').addClass('row-cols-md-2');
                $(this).closest('#select_go_with_someone').find('#someone_custom').removeClass('d-none');
            }
        });
        $(document).on('change', '#place_start-select', function(e) {
            let get_value = $(this).val();
            if (get_value !== 'other') {
                $(this).closest('#place_start').removeClass('row-cols-md-2').addClass('row-cols-md-1');
                $(this).closest('#place_start').find('#place_start_custom').addClass('d-none');
            } else {
                $(this).closest('#place_start').removeClass('row-cols-md-1').addClass('row-cols-md-2');
                $(this).closest('#place_start').find('#place_start_custom').removeClass('d-none');
            }
        });
        $(document).on('change', 'input[name="choose_date_number"]', function(e) {
            let get_id = $(this).attr('id');
            if (get_id == 'expected_date_number') {
                $(this).closest('#set-day-plan').removeClass('row-cols-md-1').addClass('row-cols-md-2');
                $(this).closest('#set-day-plan').find('#col-day-plan').removeClass('d-none');
            } else {
                $(this).closest('#set-day-plan').removeClass('row-cols-md-2').addClass('row-cols-md-1');
                $(this).closest('#set-day-plan').find('#col-day-plan').addClass('d-none');
            }
        });
        $('.btn-submit').click(function() {
            let form = $(this).closest('form'); // Lấy form gần nhất
            let hasEmptyRequiredFields = false;
            form.find('input[required], select[required], textarea[required]').each(function() {
                if ($(this).val() === '') {
                    hasEmptyRequiredFields = true;
                }
            });
            if (!hasEmptyRequiredFields) {
                $(this).html(
                    `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status">Loading...</span>`
                );
            }
        });
        $('.btn-prev').click(function() {
            window.scrollTo({
                top: 200
            });
            return false
        });
        $('.btn-next').click(function() {
            window.scrollTo({
                top: 200
            });
            return false
        });
    </script>
@endsection

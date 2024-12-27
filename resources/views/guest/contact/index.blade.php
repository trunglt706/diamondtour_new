@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <style>
        .widget_contact_1 .row-input-radio p,
        .widget_contact_1 .row-input-radio label,
        .widget_contact_1 .work-with-us label {
            font-family: 'Montserrat' !important;
            font-size: 16px !important;
        }

        @media (max-width: 932px) {

            .widget_contact_1 .work-with-us .form,
            .contact .box-title {
                padding: 0 !important;
            }

            .widget_contact_1 .work-with-us .row-input {
                display: block !important;
            }

            .widget_contact_1 .container>.row {
                margin-right: auto !important;
                margin-left: auto !important;
            }

            .widget_contact_1 .work-with-us .form form button {
                width: 100% !important;
            }

            .widget_contact_1 .row-input-radio fieldset {
                flex-direction: row;
                display: flex !important;
                flex-wrap: wrap;
            }

            .widget_contact_1 .row-input-radio .group {
                gap: 15px !important;
                margin-bottom: 12px;
                width: 50%;
            }

            .widget_contact_1 .box-content .content .box-bottom {
                display: none !important;
            }

            .widget_contact_2 {
                padding: 12px !important;
            }

            .widget_contact_1 .box-content .content .box-center {
                gap: 10px !important;
            }

            .widget_contact_1 .box-content .content .box-center .item a {
                font-size: 14px !important;
            }

            .widget_contact_2 .title {
                font-size: 32px !important;
            }

            .widget_contact_2 .container {
                padding: 20px 0 !important;
            }
        }
    </style>
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home contact">
            <div class="box-title">
                <div class="header-title">
                    <h1 class="header-page">@lang('messages.menu.contact')</h1>
                    <p class="description">
                        @lang('messages.contact.contact_des')
                    </p>
                </div>
            </div>
            <div class="widget_contact_1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-12 box-content">
                            <div class="img-bottom">
                                <img src="/style/images/icon/Group 1000001753.png" alt="Image" srcset="">
                            </div>
                            <div class="content">
                                <div class="box-top">
                                    <p class="title">@lang('messages.contact.info')</p>
                                    <p class="description">@lang('messages.contact.info_des')</p>
                                </div>
                                <div class="box-center">
                                    <div class="item">
                                        <img src="/style/images/icon/bxs_phone-call.png" alt="Image" srcset="">
                                        <a>{{ get_option('contact-phone') }}</a>
                                    </div>
                                    <div class="item">
                                        <img src="/style/images/icon/ic_sharp-email.png" alt="Image" srcset="">
                                        <a>{{ get_option('contact-email') }}</a>
                                    </div>
                                    <div class="item">
                                        <img src="/style/images/icon/carbon_location-filled.png" alt="Image"
                                            srcset="">
                                        <a>{{ get_option('contact-address') }}</a>
                                    </div>
                                </div>
                                <div class="box-bottom">
                                    <img class="img_1" src="/style/images/icon/Group 1000001750.png" alt="Image"
                                        srcset="">
                                    <img class="img_2" src="/style/images/icon/clarity_cursor-hand-click-line.png"
                                        alt="Image" srcset="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="work-with-us">
                                <div class="img-bottom">
                                    <img src="/style/images/icon/letter_send 1.png" alt="Image" srcset="">
                                </div>
                                <div class="form">
                                    <form method="POST" action="{{ route('demo.contact.create') }}">
                                        @csrf
                                        <div class="row-input">
                                            <div>
                                                <label for="name">@lang('messages.contact.ho')</label>
                                                <input id="name" type="text" name="first_name">
                                            </div>
                                            <div>
                                                <label for="company-name">@lang('messages.contact.name') *</label>
                                                <input id="company-name" type="text" name="last_name">
                                            </div>
                                            <div>
                                                <label for="work-email">@lang('messages.email_address') *</label>
                                                <input id="work-email" type="email" name="email" required>
                                            </div>
                                            <div>
                                                <label for="work-phone">@lang('messages.phone') *</label>
                                                <input id="work-phone" name="phone" required type="text">
                                            </div>
                                        </div>
                                        <div class="row-input-radio">
                                            <p>@lang('messages.contact.select_subject')</p>
                                            <fieldset>
                                                @foreach ($data['type'] as $key => $item)
                                                    <div class="group">
                                                        <input type="radio" {{ $key == 'tour' ? 'checked' : '' }}
                                                            id="radio{{ $key }}" name="question">
                                                        <label for="radio{{ $key }}">{{ $item[0] }}</label>
                                                    </div>
                                                @endforeach
                                            </fieldset>
                                        </div>
                                        <label for="comment">@lang('messages.noi_dung') *</label>
                                        <textarea id="comment" class="form-control" required rows="6"></textarea>
                                        <div class="box-btn">
                                            <button type="submit" class="btn-submit">@lang('messages.contact.send_info')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget_contact_2">
                <div class="container">
                    <div class="box-content">
                        <p class="title">@lang('messages.contact.dang_ky_nhan_tin')</p>
                        <p class="description">@lang('messages.contact.dang_ky_nhan_tin_des')</p>
                        <form method="post" class="form email-register-form" action="{{ route('newllter') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input">
                                    <input name="email" placeholder="@lang('messages.contact.dang_ky_nhan_tin')" class="form-control input-lg"
                                        required="">
                                </div>
                                <div class="button">
                                    <button type="submit" class="btn btn-register">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
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

        $('.btn-register').click(function() {
            let form = $(this).closest('form'); // Lấy form gần nhất
            let hasEmptyRequiredFields = false;
            form.find('input[required], select[required], textarea[required]').each(function() {
                if ($(this).val() === '') {
                    hasEmptyRequiredFields = true;
                }
            });

            if (!hasEmptyRequiredFields) {
                $(this).html(
                    `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span class="visually-hidden" role="status">Loading...</span>`
                );
            }
        });
    </script>
@endsection

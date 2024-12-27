<section>
    <div class="container">
        <div class="box-get-promo" style="background-image: url({{ get_url('assets/images/bg_newsletter.png') }})">
            <div class="row">
                <div class="col-md-6">
                    <div class="block-get-promo-content">
                        <h2>@lang('messages.den_gan_hon_voi_chung_toi')</h2>
                        <div class="-content">
                            <p>
                                @lang('messages.ngoai_cac_dich_vu_tron_goi')
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block-get-promo-form">
                        <form id="form_get_promo" class="form-get-promo" action="{{ route('register_promo') }}"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="@lang('messages.nhap_fullname')" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="phone"
                                            placeholder="@lang('messages.phone')" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="@lang('messages.nhap_email')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="question"
                                            placeholder="@lang('messages.ban_dang_quan_tam_den')" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <textarea name="content" class="form-control" placeholder="@lang('messages.de_lai_loi_nhan')" rows="8" cols="80"></textarea>
                            </div>
                            <button type="submit"
                                class="btn d-block mx-auto btn-submit w-100">@lang('messages.gui')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

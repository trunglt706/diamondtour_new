<section>
    <div class="container">
        <div class="box-get-promo" style="background-image: url({{ get_url('assets/images/bg_newsletter.png') }})">
            <div class="row">
                <div class="col-md-6">
                    <div class="block-get-promo-content">
                        <h2>@lang('messages.dang_ky_tour')</h2>
                        <div class="-content">
                            <p>
                                @lang('messages.neu_cam_thay_hanh_trinh_phu_hop')
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block-get-promo-form">
                        <form id="form_get_promo" class="form-get-promo" action="{{ route('register_tour') }}"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="@lang('messages.fullname')" required>
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
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <input type="number" class="form-control" name="adults"
                                            placeholder="@lang('messages.so_nguoi_lon')" min="0" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <input type="number" min="0" class="form-control" name="children"
                                            placeholder="@lang('messages.so_tre_em')" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="other"
                                            placeholder="@lang('messages.thong_tin_khac')" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <textarea name="content" class="form-control" placeholder="@lang('messages.de_lai_nhung_luu_y')" rows="8" cols="80"></textarea>
                            </div>
                            <button type="submit"
                                class="btn d-block mx-auto btn-submit w-100">@lang('messages.dang_ky')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

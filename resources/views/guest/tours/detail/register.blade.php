<div class="widget_form_contact_style_3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1 class="title">@lang('messages.dang_ky_tour')</h1>
                <p class="description">
                    @lang('messages.neu_cam_thay_hanh_trinh_phu_hop')
                </p>
                <form method="POST" action="{{ route('register_tour') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" placeholder="@lang('messages.fullname') *" class="form-control" name="name"
                                required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="@lang('messages.phone') *" class="form-control" name="phone"
                                required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" placeholder="@lang('messages.so_nguoi_lon') *" class="form-control" name="adults"
                                required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" placeholder="@lang('messages.so_tre_em')" class="form-control" name="children">
                        </div>
                        <div class="col-12">
                            <textarea placeholder="@lang('messages.de_lai_nhung_luu_y')" class="form-control" id="your-message" name="content" rows="5" required></textarea>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-submit">@lang('messages.dang_ky')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

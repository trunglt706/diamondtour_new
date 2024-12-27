<footer>
    <div class="box-footer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12 col-lg-12 col-xl-9">
                    <div class="row gx-4">
                        <div class="col-md-3">
                            <section class="mb-3">
                                <div class="block-footer-header">
                                    <h2>@lang('messages.thong_tin_can_biet')</h2>
                                </div>
                                <div class="block-footer-content">
                                    <ul>
                                        <li><a href="{{ route('about') }}">@lang('messages.ve_chung_toi')</a></li>
                                        <li><a href="#">@lang('messages.dich_vu')</a></li>
                                        <li><a href="{{ route('faq') }}">@lang('messages.FAQ')</a></li>
                                        <li><a href="{{ route('contact.index') }}">@lang('messages.menu.contact')</a></li>
                                    </ul>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-3">
                            <section class="mb-3">
                                <div class="block-footer-header">
                                    <h2>@lang('messages.lien_ket_huu_ich')</h2>
                                </div>
                                <div class="block-footer-content">
                                    <ul>
                                        <li><a href="#">@lang('messages.chinh_sach_bao_mat')</a></li>
                                        <li><a href="{{ route('privte_schedule') }}">@lang('messages.thiet_ke_lich_trinh_rieng')</a></li>
                                        <li><a href="{{ route('blog.index') }}">@lang('messages.bai_viet')</a></li>
                                        <li>
                                            <a target="_blank"
                                                href="{{ asset('assets/files/PROFILE DIAMOND TOUR.pdf') }}">
                                                @lang('messages.Catalog')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6">
                            <section class="mb-3">
                                <div class="block-footer-header">
                                    <h2>@lang('messages.dang_ky_nhan_thong_tin')</h2>
                                </div>
                                <div class="block-footer-content">
                                    <p>@lang('messages.dang_ky_de_cap_nhat_thong_tin')</p>
                                    <form id="form_newsletter" class="form-newsletter" action="{{ route('newllter') }}"
                                        method="post">
                                        @csrf
                                        <input type="email" name="email" required class="form-control"
                                            placeholder="@lang('messages.de_lại_email_cua_ban')">
                                        <button class="btn btn-submit" type="submit">@lang('messages.dang_ky')</button>
                                    </form>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12">
                            <div class="block-footer-introduce my-4 mb-3">
                                <div class="introduce-logo">
                                    <a href="{{ route('index') }}">
                                        <img src="{{ $seo['seo-logo'] ? get_url($seo['seo-logo']) : '' }}"
                                            alt="image" class="d-block mx-auto img-fluid">
                                    </a>
                                </div>
                                <div class="introduce-content">
                                    {!! $seo['footer-info'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-3">
                    <div class="ratio ratio-21x9 mt-5">
                        {!! $seo['google-map'] !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer-copyright">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="-social">
                            @foreach ($socials as $item)
                                <li>
                                    <a href="{{ $item->link }}">
                                        <img src="{{ $item->icon ? get_url($item->icon) : asset('user/img/user/no-avatar.jpg') }}"
                                            alt="img" class="icon-footer">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <p class="text-center text-sm-end">
                            {{ $seo['copyright'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<button type="button" class="btn btn-primary rounded-circle btn-floating btn-lg" id="btn-back-to-top">
    <i class="fas fa-arrow-up"></i>
</button>

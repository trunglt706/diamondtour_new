<footer class="footer_1">
    <div class="container">
        <div class="js_widget_builder js_widget_footer_style_1_11 widget_footer_style_1">
            <div class="footer-box">
                <div class="row">
                    <div class="row_1 col-sm-6 col-xs-6 col-md-2">
                        <div class="logo_footer">
                            <img src="/style/images/Desktop/logo.png" alt="Image">
                        </div>
                    </div>
                    <div class="col-md-5 left">
                        <ul class="hide-mobile">
                            <li class=""><a href="{{ route('about') }}"><span>@lang('messages.ve_chung_toi')</span></a>
                            </li>
                            <li class=""><a
                                    href="{{ route('service.index') }}"><span>@lang('messages.menu.service')</span></a></li>
                            <li class=""><a href="{{ route('faq') }}"><span>@lang('messages.FAQ')</span></a></li>
                            <li class=""><a
                                    href="{{ route('contact.index') }}"><span>@lang('messages.menu.contact')</span></a></li>
                            <li class=""><a><span>@lang('messages.chinh_sach_bao_mat')</span></a></li>
                            <li class=""><a
                                    href="{{ route('privte_schedule') }}"><span>@lang('messages.thiet_ke_lich_trinh_rieng')</span></a></li>
                            <li class=""><a
                                    href="{{ route('blog.index') }}"><span>@lang('messages.bai_viet')</span></a></li>
                            <li class=""><a
                                    href="{{ route('blog.index') }}"><span>@lang('messages.menu.blog')</span></a></li>
                        </ul>

                        <div class="header-title">
                            <p class="header">@lang('messages.dang_ky_nhan_thong_tin')</p>
                        </div>
                        <p class="description">
                            @lang('messages.dang_ky_de_cap_nhat_thong_tin')
                        </p>
                        <form method="post" class="form email-register-form" action="{{ route('newllter') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input">
                                    <input name="email" type="text" placeholder="@lang('messages.nhap_email')"
                                        class="form-control input-lg" required="">
                                </div>
                                <div class="button">
                                    <button type="submit"
                                        class="btn btn-register text-uppercase">@lang('messages.confirm')</button>
                                </div>
                            </div>
                        </form>
                        <div class="left-show-mobile">
                            <ul>
                                <li class=""><a
                                        href="{{ route('about') }}"><span>@lang('messages.ve_chung_toi')</span></a>
                                </li>
                                <li class=""><a
                                        href="{{ route('service.index') }}"><span>@lang('messages.menu.service')</span></a>
                                </li>
                                <li class=""><a
                                        href="{{ route('faq') }}"><span>@lang('messages.FAQ')</span></a>
                                </li>
                                <li class=""><a
                                        href="{{ route('contact.index') }}"><span>@lang('messages.menu.contact')</span></a>
                                </li>
                                <li class=""><a><span>@lang('messages.chinh_sach_bao_mat')</span></a></li>
                                <li class=""><a
                                        href="{{ route('privte_schedule') }}"><span>@lang('messages.thiet_ke_lich_trinh_rieng')</span></a>
                                </li>
                                <li class=""><a
                                        href="{{ route('blog.index') }}"><span>@lang('messages.bai_viet')</span></a></li>
                                <li class=""><a
                                        href="{{ route('blog.index') }}"><span>@lang('messages.menu.blog')</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 right">
                        <div class="header-title hide-mobile">
                            <p class="header text-center">@lang('messages.blog.danh_muc')</p>
                        </div>
                        <ul>
                            @foreach (get_tour_group() as $item)
                                @php
                                    $_url = route('tour.category', ['slug' => $item->slug]);
                                @endphp
                                <li>
                                    <a href="{{ $_url }}">
                                        {{ get_data_lang($item, 'name') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="box-social">
                    <div class="box-icon-social">
                        <a href="http://">
                            <img src="/style/images/icon/icon social media-01 1.png" alt="Image">
                        </a>
                        <a href="http://">
                            <img src="/style/images/icon/icon social media-02 1.png" alt="Image">
                        </a>
                        <a href="http://">
                            <img src="/style/images/icon/icon social media-03 1.png" alt="Image">
                        </a>
                        <a href="http://">
                            <img src="/style/images/icon/icon social media-04 1.png" alt="Image">
                        </a>
                        <a href="http://">
                            <img src="/style/images/icon/icon social media-05 1.png" alt="Image">
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-box">
                <div class="row" style="gap: 0px;">
                    <div class="col-md-6">
                        <p>DiamondTour</p>
                    </div>
                    <div class="col-md-6">
                        <div class="content copy-right">
                            <a href="{{ route('home') }}">Copyright © 2023. All rights reserved</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

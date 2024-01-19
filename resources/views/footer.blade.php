<footer>
    <div class="box-footer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12 col-lg-12 col-xl-9">
                    <div class="row gx-4">
                        <div class="col-md-3">
                            <section class="mb-3">
                                <div class="block-footer-header">
                                    <h2>Thông Tin Cần Biết</h2>
                                </div>
                                <div class="block-footer-content">
                                    <ul>
                                        <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                                        <li><a href="#">Dịch vụ</a></li>
                                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                                        <li><a href="#">Liên hệ</a></li>
                                    </ul>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-3">
                            <section class="mb-3">
                                <div class="block-footer-header">
                                    <h2>Liên Kết Hữu Ích</h2>
                                </div>
                                <div class="block-footer-content">
                                    <ul>
                                        <li><a href="#">Chính sách bảo mật</a></li>
                                        <li><a href="{{ route('destination.index') }}">Điểm đến</a></li>
                                        <li><a href="{{ route('blog.index') }}">Bài viết</a></li>
                                        <li><a href="#">Điều khoản</a></li>
                                    </ul>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6">
                            <section class="mb-3">
                                <div class="block-footer-header">
                                    <h2>Đăng Ký Nhận Thông Tin</h2>
                                </div>
                                <div class="block-footer-content">
                                    <p>Đăng ký nhận thông tin của chúng tôi để cập nhật những tin tức mới nhất về các
                                        chương trình tour.</p>
                                    <form id="form_newsletter" class="form-newsletter" action="#" method="post">
                                        <input type="email" class="form-control"
                                            placeholder="Để lại số điện thoại của bạn">
                                        <button class="btn btn-submit" type="submit">Đăng ký</button>
                                    </form>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12">
                            <div class="block-footer-introduce my-4 mb-3">
                                <div class="introduce-logo">
                                    <a href="{{ route('index') }}">
                                        <img src="{{ $seo['seo-logo']??'' }}" alt=""
                                            class="d-block mx-auto img-fluid">
                                    </a>
                                </div>
                                <div class="introduce-content">
                                    {!! get_option('footer-info') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-3">
                    <div class="ratio ratio-21x9 mt-5">
                        {!! get_option('google-map') !!}
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
                                    <a href="{{ $item->link }}">{!! $item->icon !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <p class="text-center text-sm-end">
                            {{ get_option('copyright') }}
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

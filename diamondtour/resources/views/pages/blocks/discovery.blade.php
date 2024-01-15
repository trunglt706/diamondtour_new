<section>
    <div class="box-discovery">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4">
                    <div class="block-discovery-content">
                        <h2>Hãy bắt đầu hành trình khám phá của bạn cùng Diamond Tour</h2>
                        <p>Cùng đi xa, để biết thật nhiều, để thể nghiệm cuộc sống khác mình ở những miền đất lạ, tìm ra
                            những giá trị chân thực trong những chuyến đi!</p>
                        <a href="{{ route('tour.index') }}" class="btn btn-more">Xem thêm</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="block-discovery-list">
                        <div class="row gx-3 gy-3 gx-lg-5 gy-lg-5">
                            @for ($i = 0; $i < 8; $i++)
                                <div class="col-sm-6">
                                    <a href="#" class="discovery-tour-item"
                                        style="background-image: url({{ asset('assets/images/tour-discovery-1.jpg') }})">
                                        <h3>Tour Tây Tạng</h3>
                                    </a>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

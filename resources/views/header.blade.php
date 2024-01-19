<header>
    <div class="box-header">
        <!-- Mobile Header -->
        <div class="wsmobileheader clearfix ">
            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
            <span class="smllogo">
                <a href="{{ route('index') }}">
                    <img src="{{ $seo['seo-logo'] }}" width="80" alt="" />
                </a>
            </span>
        </div>
        <!-- Mobile Header -->
        <div class="container">
            <div class="block-header-main--wrap d-flex flex-row w-100 h-100 align-items-center justify-content-between">
                <div class="block-header-main--logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ $seo['seo-logo'] }}" alt="" class="img-fluid">
                    </a>
                </div>
                <div class="block-header-main--menu">
                    <div class="wsmainwp clearfix">
                        <nav class="wsmenu clearfix">
                            <ul class="wsmenu-list">
                                @foreach ($menus as $item)
                                    <li>
                                        <a class="{{ Request::is($item->active) ? 'active' : '' }}"
                                            href="{{ $item->link }}">
                                            {{ $item->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="block-header-main--navigation">
                  <div class="d-flex flex-wrap">
                    <div class="block-header-top--language">
                      <a href="#" class="current-language">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAZJJREFUeNqs1T9Lw0AYBvC7aiwNgjgYHYoEXLSb2s6ioIsUwcHv4OAiTh2cO+rk4JbRyc8guDm56iDqJAhC8U81yfm88dXGy3vBwYNfm1zuniZ5k6s2ytmqEEAFNPfR8BQeoC/OMrIWHEMKxpLysaY01+7woVsICWGiEGx4rO8K9OBEmGRMB7bFQMNzPDuQOg4dE4y5hHNnoOG5Xj5w3jl4FmJ4hqnSUMrIKliDHWetN2GIR22oskYZNY3UOjZu1AymtbHV4weD2jt0oMH7F3AAI7w/zD90CrcqwWdIlxtmpzwKe/ACH/DGl2ks1NfnMU9cLP/nsnOBpArrcC0E2ahQy+D9uo9W4LcAIj4TO4jO/AjGxMI4AkkD7oTAK6g7Kx1SlWNICjVbU1/lsts0rIpVpoyYAh8hKhxe4u9X6HJ1E67wihgYZVnig00Pc8KX1871b8E99GBSfrDlV28fzmBOuE8LfGy3/NUbLA4VDFiE8ZLXLOAx2r04DJYvLSxfbqXLV17zDwtsS5qr//sv4FOAAQDkpzDITJZ19QAAAABJRU5ErkJggg==" style="width: 20px; margin-top: -3px;">
                        VI
                      </a>
                      <div class="option-select">
                        <ul>
                          <li>
                            <a href="/lang/vi">
                              <img class="mr-1" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAZJJREFUeNqs1T9Lw0AYBvC7aiwNgjgYHYoEXLSb2s6ioIsUwcHv4OAiTh2cO+rk4JbRyc8guDm56iDqJAhC8U81yfm88dXGy3vBwYNfm1zuniZ5k6s2ytmqEEAFNPfR8BQeoC/OMrIWHEMKxpLysaY01+7woVsICWGiEGx4rO8K9OBEmGRMB7bFQMNzPDuQOg4dE4y5hHNnoOG5Xj5w3jl4FmJ4hqnSUMrIKliDHWetN2GIR22oskYZNY3UOjZu1AymtbHV4weD2jt0oMH7F3AAI7w/zD90CrcqwWdIlxtmpzwKe/ACH/DGl2ks1NfnMU9cLP/nsnOBpArrcC0E2ahQy+D9uo9W4LcAIj4TO4jO/AjGxMI4AkkD7oTAK6g7Kx1SlWNICjVbU1/lsts0rIpVpoyYAh8hKhxe4u9X6HJ1E67wihgYZVnig00Pc8KX1871b8E99GBSfrDlV28fzmBOuE8LfGy3/NUbLA4VDFiE8ZLXLOAx2r04DJYvLSxfbqXLV17zDwtsS5qr//sv4FOAAQDkpzDITJZ19QAAAABJRU5ErkJggg==" style="width: 20px">
                              Tiếng Việt
                            </a>
                          </li>
                          <li>
                            <a href="/lang/en">
                              <img class="mr-1" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABJlJREFUeNqkVGtsFFUU/ubund1ld7u70O7SElpASkvZoiBReRVMfJRACRqkEQv6AzVBCIlalQoEiyZNkF+a+AhoRBJNE3/YAvIwFNjKyxdUpZYCbWHb0i6lu93HzHRm5453dpEWlV+e5M69mfvdc88933eOsOvzIyBEwLCi4IcLvQhFgFwPvC6HfeHyZXPqnt5ZXexpPgnDQhB9rByNm3a0Hzr069uSrDSHIkbE6bSgyi9hPEkhZQgguG2GYYAxRvlc/ke33hxs1/dPu89f6okPiFAUUUhK4lg5IhZOygkca9Uazl/Tz/JDy1KGQRlGjOiUIkUsoKJIs8e6tvx5Qz/cG9JKedDmLfwjjIJn1oSH0X1tuKh1kB4oyPVutdusFLrOnemg4/p7kOLePLMCtY88HKgRnRdRf6QTMUnL+PuHmS+JyTqck31Y/WAWNvQ0bVcVJevS9Nlbmc0m0yltF0Alad7Ui8Gaie++gTnbnsC80hZ8c+IahHSUd3mDIFrxaNlUrBFDqDr1IXC8CbFN1a/9Nq3o6xgjP9PO6bOcuf09OyZ+XAvtdBBk8+tYt3I5Fsz0wZnjAEuxO4nW+ZPzqYJPb3yLgsavYHh9kD7ZA+szKyA2Xall/bdW0YG8Aqtv7kOLE4/PhHjgO6CjC7HOXkwumQaVjIHp7o5DgXD6rXBl2yG//ArUqtVgRUXgpGFstndpX3jQRif1dS2Zbw2DOe1QF5dBSCRBW1qgX74M4nRAiEVHGAzfBM6cgxSYCcPlBLnaAdLaCoMZmK8xJIaGlwinn994cF7jvqXpVPEI0oljLMMwXwvxOEwG08YVYWS5MjiDY9hIgs1j555ae5g64tEJiA7dJY57WioFIRK957YjNpRL5SxPN9xZszISuX3j35GarCYSmYhNs1hgOBwZnIkxxWoe4fsmXHJ7u+nVktl7C8tmV1hFnnxeXobVBkEdTueSZY+DY/MWWDo6MqRML4ZUux2CJAOyxHEa4HRC55eoSRnXI5YvSJvL//3JkoXQnq2EumYNWOkMkPZ22LtDYEuehOH3jcjQ74e+shKoqkRqURlIJAJ6/jyY241g4QL05E89RuzEUAfDA/UuRYJ19264K1bAsXcP+hIaYkkVZFS5EE5EPBZDOHQLnkm5MCYXgDSdgHfVSlj2Nxz09l5Xic2TJRuK8p5cWwfXhvUQHgig/tUPsN63DCHVyjWojzikBN0DMqo/+gX1zT2wrH0B9GgDup57Cc5If+34jjaJju/tAlHVq5cGlDrri2/VfJa/CPuOD0GNX8ablSUZckZpI6UbOPRTH0782IfTv4exuqIE8rqN77DGhhZbkmvYHb1lkiW3Fd+/7WjKF2sI3qhLXo/BP8XDify3mMxfboeIcGcUXx7tQjI2VJNj199nuleH6AZlXAqcW2iKqvfcjOyckc2aI7YxuxKMzE23q9Et53Y7MxtyScB7Nsdrqw4Pxs8M2w3GiA1mjZLRnc4iCMxuFU5RUSgvziPzr3T2B8O+fE3Ly+NjgtbnnaB1hAaCgXzbAkpJ+RgbOUUIYZTLjddQegjGfzW9/2F/CTAAkET/2KdoCMAAAAAASUVORK5CYII=" style="width: 20px">
                              Tiếng Anh
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <ul>
                      <li><a href="javascript:void(0)" id="navSearch" class="nav-search"><i class="fa-solid fa-magnifying-glass"></i></a></li>
                      <li><a href="javascript:void(0)" id="navContactUs" class="nav-contact-us"><i class="fa-solid fa-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>

        <div class="box-offcanvas-search">
          <button id="offcanvas-search" type="button" class="btn-close d-block mb-3" name="button"></button>
          <h2 class="mb-3 text-white fs-4">Tìm kiếm thông tin</h2>
          <form class="form-newsletter" action="#" method="post">
            <input type="text" class="form-control" placeholder="Nhập tứ khóa tìm kiếm">
            <button class="btn btn-submit" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
        </div>
        <div class="box-offcanvas-contact-us">
          <button id="offcanvas-contact-us" type="button" class="btn-close d-block mb-3" name="button"></button>
          <div class="-about">
            <img src="{{ $seo['seo-logo'] }}" alt="" class="img-fluid">
            <p>Khao khát truyền tải giá trị, cảm hứng và trải nghiệm du lịch khác biệt tới Quý khách hàng!</p>
          </div>
          <div class="-content">
            <h2>Liên hệ:</h2>
            <ul>
              <li>Số 15 ngõ 1, Phan Huy Chú, Yết Kiêu, Hà Đông, Hanoi, Vietnam</li>
              <li>(+84) 905 615 666</li>
              <li>info@diamondtour.vn</li>
            </ul>
          </div>
          <ul class="-social">
            @foreach ($socials as $item)
              <li>
                <a href="{{ $item->link }}">{!! $item->icon !!}</a>
              </li>
            @endforeach
          </ul>
        </div>
    </div>
</header>

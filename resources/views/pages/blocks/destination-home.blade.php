@if ($data['tours'])
    <section>
        <div class="box-destination-home">
            <div class="container">
                <div class="block-section-header text-center">
                    <h2>@lang('messages.cap_nhat_nhung_hanh_trinh')</h2>
                    <p class="text-center">
                        @lang('messages.kham_pha_nhung_cung_duong')
                    </p>
                </div>
                <div class="block-destination-header">
                    <ul class="nav nav-pills justify-content-center" id="pills-destination-home" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-uppercase" id="pills-destination-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-destination" type="button" role="tab"
                                aria-controls="pills-destination" aria-selected="true">
                                @lang('messages.tour_noi_bat')
                            </button>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-activity-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-activity" type="button" role="tab"
                            aria-controls="pills-activity" aria-selected="false">ACTIVITY</button>
                    </li> --}}
                    </ul>
                </div>
                <div class="block-destination-content">
                    <div class="tab-content" id="pills-destination-home-content">
                        <div class="tab-pane fade show active" id="pills-destination" role="tabpanel"
                            aria-labelledby="pills-destination-tab" tabindex="0">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 gx-5">
                                @foreach ($data['tours'] as $item)
                                    @php
                                        $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                        $_item_name = $item->$item_name ?? $item->name;
                                        $item_group_name = $locale == 'vi' ? 'group_name' : 'group_name_' . $locale;
                                        $_item_group_name = $item->$item_group_name ?? $item->group_name;
                                    @endphp
                                    <div class="col">
                                        <a href="{{ route('tour.detail', ['alias' => $item->slug]) }}"
                                            class="destination-home-item"
                                            style="background-image: url({{ get_url($item->image) }})">
                                            <div class="-content">
                                                <div class="-info">
                                                    <h2>{{ $_item_name }}</h2>
                                                    <p>{{ $_item_group_name }}</p>
                                                </div>
                                                {{-- <div class="-price">
                                                    <small>Chỉ với</small>
                                                    <p>{{ number_format($item->price) }}
                                                        {{ $item->currency }}</p>
                                                </div> --}}
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="pills-activity" role="tabpanel" aria-labelledby="pills-activity-tab"
                        tabindex="0">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gx-5 gy-5">
                            @for ($i = 0; $i < 6; $i++)
                                <div class="col">
                                    <div class="activity-home-item">
                                        <div class="-image">
                                            <a href="{{ route('blog.detail', ['alias' => $i]) }}">
                                                <img loading="lazy" src="{{ get_url('assets/images/destinations_item.png') }}"
                                                    class="img-fluid" alt="image">
                                            </a>
                                        </div>
                                        <div class="-content">
                                            <h3><a href="#">ẤN ĐỘ – TÂY TẠNG VÀ CÂU CHUYỆN CỦA HÌNH ẢNH (phần
                                                    2)</a>
                                            </h3>
                                            <p>Một bức ảnh được chụp với Leica cũng vậy, nó là sự kết hợp của</p>
                                            <a href="#" class="read-more">Xem thêm <i
                                                    class="fa-solid fa-arrow-right d-inline-block ms-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

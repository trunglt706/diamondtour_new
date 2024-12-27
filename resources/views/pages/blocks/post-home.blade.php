<section>
    <div class="box-post-home">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 gx-5">
                <div class="col">
                    <div class="block-section-header">
                        <h2>@lang('messages.tham_khao_bai_viet_va_meo_du_lich')</h2>
                        <p>
                            @lang('messages.thong_tin_moi_cau_chuyen_noi_bat')
                        </p>
                        <a href="{{ route('blog.index') }}" class="btn btn-more">@lang('messages.xem_them')</a>
                    </div>
                    @foreach ($data['blog1'] as $item)
                        @php
                            $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                            $_item_name = $item->$item_name ?? $item->name;
                        @endphp
                        <div class="post-home-first-item">
                            <img loading="lazy" src="{{ get_url($item->image) }}" class="img-fluid"
                                alt="{{ $_item_name }}">
                            <div class="overlay-content">
                                <h3>{{ $_item_name }}</h3>
                                <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}" class="read-more">
                                    @lang('messages.xem_them') <i class="fa-solid fa-arrow-right d-inline-block ms-1"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col">
                    <div class="block-post-home-list">
                        @foreach ($data['blog2'] as $item)
                            @php
                                $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                $_item_name = $item->$item_name ?? $item->name;
                            @endphp
                            <div class="post-home-item">
                                <div class="-image">
                                    <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}">
                                        <img loading="lazy" src="{{ get_url($item->image) }}" alt="image"
                                            class="img-fluid">
                                    </a>
                                </div>
                                <div class="-content">
                                    <h3>
                                        <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}">
                                            {{ $_item_name }}
                                        </a>
                                    </h3>
                                    <p>{{ $item->description }}</p>
                                    <a href="{{ route('blog.detail', ['alias' => $item->slug]) }}" class="read-more">
                                        @lang('messages.xem_them') <i class="fa-solid fa-arrow-right d-inline-block ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

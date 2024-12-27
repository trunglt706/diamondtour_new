<section>
    <div class="box-about-home">
        <div class="container">
            <div class="about-home--header">
                <div class="row row-cols-1 row-cols-sm-2 gx-4">
                    <div class="col">
                        <h2>@lang('messages.bat_dau_trai_nghiem_tuyet_voi')</h2>
                    </div>
                    <div class="col">
                        <p>
                            @lang('messages.dong_hanh_cung_diamontour')
                        </p>
                        <a href="{{ route('tour.index') }}" class="btn btn-more">@lang('messages.xem_them')</a>
                    </div>
                </div>
            </div>
        </div>
        @php
            $about_images = $seo['about-images'];
            $about_images = $about_images ? json_decode($about_images) : [];
        @endphp
        @if ($about_images && count($about_images) >= 3)
            <div class="box-image-row-single-page">
                <div class="col-left" style="background-image: url({{ get_url($about_images[0]) }})">
                </div>
                <div class="col-right" style="background-image: url({{ get_url($about_images[1]) }})">
                </div>
            </div>
            <div class="box-image-row-single-page d-sm-block d-none">
                <div class="col-right-content">
                    <div class="container-fluid">
                        <div class="row row-cols-2 gx-4">
                            <div class="col">
                                <div class="-image-child-item">
                                    <img loading="lazy" src="{{ get_url($about_images[2]) }}" loading="lazy"
                                        class="img-fluid" alt="@lang('messages.gioi_thieu')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

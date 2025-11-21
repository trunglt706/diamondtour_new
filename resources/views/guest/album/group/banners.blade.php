<div class="wrapper home list-album">
    <div class="widget_banner_3">
        <div class="box-banner">
            <div class="box-content">
                {{-- <p class="title-top">@lang('messages.album.diem_den_moi')</p> --}}
                <p class="title text-uppercase">{{ get_data_lang($data['tour_group'], 'name') }}</p>
                <p class="description">
                    {{ $data['tour_group']->description }}
                </p>
            </div>
            <div class="box-img">
                <div class="img">
                    <img src="{{ asset('style/images/banner/default.jpg') }}" data-src="{{ get_file($data['tour_group']->image) }}" alt="Image" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</div>

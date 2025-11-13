@php
    $images = $data['menu']->images ? json_decode($data['menu']->images) : [];
@endphp
<div class="widget_slider">
    <div class="box-content">
        <div class="widget_slider_banner">
            @foreach ($images as $item)
                <div>
                    <a href="#">
                        <img src="{{ asset('style/images/banner/default.jpg') }}" data-src="{{ asset($item) }}" alt="Image" loading="lazy">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

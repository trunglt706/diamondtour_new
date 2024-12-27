@php
    $about_images = $data['about_images'];
@endphp
@if (count($about_images) > 0)
    <div class="widget_gallery_style_1">
        <div class="list-image">
            @foreach ($about_images as $item)
                <div class="img">
                    <a data-fancybox="gallery" data-src="{{ asset($item->url) }}">
                        <img src="{{ asset($item->url) }}" alt="Image" srcset="">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif

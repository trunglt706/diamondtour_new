@if ($data['services']->count() > 0)
    <div class="widget_item_style_3">
        <div class="container">
            <div class="box-item">
                @foreach ($data['services'] as $item)
                    <a href="#service-{{ $item->id }}">
                        <div class="item item-post-horizontal wow animated fadeIn">
                            <div class="img">
                                <img src="{{ get_file($item->image) }}" alt="Image" loading="lazy">
                            </div>
                            <p class="title">{{ get_data_lang($item, 'name') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif

<section>
    <div class="box-companion-private">
        <div class="container">
            @if ($data['faq_group'])
                <div class="companion-private--header">
                    <div class="row row-cols-1 row-cols-sm-2 gx-4">
                        <div class="col">
                            <h2>@lang('messages.faq_thuong_gap')</h2>
                        </div>
                        <div class="col">
                            <p></p>
                            <a href="{{ route('faq') }}" class="btn btn-more">@lang('messages.xem_them')</a>
                        </div>
                    </div>
                </div>
                <div class="block-style-accordion companion-private--content">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="row row-cols-1 row-cols-sm-2">
                            @foreach ($data['faq_group']->qas as $index => $item)
                                @php
                                    $item_name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                    $_item_name = $item->$item_name ?? $item->name;
                                    $item_description = $locale == 'vi' ? 'description' : 'description_' . $locale;
                                    $_item_description = $item->$item_description ?? $item->description;
                                @endphp
                                <div class="col">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse{{ $item->id }}"
                                                aria-expanded="false" aria-controls="flush-collapse{{ $item->id }}">
                                                {{ $_item_name }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{ $item->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                {!! $_item_description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="companion-private--embed">
                <div class="ratio ratio-21x9">
                    <iframe width="1320px" height="650px" title="myFrame"
                        src="https://www.youtube.com/embed/8GFuxiE3He4?autoplay=1&mute=1&loop=1&controls=0"
                        title="South East Asia - 1 Year around Asia | 4K Cinematic Travel Video" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

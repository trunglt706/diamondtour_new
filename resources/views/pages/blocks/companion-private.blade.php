<section>
    <div class="box-companion-private">
        <div class="container">
            <div class="companion-private--header">
                <div class="row row-cols-1 row-cols-sm-2 gx-4">
                    <div class="col">
                        <h2>@lang('messages.thiet_ke_hanh_trinh_phu_hop')</h2>
                    </div>
                    <div class="col">
                        <p>@lang('messages.lua_chon_cac_chu_de_tour')</p>
                        <p>@lang('messages.hotline_hoac_fb')</p>
                        <a href="{{ route('privte_schedule') }}" class="btn btn-more">@lang('messages.xem_them')</a>
                    </div>
                </div>
            </div>
            @if ($data['tour_groups'])
                <div class="block-style-accordion companion-private--content">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="row row-cols-1 row-cols-sm-2">
                            @foreach ($data['tour_groups'] as $item)
                                <div class="col">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed ps-0" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse{{ $item->id }}"
                                                aria-expanded="false" aria-controls="flush-collaps{{ $item->id }}">
                                                {{ $item->name }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{ $item->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body ps-0">
                                                {{ $item->description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @php
                $video_design = $seo['about-video-design-tour'];
            @endphp
            @if ($video_design)
                <div class="companion-private--embed">
                    <div class="ratio ratio-21x9">
                        {!! $video_design !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

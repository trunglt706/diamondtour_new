<div class="widget_tour_1">
    <div class="container">
        <div class="header-title header-title-style-3">
            <p class="header">{{ __('messages.destination') }}</p>
        </div>
        <div class="row">
            @foreach ($data['tours'] as $tour)
                @php
                    $_url = route('demo.destination.detail', ['slug' => $tour->slug]);
                @endphp
                <div class="col-md-4 col-12">
                    <div class="tour-item">
                        <div class="img">
                            <a href="{{ $_url }}">
                                <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ asset('style/images/blank.jpg') }}" data-src="{{ $tour->image ? asset($tour->image) : asset('/style/images/post/butan.png') }}"
                                    alt="Image" loading="lazy" height="293px" width="416px">
                            </a>
                        </div>
                        <div class="title">
                            <div class="top">
                                <h3 class="header-tour-detail">
                                    <a href="{{ $_url }}">{{ get_data_lang($tour, 'name') }}</a>
                                </h3>
                                <a class="btn-read-more" href="{{ $_url }}">@lang('messages.view_now') ></a>
                            </div>
                            <div class="list-icon-share">
                                <a href="#">
                                    <i class="fas fa-globe-asia"></i> {{ $tour->country_name ?? '' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 text-center">
            {!! $pagination = $data['tours']->appends(request()->all())->links() !!}
        </div>
    </div>
</div>

@if ($data['others'] && $data['others']->count() > 0)
    <div class="widget_tour_1 js_widget_tour_1_2">
        <div class="container">
            <div class="header-title">
                <p class="header text-uppercase">@lang('messages.tour.diem_den_theo_khu_vuc')</p>
            </div>
            <div class="row">
                @foreach ($data['others'] as $other)
                    @php
                        $_url = route('demo.destination.detail', ['slug' => $other->slug]);
                    @endphp
                    <div class="col-12">
                        <div class="tour-item">
                            <div class="img">
                                <a href="{{ $_url }}">
                                    <img src="{{ asset($other->image) }}" alt="Image" title="" loading="lazy">
                                </a>
                            </div>
                            <div class="title">
                                <div class="list-icon-share">
                                    <a href="#">
                                        <i class="fas fa-map-marker-alt"></i> {{ $other->province_name ?? '' }}
                                    </a>
                                </div>
                                <div class="top">
                                    <h3 class="header-tour-detail">
                                        <a href="{{ $_url }}">{{ $other->name }}</a>
                                    </h3>
                                    <a class="btn-read-more" href="{{ $_url }}">@lang('messages.view_now')</a>
                                </div>
                                <p class="description">
                                    {!! $other->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-5 d-flex justify-content-center">
                {!! $data['others']->appends(request()->all())->links() !!}
            </div>
        </div>
    </div>
@endif

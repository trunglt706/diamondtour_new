<div class="widget_tour_1">
    <div class="container">
        <div class="header-title header-title-style-3">
            <p class="header">{{ $item ? __('messages.destination') : __('messages.tour.list') }}</p>
            {{-- <a class="read-more" href="">@lang('messages.xem_them')<span> &#x279D;</span></a> --}}
        </div>
        <div class="row">
            @foreach ($data['tours'] as $item)
                @php
                    $_url = route('demo.destination.detail', ['slug' => $item->slug]);
                @endphp
                <div class="col-md-4 col-12">
                    <div class="tour-item">
                        <div class="img">
                            <a href="{{ $_url }}">
                                <img src="{{ $item->image ? asset($item->image) : asset('/style/images/post/butan.png') }}"
                                    alt="" title="" loading="lazy">
                            </a>
                        </div>
                        <div class="title">
                            <div class="top">
                                <h3 class="header-tour-detail">
                                    <a href="{{ $_url }}">{{ get_data_lang($item, 'name') }}</a>
                                </h3>
                                <a class="btn-read-more" href="{{ $_url }}">@lang('messages.view_now')</a>
                            </div>
                            <div class="list-icon-share">
                                <a href="#"><i class="fa-solid fa-share-nodes"></i> @lang('messages.share')</a>
                                <a href="#"><i class="fa-solid fa-eye"></i> @lang('messages.Views')</a>
                                <a href="#"><img src="/style/images/icon/Group2221.png" alt=""
                                        srcset="">
                                    @lang('messages.comment')</a>
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

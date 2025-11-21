    <div class="js_widget_builder js_widget_post_style_1_5 widget_post_style_1 p-b-50">
        <div class="container">
            <div class="box-header row">
                <div class="header-title header-title-style-1 col-md-6 col-12">
                    <p class="header">@lang('messages.tour.tour_design')</p>
                    <p class="header-text-bottom">@lang('messages.tour.tour_design_des')</p>
                </div>
                <div class="des col-md-6 col-12">
                    <p class="description">
                        @lang('messages.tour.tour_design_more')
                    </p>
                    @php
                        $t = isset($data['t']) ? $data['t'] : 0;
                    @endphp
                    <a class="read-more"
                        href="{{ route('tour.category', ['slug' => 'design']) }}?t={{ $t }}">
                        @lang('messages.tour.view_toan_bo')
                    </a>
                </div>
            </div>

            <div class="widget_service p-t-0">
                <div class="">
                    <div class="header-title">
                        {{-- <p class="header-text-top">Diamond Tour</p> --}}
                        <p class="header">@lang('messages.tour.main_activity')</p>
                        <p class="description">
                            @lang('messages.tour.main_activity_des')
                        </p>
                    </div>
                    <div class="box-content">
                        <div class="container">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="item1-tab" data-bs-toggle="tab"
                                        data-bs-target="#item1-content" type="button" role="tab"
                                        aria-controls="item1-content" aria-selected="true">
                                        <div class="box-item">
                                            <div class="icon-item">
                                                <div class="img">
                                                    <img src="/style/images/item/maybay.png" alt="maybay">
                                                </div>
                                            </div>
                                            <div class="title-box-item">
                                                <p class="font-NotoSans-Bold">@lang('messages.tour.Camping')</p>
                                            </div>
                                        </div>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="item2-tab" data-bs-toggle="tab"
                                        data-bs-target="#item2-content" type="button" role="tab"
                                        aria-controls="item2-content" aria-selected="false">
                                        <div class="box-item">
                                            <div class="icon-item">
                                                <div class="img">
                                                    <img src="/style/images/item/tructhang.png" alt="Image">
                                                </div>
                                            </div>
                                            <div class="title-box-item">
                                                <p class="font-NotoSans-Bold">@lang('messages.tour.Adventure')</p>
                                            </div>
                                        </div>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="item3-tab" data-bs-toggle="tab"
                                        data-bs-target="#item3-content" type="button" role="tab"
                                        aria-controls="item3-content" aria-selected="false">
                                        <div class="box-item">
                                            <div class="icon-item">
                                                <div class="img">
                                                    <img src="/style/images/item/xehoi.png" alt="Image">
                                                </div>
                                            </div>
                                            <div class="title-box-item">
                                                <p class="font-NotoSans-Bold">@lang('messages.tour.Kayaking')</p>
                                            </div>
                                        </div>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="item3-tab" data-bs-toggle="tab"
                                        data-bs-target="#item4-content" type="button" role="tab"
                                        aria-controls="item3-content" aria-selected="false">
                                        <div class="box-item">
                                            <div class="icon-item">
                                                <div class="img">
                                                    <img src="/style/images/item/cuoingua.png" alt="Image">
                                                </div>
                                            </div>
                                            <div class="title-box-item">
                                                <p class="font-NotoSans-Bold">@lang('messages.tour.Hiking')</p>
                                            </div>
                                        </div>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="item3-tab" data-bs-toggle="tab"
                                        data-bs-target="#item5-content" type="button" role="tab"
                                        aria-controls="item3-content" aria-selected="false">
                                        <div class="box-item">
                                            <div class="icon-item">
                                                <div class="img">
                                                    <img src="/style/images/item/ditau.png" alt="Image">
                                                </div>
                                            </div>
                                            <div class="title-box-item">
                                                <p class="font-NotoSans-Bold">@lang('messages.tour.OffRoad')</p>
                                            </div>
                                        </div>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @if ($data['design']->count() > 0)
                <div class="box-content d-none">
                    <div class="post">
                        <div class="post-detail">
                            @foreach ($data['design'] as $item)
                                @php
                                    $_url = route('tour.detail', ['slug' => $item->slug]);
                                @endphp
                                <div class="item item-post-horizontal wow animated fadeIn m-b-20">
                                    <div class="img">
                                        <a href="{{ $_url }}">
                                            <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ $item->image ? get_file($item->image) : asset('/style/images/post/Rectangle 212333.png') }}"
                                                alt="Image" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="title">
                                        <h3 class="header">
                                            <a href="{{ $_url }}">{{ get_data_lang($item, 'name') }}</a>
                                        </h3>
                                        <div class="description">
                                            <a href="{{ $_url }}">
                                                {{ $item->duration ?? __('messages.dang_cap_nhat') }}
                                            </a>
                                        </div>
                                    </div>
                                    {{-- <div class="like">
                                    <i class="fa-solid fa-heart"></i>
                                </div> --}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

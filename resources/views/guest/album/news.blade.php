@if ($data['news']->count() > 0)
    <div class="js_widget_builder js_widget_post_style_1_12 widget_post_style_1">
        <div class="container">
            <div class="box-content">
                <div class="post">
                    <div class="post-detail">
                        @foreach ($data['news'] as $item)
                            @php
                                $_url = route('demo.library.category', ['slug' => $item->slug]);
                            @endphp
                            <div class="box-item">
                                <div class="item item-post-horizontal wow animated fadeIn">
                                    <div class="img">
                                        <a href="{{ $_url }}">
                                            <img src="{{ asset('style/images/blank.jpg') }}" data-src="{{ $item->image ? get_file($item->image) : asset('user/img/user/no-avatar.jpg') }}"
                                                alt="Image" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="title">
                                        {{-- <div class="date">{{ date('d/m/Y', strtotime($item->created_at)) }}</div> --}}
                                        <h3 class="header"><a href="{{ $_url }}">{{ $item->name }}</a>
                                        </h3>
                                    </div>
                                </div>
                                {{-- <div class="description">
                                    <p>
                                        {{ $item->description }}
                                    </p>
                                    <a href="{{ $_url }}">
                                        <svg width="50" height="13" viewBox="0 0 50 13" fill="none"
                                            xmlns="/www.w3.org/2000/svg">
                                            <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M49.344 13C50.6068 13 49.7254 11.5832 49.344 11.163L39.1279 0.315165C38.7464 -0.105054 38.128 -0.105054 37.7465 0.315165C37.3651 0.735383 37.3651 1.41669 37.7465 1.83691L46.2952 10.8479H0.976766C0.437313 10.8479 0 11.3296 0 11.9239C0 12.5182 0.437313 12.9999 0.976766 12.9999H46.2952C46.2952 12.9999 49.1417 13 49.344 13Z"
                                                fill="#A3A3A3" />
                                        </svg>
                                    </a>
                                </div> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

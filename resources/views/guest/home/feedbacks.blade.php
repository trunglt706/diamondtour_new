@if ($data['feedbacks']->count() > 0)
    <div class="widget_feed_style_1">
        <div class="container">
            <div class="header-title header-title-style-1">
                <p class="header-text-bottom c-blue">@lang('messages.home.feedback_header')</p>
                <p class="header c-black">@lang('messages.home.feedback_title')</p>
            </div>
            <div class="box-content">
                <div class="box-list-item">
                    @foreach ($data['feedbacks'] as $item)
                        <box class="item">
                            <div class="content">
                                <p>
                                    {{ $item->content }}
                                </p>
                            </div>
                            <div class="box-info">
                                <div class="avt">
                                    <div class="img">
                                        <img src="{{ $item->user_avatar ? asset($item->user_avatar) : asset('/style/images/user.png') }}"
                                            alt="Image" srcset="">
                                    </div>
                                    <div class="box-icon">
                                        <span>“</span>
                                    </div>
                                    <div class="rate-and-name">
                                        <div class="rate">
                                            @for ($i = 0; $i < 5; $i++)
                                                <img src="{{ asset('/style/images/icon/Character.png') }}"
                                                    alt="Image" srcset="">
                                            @endfor
                                        </div>
                                        <p class="name">{{ $item->user_name }}</p>
                                        <p class="position">{{ $item->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </box>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

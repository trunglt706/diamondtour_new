@if ($data['video'] && $data['video']->video_status == 'active' && $data['video']->video_url)
    @php
        $item = $data['video'];
    @endphp
    <div class="widget_video_style_1 widget_video_2">
        <div class="container">
            <div class="box-content">
                <div class="box-item">
                    <h3 class="title">
                        @lang('messages.album.video_yeu_thich')
                    </h3>
                    <h4 class="text-uppercase">{{ $item->video_name }}</h4>
                </div>
                <div class="box-video">
                    <div class="bg-video" style="background-image: url('{{ asset($item->video_image) }}');">
                        <div class="bt-play"></div>
                    </div>
                    <div class="video-container">
                        <iframe width="590" height="332" src="{{ $item->video_url }}?&amp;mute=1&amp;enablejsapi=1"
                            frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

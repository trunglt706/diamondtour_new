@if ($data['important'])
    @php
        $item = $data['important'];
        $_url = route('library.detail', ['slug' => $item->slug]);
    @endphp
    <div class="widget_video_style_1">
        <div class="container">
            <div class="header-title">
                <p class="header">@lang('messages.album.album_noi_bat')</p>
            </div>
            <div class="box-video">
                <div class="bg-video" style="background-image: url('{{ get_file($item->image) }}');">
                    <div class="bt-play"></div>
                </div>
                <div class="video-container">
                    <iframe width="590" height="332"
                        src="https://www.youtube.com/embed/DvPhlS6E64Y?&amp;mute=1&amp;enablejsapi=1" frameborder="0"
                        allowfullscreen="allowfullscreen"></iframe>
                </div>
            </div>
        </div>
    </div>
@endif

<section>
    <div class="box-breadcrumb-cover"
        style="background-image: url({{ isset($background) ? get_url($background) : '' }});">
        <div class="container">
            @if (isset($title))
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">@lang('messages.trang_chu')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ isset($link) ? $link : '#' }}">
                                {{ isset($title) ? $title : '' }}
                            </a>
                        </li>
                    </ol>
                </nav>
            @endif
            <h2>{{ isset($description) ? $description : '' }}</h2>
            @php
                if (isset($author) && isset($date_create)) {
                    echo '<p>' . $author . ' ' . $date_create . '</p>';
                }
            @endphp
            @php
                if (isset($sub)) {
                    echo '<p class="mt-3">' . $sub . '</p>';
                }
            @endphp
        </div>
    </div>
</section>

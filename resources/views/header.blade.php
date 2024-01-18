<header>
    <div class="box-header">
        <!-- Mobile Header -->
        <div class="wsmobileheader clearfix ">
            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
            <span class="smllogo">
                <a href="{{ route('index') }}">
                    <img src="{{ $seo['seo-logo']??'' }}" width="80" alt="" />
                </a>
            </span>
        </div>
        <!-- Mobile Header -->
        <div class="container">
            <div class="block-header-main--wrap d-flex flex-row w-100 h-100 align-items-center justify-content-between">
                <div class="block-header-main--logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ $seo['seo-logo']??'' }}" alt="" class="img-fluid">
                    </a>
                </div>
                <div class="block-header-main--menu">
                    <div class="wsmainwp clearfix">
                        <nav class="wsmenu clearfix">
                            <ul class="wsmenu-list">
                                @foreach ($menus as $item)
                                    <li>
                                        <a class="{{ Request::is($item->active) ? 'active' : '' }}"
                                            href="{{ $item->link }}">
                                            {{ $item->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="block-header-main--navigation">
                </div>
            </div>
        </div>
    </div>
</header>

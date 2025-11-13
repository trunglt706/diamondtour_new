<div class="widget_item_1">
    <div class="container">
        <div class="widget_item_1_detail">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="box-item">
                        <div class="icon">
                            <img src="{{ asset('/style/images/icon/diemden.png') }}" alt="Image">
                        </div>
                        <div class="content-item">
                            <p class="title">
                                @lang('messages.destination')
                            </p>
                            <p class="des">
                                @lang('messages.where_to_go')
                            </p>
                        </div>
                    </div>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <div id="searchBox" class="mobile-form">
                        <form action="{{ route('demo.search') }}" class="search-form" id="searchform" method="get">
                            <input type="hidden" name="t" value="tour">
                            <input id="sbox" name="search" placeholder="@lang('messages.tim_kiem') ..." type="text"
                                x-webkit-speech="">
                            <span id="noEasy">
                                <button class="sb-icon-search border-0" type="submit"></button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="box-item">
                        <div class="icon">
                            <img src="{{ asset('/style/images/icon/hoatdong.png') }}" alt="Image">
                        </div>
                        <div class="content-item">
                            <p class="title">
                                @lang('messages.activity')
                            </p>
                            <p class="des">
                                @lang('messages.activity_all')
                            </p>
                        </div>
                    </div>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <div id="searchBox" class="mobile-form">
                        <form action="{{ route('demo.search') }}" class="search-form" id="searchform" method="get">
                            <input type="hidden" name="t" value="activity">
                            <input id="sbox" name="search" placeholder="@lang('messages.tim_kiem') ..." type="text"
                                x-webkit-speech="">
                            <span id="noEasy">
                                <button class="sb-icon-search border-0" type="submit"></button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="box-item">
                        <div class="icon">
                            <img src="{{ asset('/style/images/icon/lichtrinh.png') }}" alt="Image">
                        </div>
                        <div class="content-item">
                            <p class="title">
                                @lang('messages.schedule')
                            </p>
                            <p class="des">
                                @lang('messages.from_date')
                            </p>
                        </div>
                    </div>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                    <div class="box-calendar">
                        <input type="text" name="daterange" class="form-control" value="" />
                        <div class="my-2 text-center">
                            <button class="btn btn-submit-daterange btn-sm btn-submit-range btn-primary w-100">@lang('messages.tim_kiem')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

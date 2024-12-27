@php
    $description = $locale == 'vi' ? 'description' : 'description_' . $locale;
    $_description = $data['menu']->$description ?? $data['menu']->description;
    $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_name = $data['menu']->$name ?? $data['menu']->name;
@endphp
@extends('index')
@section('content')
    <style>
        .select2 {
            height: 45px;
        }

        .label-select2 {
            margin-bottom: 15px !important;
        }
    </style>
    <article class="article-wrapper-tour">
        @include('pages.blocks.breadcrumb', [
            'background' => $data['menu']->background,
            'title' => $_name,
            'description' => $_description,
        ])
        <section>
            <div class="box-wrapper-tour">
                <div class="block-tour-header-find">
                    <div class="container">
                        <form method="GET" action="{{ route('tour.index') }}">
                            @csrf
                            <div class="card-find-tour">
                                <div class="find-tour-control form-group">
                                    <label for="fr-tour-continental"
                                        class="form-label label-select2">@lang('messages.quoc_gia')</label>
                                    <select class="select2" data-style="btn btn-outline-default" data-wdith="100%"
                                        title="Chọn quốc gia" name="country">
                                        <option value="">-- @lang('messages.tat_ca') --</option>
                                        @foreach ($data['countries'] as $item)
                                            <option
                                                {{ isset($_GET['country']) && $_GET['country'] == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="find-tour-control form-group">
                                    <label for="from" class="form-label">@lang('messages.tu_ngay')</label>
                                    <div class="input-group">
                                        <input type="text" id="fr-tour-from" name="from"
                                            class="form-control datepicker" placeholder="VD: 01/01/2024"
                                            value="{{ isset($_GET['from']) ? $_GET['from'] : '' }}" autocomplete="off">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt calendar-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="find-tour-control form-group">
                                    <label for="to" class="form-label">@lang('messages.den_ngay')</label>
                                    <div class="input-group">
                                        <input type="text" id="fr-tour-to" name="to" class="form-control datepicker"
                                            value="{{ isset($_GET['to']) ? $_GET['to'] : '' }}" placeholder="VD: 01/01/2024"
                                            autocomplete="off">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt calendar-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="find-tour-control form-group">
                                    <label for="price" class="form-label label-select2">@lang('messages.ngan_sach_tu')</label>
                                    <select class="select2" data-style="btn btn-outline-default" data-wdith="100%"
                                        title="Chọn mức giá" name="price">
                                        <option value="">-- @lang('messages.tat_ca') --</option>
                                        @foreach ($data['balances'] as $item)
                                            <option
                                                {{ isset($_GET['price']) && $_GET['price'] == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="find-tour-control">
                                    <button type="submit" class="btn w-100 mh-50 btn-primary">
                                        @lang('messages.tim_kiem')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-tour-list">
                    <div class="container">
                        <div id="section-tour--content" class="section-tour--content">
                            <div class="th-grid-sizer"></div>
                            @foreach ($data['list'] as $index => $item)
                                @if ($index == 0 || $index == 5 || $index == 7)
                                    <div class="th-grid-item size-w-66 size-h-320">
                                        <a href="{{ route('tour.detail', ['alias' => $item->slug]) }}" class="tour-item"
                                            style="background-image: url({{ get_url($item->image) }});">
                                            <div class="overlay-content">
                                                <div class="-content-top">
                                                    <div class="-inner-title">
                                                        <h2>{{ $item->name }}</h2>
                                                        <small>{{ $item->withCountry ? $item->withCountry->name : '' }}</small>
                                                    </div>
                                                    <div class="-inner-date">
                                                        {{ $item->from ? date('d/m/Y', strtotime($item->from)) : '' }}
                                                        {{-- -
                                                        {{ $item->to ? date('d/m/Y', strtotime($item->to)) : '' }} --}}
                                                    </div>
                                                </div>
                                                <div class="-content-bottom">
                                                    <div class="-inner-content">
                                                        <p>{{ $item->description }}</p>
                                                    </div>
                                                    <div class="-inner-price">
                                                        {{-- <p class="-label">Chỉ từ</p> --}}
                                                        <p class="-price">
                                                            {{ $item->price > 0 ? number_format($item->price) . 'đ' : __('messages.dang_cap_nhat') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @elseif($index == 1 || $index == 3 || $index == 4 || $index == 6)
                                    <div class="th-grid-item size-w-33 size-h-320">
                                        <a href="{{ route('tour.detail', ['alias' => $item->slug]) }}" class="tour-item"
                                            style="background-image: url({{ get_url($item->image) }});">
                                            <div class="overlay-content">
                                                <div class="-content-top">
                                                    <div class="-inner-title">
                                                        <h2>{{ $item->name }}</h2>
                                                        <small>{{ $item->withCountry ? $item->withCountry->name : '' }}</small>
                                                    </div>
                                                    <div class="-inner-date">
                                                        {{ $item->from ? date('d/m/Y', strtotime($item->from)) : '' }}
                                                        {{-- -
                                                        {{ $item->to ? date('d/m/Y', strtotime($item->to)) : '' }} --}}
                                                    </div>
                                                </div>
                                                <div class="-content-bottom">
                                                    <div class="-inner-content">
                                                        <p>{{ $item->description }}</p>
                                                    </div>
                                                    <div class="-inner-price">
                                                        {{-- <p class="-label">Chỉ từ</p> --}}
                                                        <p class="-price">
                                                            {{ $item->price > 0 ? number_format($item->price) . 'đ' : __('messages.dang_cap_nhat') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    <div class="th-grid-item size-w-33 size-h-672">
                                        <a href="{{ route('tour.detail', ['alias' => $item->slug]) }}" class="tour-item"
                                            style="background-image: url({{ get_url($item->image) }});">
                                            <div class="overlay-content">
                                                <div class="-content-top">
                                                    <div class="-inner-title">
                                                        <h2>{{ $item->name }}</h2>
                                                        <small>{{ $item->withCountry ? $item->withCountry->name : '' }}</small>
                                                    </div>
                                                    <div class="-inner-date">
                                                        {{ $item->from ? date('d/m/Y', strtotime($item->from)) : '' }}
                                                        {{-- -
                                                        {{ $item->to ? date('d/m/Y', strtotime($item->to)) : '' }} --}}
                                                    </div>
                                                </div>
                                                <div class="-content-bottom">
                                                    <div class="-inner-content">
                                                        <p>{{ $item->description }}</p>
                                                    </div>
                                                    <div class="-inner-price">
                                                        {{-- <p class="-label">Chỉ từ</p> --}}
                                                        <p class="-price">
                                                            {{ $item->price > 0 ? number_format($item->price) . 'đ' : __('messages.dang_cap_nhat') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="box-pagination">
                    {!! $data['list']->appends(request()->all())->links() !!}
                </div>
            </div>
        </section>
        @include('pages.blocks.register_tour')
    </article>
@endsection
@section('plugins_style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datetimepicker/jquery.datetimepicker.min.css') }}"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2-theme.css') }}" type="text/css" />
@endsection
@section('plugins_script')
    <script src="{{ asset('assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
@section('script_module')
    <script type="text/javascript">
        $(function() {
            $(".select2").select2();
        });
    </script>
@endsection

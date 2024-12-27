@extends('index')
@section('content')
    <article>
        @include('pages.blocks.breadcrumb', [
            'background' => $data['menu']->background,
            'title' => $data['menu']->name,
            'description' => $data['menu']->description,
        ])
        <section>
            <div class="box-tour-calendar">
                <div class="container">
                    <div class="block-section-header">
                        {{-- <h2>Thông tin lịch khởi hành</h2> --}}
                        <p>@lang('messages.chung_toi_cung_phan_dau')</p>
                    </div>
                    @if ($data['calendars']->count() > 0)
                        <div class="box-tours-special-home">
                            <div class="swiper tours-special-home-slider-swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($data['calendars'] as $item)
                                        <div class="swiper-slide">
                                            <a href="{{ route('tour.detail', ['alias' => $item->tour->slug]) }}"
                                                class="destination-home-item"
                                                style="background-image: url({{ get_url($item->tour->image) }})">
                                                <div class="-label-hot">@lang('messages.HOT')</div>
                                                <div class="-content">
                                                    <div class="-info-special">
                                                        <div class="--start">@lang('messages.tg_khoi_hanh')
                                                            {{ date('d/m/Y', strtotime($item->start)) }}</div>
                                                        {{-- <div class="--during">
                                                            <i class="fa-regular fa-clock text-primary"></i>
                                                            {{ get_total_days($item->start, $item->end) }} ngày
                                                        </div> --}}
                                                        <h2>
                                                            {{ $item->tour->name }}
                                                        </h2>
                                                        @if ($item->tour->withCountry)
                                                            <div class="--location">
                                                                <i class="fa-solid fa-location-dot text-warning me-2"></i>
                                                                {{ $item->tour->withCountry->name }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="swiper-navigation">
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    @endif
                    <div class="block-calendar mb-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover w-100" style="white-space: nowrap;">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">@lang('messages.ngay_khoi_hanh')</th>
                                        <th scope="col">@lang('messages.ten_chuong_trinh')</th>
                                        <th scope="col">@lang('messages.canh_diem_noi_bat')</th>
                                        <th scope="col" class="text-center">@lang('messages.don_gia')</th>
                                        <th scope="col" class="text-center">@lang('messages.con_trong')</th>
                                        <th scope="col" class="text-center">@lang('messages.tinh_trang')</th>
                                        <th scope="col" class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['list'] as $item)
                                        <tr>
                                            <th class="text-center">{{ date('d/m/Y', strtotime($item->start)) }}</th>
                                            <td>{{ $item->tour->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td class="text-center">
                                                {{ $item->price ? number_format($item->price) . ' VNĐ' : __('messages.dang_cap_nhat') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->empty ? number_format($item->empty) : '-' }}
                                            </td>
                                            <td
                                                class="text-center {{ $item->status == 'active' ? 'text-success' : 'text-danger' }}">
                                                {{ $item->status == 'active' ? __('messages.dang_nhan_khach') : __('messages.ngung_nhan_khach') }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('tour.detail', ['alias' => $item->tour->slug]) }}"
                                                    class="btn btn-primary" name="button">@lang('messages.chi_tiet')</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="summary-table-calendar">
                            <div class="box-pagination">
                                {!! $data['list']->appends(request()->all())->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection

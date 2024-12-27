@if ($data['events'])
    @php
        $item = $data['events'];
    @endphp
    <div class="widget_item_style_2">
        <div class="">
            <div class="row-grid">
                <a href="{{ route('demo.event.detail', ['slug' => $item->slug]) }}" class="box-img">
                    <img class="w-100 h-100"
                        src="{{ $item->image ? asset($item->image) : asset('/style/images/banner/Rectangle 204.png') }}"
                        alt="Image" srcset="">
                </a>
                <div class="box-content">
                    <div class="content-top">
                        <div class="header-title header-title-style-1">
                            <p class="header-text-top">{{ $item->title }}</p>
                            <p class="header">
                                {{ $item->description }}
                            </p>
                        </div>
                    </div>
                    <div class="count-time">
                        {{-- <div class="des">@lang('messages.home.count_down_des')</div> --}}
                        <div class="clock-wrap">
                            <p class="expired" id="expired"><strong>@lang('messages.home.count_down_expired')</strong></p>
                            <div class="clock" id="clock">
                                <div class="time-block">
                                    <span class="time" id="days">00</span>
                                    <p class="label">@lang('messages.time.day')</p>
                                </div>
                                <div class="time-block">
                                    <span class="time" id="hours">00</span>
                                    <p class="label">@lang('messages.time.hour')</p>
                                </div>
                                <div class="time-block">
                                    <span class="time" id="minutes">00</span>
                                    <p class="label">@lang('messages.time.minute')</p>
                                </div>
                                <div class="time-block">
                                    <span class="time" id="seconds">00</span>
                                    <p class="label">@lang('messages.time.second')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(function() {
                const d = new Date("{{ $item->date ? date('Y/m/d 00:00:00', strtotime($item->date)) : '' }}");
                let time = d.getTime();
                var deadline = time;

                var daysSpan = document.getElementById('days');
                var hoursSpan = document.getElementById('hours');
                var minutesSpan = document.getElementById('minutes');
                var secondsSpan = document.getElementById('seconds');

                if (document.getElementById('expired') !== null) {
                    updateClock(deadline);
                }
                var interval = setInterval(updateClock, 1000);

                function getRemainingTime(deadline) {
                    var total = deadline - new Date().getTime();

                    if (isNaN(total)) {
                        return false;
                    }

                    var seconds = Math.floor((total / 1000) % 60);
                    var minutes = Math.floor((total / 1000 / 60) % 60);
                    var hours = Math.floor((total / (1000 * 60 * 60)) % 24);
                    var days = Math.floor(total / (1000 * 60 * 60 * 24));

                    return {
                        'total': total,
                        'days': days,
                        'hours': hours,
                        'minutes': minutes,
                        'seconds': seconds
                    };
                }

                function updateClock() {
                    var remainingTime = getRemainingTime(deadline);

                    if (remainingTime.total <= 0) {
                        clearInterval(interval);

                        document.getElementById('expired').classList.add('show');

                        return false;
                    } else if (!remainingTime) {
                        return false;
                    }
                    if (document.getElementById('expired') !== null) {
                        daysSpan.innerText = addLeadingZeros(remainingTime.days);
                        hoursSpan.innerText = addLeadingZeros(remainingTime.hours);
                        minutesSpan.innerText = addLeadingZeros(remainingTime.minutes);
                        secondsSpan.innerText = addLeadingZeros(remainingTime.seconds);
                    }
                }

                function addLeadingZeros(time) {
                    return ('0' + time).slice(-2);
                }
            });
        </script>
    @endpush
@endif

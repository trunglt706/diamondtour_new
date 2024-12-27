@extends('user.default')
@section('title', 'Thông tin cá nhân')
@section('content')
    <!-- BEGIN profile -->
    <div class="profile show-img">
        @include('user.pages.user.profile.header')
        <!-- BEGIN profile-container -->
        <div class="profile-container" style="padding: 10px 0px;">
            @include('user.pages.user.profile.sidebar')
            <!-- BEGIN profile-content -->
            <div class="profile-content">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="profile-info">
                        @switch($tab)
                            @case('account')
                                @include('user.pages.user.profile.account')
                            @break

                            @case('history')
                                @include('user.pages.user.profile.history')
                            @break

                            @default
                                @include('user.pages.user.profile.info')
                        @endswitch
                    </div>
                </div>
            </div>
            <!-- END profile-content -->
        </div>
        <!-- END profile-container -->
    </div>
    <!-- END profile -->
@endsection
@push('js')
    {!! NoCaptcha::renderJs() !!}
@endpush

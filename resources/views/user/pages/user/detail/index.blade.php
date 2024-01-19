@php
    use Modules\Admin\app\Models\Admin;
    $status = Admin::get_status($admin->status);
    $hide_email_admin = get_option_admin('hide_email_admin');
    $hide_phone_admin = get_option_admin('hide_phone_admin');
@endphp
@extends('admin::layout.default')
@section('title', 'Thông tin quản trị viên')
@section('content')
    <!-- BEGIN profile -->
    <div class="profile show-img">
        @include('admin::admin.detail.header')
        <!-- BEGIN profile-container -->
        <div class="profile-container" style="padding: 10px 0px;">
            @include('admin::admin.detail.sidebar')
            <!-- BEGIN profile-content -->
            <div class="profile-content">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="profile-info">
                        @switch($tab)
                            @case('account')
                                @include('admin::admin.detail.account')
                            @break

                            @case('history')
                                @include('admin::admin.detail.history')
                            @break

                            @default
                                @include('admin::admin.detail.info')
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
@push('css')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    {!! NoCaptcha::renderJs() !!}
@endpush

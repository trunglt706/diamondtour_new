@extends('guest.layout')
@section('title', '404')
@section('keywords', '')
@section('description', '404')
@section('image', '')
@section('content')
    <style>
        @media (max-width: 932px) {

            .main-content {
                padding-top: 50px !important;
            }

            .page-404 {
                padding: 0px !important;
            }

            .widget_contact_3 {
                min-height: auto !important;
                padding: 0px !important;
            }
        }
    </style>
    <section class="main-content">
        <div class="wrapper home page-404">
            <div class="widget_contact_3" style="min-height: 500px;">
                <div class="box-content">
                    <p class="number">404</p>
                    <div class="content">
                        <p class="title">Page not found</p>
                        <p class="description">It looks like nothing was found at this location. Maybe try a search?</p>
                    </div>
                    <form method="post" class="form email-register-form" action="{{ route('demo.search') }}">
                        <div class="form-group">
                            <div class="input">
                                <input name="search" type="text" placeholder="Search..." class="form-control input-lg"
                                    required="">
                                <input name="action" type="hidden" value="ajax_email_register">
                                <input name="form_key" type="hidden" value="email_register">
                            </div>
                            <div class="button">
                                <button type="submit" class="btn btn-register"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

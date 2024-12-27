@php
    $item = $data['menu'];
@endphp
@extends('guest.layout')
@section('title', get_data_lang($item, 'name'))
@section('keywords', '')
@section('description', $item->description)
@section('image', asset($item->image))
@section('content')
    <style>
        .widget_tour_1 nav {
            justify-content: center;
            display: flex;
        }

        .widget_about_4 .list-item .item {
            margin-bottom: 5px;
        }

        .widget_about_4 .header-title .description {
            max-height: 180px;
            overflow: hidden;
        }

        .widget_about_4 {
            padding: 50px 0;
        }

        .widget_tour_1 {
            padding: 0px;
        }

        @media (max-width: 932px) {

            .main-content {
                padding-top: 30px !important;
            }

            .travel-detail .widget_about_4 .row-flex {
                display: block !important;
            }

            .widget_about_4 .row-flex .box-right {
                margin-top: 8px;
            }

            .widget_about_4 .list-item .item a {
                font-size: 16px !important;
            }

            .header-title-style-3.header-title,
            .widget_about_4 .list-item .item {
                justify-content: center !important;
            }

            .widget_tour_1 .tour-item .title .list-icon-share,
            .widget_tour_1 .tour-item .title .top>a {
                display: none;
            }

            .widget_tour_1 .tour-item .title .top .header-tour-detail a {
                text-transform: uppercase;
            }

            .widget_about_4 .header-title .header {
                text-align: center !important;
            }
        }
    </style>
    <section class="main-content">
        {{-- start tours --}}
        @include('guest.tours.group.tours')
        {{-- end tours --}}

    </section>
@endsection

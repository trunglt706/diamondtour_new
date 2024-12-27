@php
    $description = $locale == 'vi' ? 'description' : 'description_' . $locale;
    $_description = $data['menu']->$description ?? $data['menu']->description;
    $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_name = $data['menu']->$name ?? $data['menu']->name;
@endphp
@extends('index')
@section('content')
    <article class="article-contact-page">
        @include('pages.blocks.breadcrumb', [
            'background' => $data['menu']->background,
            'title' => $_name,
            'description' => $_description,
        ])

        <section>
            <div class="container">
                <div class="box-contact-page mt-1">
                    <div class="block-contact-information">
                        <div class="block-images">
                            <img loading="lazy" src="{{ get_url('assets/images/gallery-group-5.jpg') }}" alt="image"
                                class="img-fluid">
                        </div>
                        <div class="block-article">
                            <div class="-title">
                                {{ $seo['contact-company'] }}
                            </div>
                            <div class="-content">
                                <p>
                                    <i class="fas fa-map-marker-alt"></i> {{ $seo['contact-address'] }}
                                </p>
                                <p><i class="fas fa-phone"></i> {{ $seo['contact-phone'] }}</p>
                                <p><i class="fas fa-envelope"></i> {{ $seo['contact-email'] }}</p>
                                <p><i class="fas fa-exclamation-circle"></i> {{ $seo['contact-more'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="block-contact-map">
                        <div class="ratio ratio-16x9">
                            {!! $seo['google-map'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="box-contact-form justify-content-center">
                    <div class="block-section-header">
                        <h2>@lang('messages.lien_he_voi_chung_toi')</h2>
                    </div>
                    <div class="contact-form-wrap">
                        <div class="-form-images">
                            <img loading="lazy" src="{{ get_url('assets/images/gallery-group-5.jpg') }}" alt="image"
                                class="img-fluid">
                        </div>
                        <div class="-form-content">
                            <form method="POST" action="{{ route('contact.create') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="form_name" class="form-label">@lang('messages.fullname') *</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="@lang('messages.fullname')" required id="form_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="form_email" class="form-label">@lang('messages.email_address') *</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="@lang('messages.email_address')" required id="form_email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="form_phone" class="form-label">@lang('messages.phone')</label>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="@lang('messages.phone')" id="form_phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="form_content" class="form-label">@lang('messages.noi_dung') *</label>
                                    <textarea class="form-control" name="comment" id="form_content" rows="5" placeholder="@lang('messages.vui_long_nhap_noi_dung')" required></textarea>
                                </div>
                                <div class="row align-items-center justify-content-center justify-content-sm-between my-1">
                                    <div class="col-6 col-md-5 col-lg-3">
                                        <button type="submit" class="btn w-100 btn-submit" name="button">
                                            @lang('messages.gui')
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection

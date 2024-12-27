@extends('guest.layout')
@section('title', get_data_lang($data['menu'], 'name'))
@section('keywords', '')
@section('description', get_data_lang($data['menu'], 'description'))
@section('image', asset($data['menu']->background))
@section('style')
    <style>
        .accordion-item p {
            text-align: justify;
        }

        .accordion-button {
            padding-left: 0px !important;
        }

        @media (max-width: 932px) {

            .main-content {
                padding-top: 50px !important;
            }

            .widget_banner.widget_banner_style_3 .box-content .title {
                font-size: 22px !important;
            }
        }
    </style>
@endsection
@section('content')
    <section class="main-content">
        <div class="wrapper home competition">
            {{-- start slider --}}
            @include('guest.faq.sliders')
            {{-- end slider --}}

            <div class="container py-4">
                @foreach ($data['list'] as $item)
                    <div class="section-faq-item">
                        <h2>{{ get_data_lang($item, 'name') }}</h2>
                        <div class="accordion accordion-flush" id="accordionQuestionSection{{ $item->id }}">
                            <div class="row row-cols-1">
                                @foreach ($item->qas as $qa)
                                    <div class="col">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseQuestionSection{{ $item->id }}-{{ $qa->id }}"
                                                    aria-expanded="false"
                                                    aria-controls="flush-collapseQuestionSection{{ $item->id }}-{{ $qa->id }}">
                                                    {{ get_data_lang($qa, 'name') }}
                                                </button>
                                            </h2>
                                            <div id="flush-collapseQuestionSection{{ $item->id }}-{{ $qa->id }}"
                                                class="accordion-collapse collapse"
                                                data-bs-parent="#accordionQuestionSection{{ $item->id }}">
                                                <div class="accordion-body">
                                                    {!! get_data_lang($qa, 'description') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@php
    $description = $locale == 'vi' ? 'description' : 'description_' . $locale;
    $_description = $data['menu']->$description ?? $data['menu']->description;
    $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
    $_name = $data['menu']->$name ?? $data['menu']->name;
@endphp
@extends('index')
@section('content')
    <article>
        @include('pages.blocks.breadcrumb', [
            'background' => $data['menu']->background,
            'title' => $_name,
            'description' => $_description,
        ])
        <section>
            <div class="box-single-faq">
                <div class="container">
                    {{-- <div class="block-section-header">
                        <h2>Những câu hỏi thường gặp​</h2>
                        <p class="text-center"></p>
                    </div> --}}
                    <div class="block-style-accordion faq-question-list">
                        @foreach ($data['list'] as $item)
                            @php
                                $name = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                $_name = $item->$name ?? $item->name;
                            @endphp
                            <div class="section-faq-item">
                                <h2>{{ $_name }}</h2>
                                <div class="accordion accordion-flush" id="accordionQuestionSection{{ $item->id }}">
                                    <div class="row row-cols-1">
                                        @foreach ($item->qas as $qa)
                                            @php
                                                $name_qa = $locale == 'vi' ? 'name' : 'name_' . $locale;
                                                $_name_qa = $qa->$name ?? $qa->name;
                                                $description_qa =
                                                    $locale == 'vi' ? 'description' : 'description_' . $locale;
                                                $_description_qa = $qa->$description_qa ?? $qa->description;
                                            @endphp
                                            <div class="col">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#flush-collapseQuestionSection{{ $item->id }}-{{ $qa->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="flush-collapseQuestionSection{{ $item->id }}-{{ $qa->id }}">
                                                            {{ $_name_qa }}
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseQuestionSection{{ $item->id }}-{{ $qa->id }}"
                                                        class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionQuestionSection{{ $item->id }}">
                                                        <div class="accordion-body">
                                                            {!! $_description_qa !!}
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
            </div>
        </section>
        @include('pages.blocks.newsletter')
    </article>
@endsection

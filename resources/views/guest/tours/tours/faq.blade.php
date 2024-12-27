@if ($data['faq']->count() > 0)
    <div class="widget_question">
        <div class="container">
            <div class="header-title">
                <p class="header text-center mb-4">@lang('messages.faq_thuong_gap')</p>
            </div>
            <div class="accordion row" id="accordionExample">
                @foreach ($data['faq'] as $item)
                    <div class="col-md-6 mb-1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $item->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $item->id }}" aria-expanded="false"
                                    aria-controls="collapse{{ $item->id }}">
                                    {{ get_data_lang($item, 'name') }}
                                </button>
                            </h2>
                            <div id="collapse{{ $item->id }}" class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $item->id }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body p-t-0">
                                    {!! get_data_lang($item, 'description') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

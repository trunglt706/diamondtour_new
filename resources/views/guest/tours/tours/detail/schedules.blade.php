@if ($data['schedules']->count() > 0)
    <div class="col-md-10 col-12">
        <div class="box-content">
            <div class="accordion" id="accordionExample">
                @foreach ($data['schedules'] as $item)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $item->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $item->id }}" aria-expanded="true"
                                aria-controls="collapse{{ $item->id }}">
                                {{ $item->name }} - {!! $item->description !!}
                            </button>
                        </h2>
                        <div id="collapse{{ $item->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $item->id }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @if ($item->image)
                                    <div class="mb-2 text-center">
                                        <a data-fancybox="gallery" data-caption="{{ $item->name }}"
                                            data-src="{{ asset($item->image) }}">
                                            <img src="{{ asset($item->image) }}" alt="">
                                        </a>
                                    </div>
                                @endif
                                @foreach ($item->details as $detail)
                                    {!! $detail->description !!}
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

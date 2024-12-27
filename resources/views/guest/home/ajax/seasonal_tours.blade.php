@foreach ($data['seasonal_tours'] as $item)
    <div class="img hover-opacity-7 pointer">
        <img src="{{ $item->image ? asset($item->image) : '/style/images/banner/Rectangle 206.png' }}" alt="Image"
            srcset="">
        <p class="img-title">
            {{ $item->name }}
        </p>
    </div>
@endforeach

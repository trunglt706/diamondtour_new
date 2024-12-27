<div class="call-to-action">
    @foreach (get_socials() as $item)
        <div class="icon-1">
            <a href="{{ $item->link }}"><img src="{{ asset($item->icon) }}" alt="Image"></a>
        </div>
    @endforeach
</div>
<div class="scroll-to-top">
    <a href="#" onclick="window.scrollTo({top: 0});return false"><i class="fa-solid fa-circle-arrow-up"></i></a>
</div>

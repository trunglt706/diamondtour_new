@if (count($albums) > 0)
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="blog-main">
                @foreach ($albums as $img)
                    <div class="item">
                        <div class="img">
                            <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ get_file($img) }}" alt="Image" loading="lazy">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="list-image-blogs ">
                @foreach ($albums as $img)
                    <div class="item">
                        <div class="img">
                            <img src="{{ asset('style/images/blogs/default.jpg') }}" data-src="{{ get_file($img) }}" alt="Image" loading="lazy">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

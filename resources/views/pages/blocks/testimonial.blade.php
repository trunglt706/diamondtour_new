@if ($data['review']->count() > 0)
    <div class="box-testimonial">
        <div class="swiper testimonial-slider-swiper">
            <div class="swiper-wrapper">
                @foreach ($data['review'] as $item)
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="comment-content">
                                <p>{{ $item->content }}</p>
                            </div>
                            <div class="comment-bio">
                                <div class="profile-image">
                                    <img decoding="async" src="{{ get_url($item->user_avatar) }}" alt="Louna Daniel">
                                </div>
                                <span class="profile-info">
                                    <strong class="profile-name">{{ $item->user_name }}</strong>
                                    <p class="profile-des">{{ $item->name }}</p>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

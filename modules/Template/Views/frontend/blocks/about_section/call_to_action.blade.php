<div class="service-section6 about-cta">
    <div class="container">
        <h2>{!! $title ?? '' !!}</h2>
        {!! $content ?? '' !!}
        @if(!empty($button_text))
            <div class="cta-btn">
                <a class="cta-btn-n" href="{{ !empty($button_link) ? rtrim($button_link, '/') . '/' : '#' }}">{{ $button_text }}</a>
            </div>
        @endif
    </div>
</div>

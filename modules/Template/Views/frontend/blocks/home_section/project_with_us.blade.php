<div class="section10">
    <div class="container">
        <h2>{{ $title }}</h2>
        {!! $content !!}
        <div class="cta-btn">
            <button class="cta-btn-1"><a href="tel:{{ setting_item("phone_no_link") }}">{{ setting_item("phone_no") }}</a></button>
            <button class="cta-btn-2"><a href="{{ $button_link }}">{{ $button_text }}</a></button>
        </div>
    </div>
</div>

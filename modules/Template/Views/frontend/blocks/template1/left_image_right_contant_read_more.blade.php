{{-- Service-page version of the Home page "section5" block: image left, content right,
     with a read more / read less toggle. The Home block's styles live in home-page.css and
     its toggle in script.js collapses every match on the page at once, so this block uses
     its own .service-section5 / .srv5-* hooks (styles in other-page.css, toggle in
     script.js) and each instance opens independently. --}}
@php
    $more_text = !empty($button_text) ? $button_text : __('Mehr lesen');
    $less_text = !empty($button_text_less) ? $button_text_less : __('Weniger lesen');
@endphp

<div class="section service-section5 {{ $class ?? '' }}">
    <div class="container">
        <div class="row">
            @if(!empty($image))
                <div class="col-md-5 col-sm-12 info-5-img">
                    <?php
                        $image_url = get_file_url($image, 'full');
                        $image_details = get_file_details($image);
                    ?>
                    <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
                </div>
            @endif

            <div class="col-md-7 col-sm-12 sec5-info">
                <h2>{!! $title ?? '' !!}</h2>

                <div class="srv5-readmore">
                    {!! $content ?? '' !!}
                </div>

                <a class="srv5-readmore-btn" href="#" data-more="{{ $more_text }}" data-less="{{ $less_text }}">{{ $more_text }} &#10142;</a>
            </div>
        </div>
    </div>
</div>

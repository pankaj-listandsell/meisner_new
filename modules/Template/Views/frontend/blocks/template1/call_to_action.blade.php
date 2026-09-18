@php
    /*
     * Other blocks do rtrim($link,'/').'/' unconditionally, which corrupts the link types
     * this CTA is built for — tel:+49... would become tel:+49.../ and stop dialling. So the
     * trailing slash is only added to internal paths; anything with its own scheme
     * (tel:, mailto:, https://wa.me/...) or a query/fragment is passed through untouched.
     */
    $cta_link = function ($link) {
        $link = trim((string) $link);
        if ($link === '') {
            return '#';
        }
        if (preg_match('~^[a-z][a-z0-9+.\-]*:~i', $link) || strpbrk($link, '?#') !== false) {
            return $link;
        }
        return rtrim($link, '/') . '/';
    };
@endphp

<div class="service-cta-section {{ $class ?? '' }}">
    <div class="container">
        @if(!empty($title))
            <h2>{!! $title !!}</h2>
        @endif

        @if(!empty($content))
            <div class="service-cta-text">{!! $content !!}</div>
        @endif

        @if(!empty($button_text) || !empty($second_button_text))
            <div class="service-cta-buttons">
                @if(!empty($button_text))
                    <a class="cta-btn-n" href="{{ $cta_link($button_link ?? '') }}">{{ $button_text }}</a>
                @endif

                @if(!empty($second_button_text))
                    <a class="cta-btn-n cta-btn-outline" href="{{ $cta_link($second_button_link ?? '') }}">{{ $second_button_text }}</a>
                @endif
            </div>
        @endif
    </div>
</div>

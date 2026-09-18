@php
    $has_first  = !empty($first_content);
    $has_second = !empty($second_content);
    // A single filled column spans the row rather than leaving half the section empty.
    $col_class  = ($has_first && $has_second)
        ? 'col-lg-6 col-md-6 col-sm-12'
        : 'col-lg-12 col-md-12 col-sm-12';

    // Read more is opt-in: filling in the label turns it on. The collapsing element wraps the
    // whole .row, so one button clamps and expands both columns together.
    $read_more = !empty($button_text);
    $less_text = !empty($button_text_less) ? $button_text_less : __('Weniger lesen');
@endphp

<div class="section service-two-column {{ $class ?? '' }}">
    <div class="container">
        @if(!empty($title))
            <h2>{!! $title !!}</h2>
        @endif

        @if(!empty($content))
            <div class="two-column-intro">{!! $content !!}</div>
        @endif

        <div class="{{ $read_more ? 'twocol-readmore' : '' }}">
            <div class="row">
                @if($has_first)
                    <div class="{{ $col_class }} two-column-item">
                        {!! $first_content !!}
                    </div>
                @endif

                @if($has_second)
                    <div class="{{ $col_class }} two-column-item">
                        {!! $second_content !!}
                    </div>
                @endif
            </div>
        </div>

        @if($read_more)
            <a class="twocol-readmore-btn" href="#" data-more="{{ $button_text }}" data-less="{{ $less_text }}">{{ $button_text }} &#10142;</a>
        @endif
    </div>
</div>

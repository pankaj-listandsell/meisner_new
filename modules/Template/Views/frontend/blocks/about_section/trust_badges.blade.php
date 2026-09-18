{{-- Renders inside the Our Story block's still-open .location-section2 > .container
     wrapper and closes it, so the badges share that section's grey background.
     Place this block directly after Our Story. --}}

@if(!empty($title) || !empty($content))
    <div class="row about-badges-intro">
        <div class="col-lg-12 col-md-12 col-sm-12">
            @if(!empty($title))
                <h2>{!! $title !!}</h2>
            @endif
            {!! $content ?? '' !!}
        </div>
    </div>
@endif

@if (!empty($list_item))
    <div class="row sec6-2">
        @foreach ($list_item as $item)
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="l-count-box">
                    <h4>{{ $item['title'] ?? '' }}</h4>
                    <p>@if(!empty($item['strong_text']))<strong>{{ $item['strong_text'] }}</strong> @endif{{ $item['sub_title'] ?? '' }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endif
</div>
</div>

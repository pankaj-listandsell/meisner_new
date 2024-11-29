<div class="section5 section">
    <div class="container">
        <div class="row">
            @if(isset($image))
            <div class="col-md-5 info-5-img col-sm-12">
                <?php
                $image_url = get_file_url($image, 'full');
                $image_details = get_file_details($image, '#');
               ?>
              <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
            </div>
            @endif
            <div class="col-md-7 col-sm-12 sec5-info">
                <h2>{!! $title !!}</h2>
                <div class="sec5_readmore">
                    {!! $content !!}
                </div>
                <a class="sec5_read_more_btn" href="{{ $button_link }}">{{ $button_text }} &#10142;</a>
            </div>
        </div>

    </div>

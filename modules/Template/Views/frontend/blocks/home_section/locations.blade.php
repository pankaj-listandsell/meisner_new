<div class="section6 section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <span class="top-text">{!! $main_title !!}</span>
                <h2>{!! $title !!}</h2>
                {!! $content !!}
                <a href="{{ $button_link }}"><button>{{ $button_text }}</button></a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 sec6-img">
                <?php
                   $image_url = get_file_url($image, 'full');
                  $image_details = get_file_details($image, '#');
                ?>
                <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">

                <div class="dot-4">
                    <div class="pulse">

                    </div>
                </div>
            </div>
        </div>


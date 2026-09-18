<div class="location-section2 about-story {{ $class ?? '' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>{!! $title ?? '' !!}</h2>
                {!! $content ?? '' !!}
            </div>

            @if(!empty($bg_image))
                <div class="col-lg-6 col-md-6 col-sm-12 sec6-img2">
                    <?php
                        $image_url = get_file_url($bg_image, 'full');
                        $image_details = get_file_details($bg_image);
                    ?>
                    <img
                        class="lazyload"
                        title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}"
                        alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}"
                        data-src="{{ $image_url }}"
                    >
                </div>
            @endif
        </div>
{{-- .container and .location-section2 are left open on purpose: the Trust Badges block
     closes them, so the badge row sits inside this section's grey background and picks up
     the `.location-section2 .l-count-box` styling. Same pairing as the City page blocks.
     Always place Trust Badges directly after this block. --}}

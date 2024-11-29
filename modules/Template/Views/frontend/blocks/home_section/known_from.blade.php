<div class="section top-h-slider">
    <div class="row">
        <div class="col-lg-1">
            <p>{!! $title !!}</p>
        </div>
        @if(isset($list_company_images) && !empty($list_company_images))
        <div class="col-lg-11">
            <div class="slideshow slider-top">
                @foreach($list_company_images as $image)
                <?php
                    $image_url = get_file_url($image['image'], 'full');
                    $image_details = get_file_details($image['image'], '#');
                    ?>
                    <div class="slide">
                        <span><img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}"></span>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

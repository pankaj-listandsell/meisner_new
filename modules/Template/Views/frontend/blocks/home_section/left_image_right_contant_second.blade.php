<div class="section12">
    <div class="row">
        @if(isset($image))
        <div class="col-lg-7 col-md-7 col-sm-12 sec-12-img">
            <?php
                $image_url = get_file_url($image, 'full');
                $image_details = get_file_details($image, '#');
            ?>
            <img class="lazyload title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
        </div>
        @endif
        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="text-box">
                <h2>{!! $title !!}</h2>
                <div class="g_text_box">{!! $content !!} </div>
            </div>
        </div>
    </div>
</div>

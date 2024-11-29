<div class="container-2">
    <div class="row sec5-info-2">
        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="info-box-5">
                <h2>{!! $title !!}</h2>
                <div class="sec5-info_readmore">
                    {!! $content !!}
                </div>
                <!-- <a class="sec5-info_read_more_btn" href="#">Mehr lesen ➞</a> -->
            </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-12">
            <div class="row sec5-img">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php
                        $image_url = get_file_url($first_image, 'full');
                        $image_details = get_file_details($first_image, '#');
                    ?>
                    <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">

                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php
                        $image_url = get_file_url($second_image, 'full');
                        $image_details = get_file_details($second_image, '#');
                    ?>
                    <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<div class="section section9 testimonial-box sr-bx-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-12">
                <span class="top-text">{{ $main_title }}</span>
                <h2>{{ $title }}</h2>
            </div>
            <div class="col-lg-5  testm-btn">
                <div class="testmoial-box">

                </div>
            </div>
        </div>
        @if(!empty($list_testimonials))
        <div class="slideshow slider-2">

            @foreach($list_testimonials as $testimonial)
            <div class="slide">
                <div class="testimonial-info">
                    <?php
                        $image_url = get_file_url($testimonial['rating_image'], 'full');
                        $image_details = get_file_details($testimonial['rating_image'], '#');
                    ?>
                    <img class="lazyload rating-img" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
                    {!! $testimonial['content'] !!}
                    <div class="row">
                        <div class="tet-1">
                            <?php
                                $image_url = get_file_url($testimonial['image'], 'full');
                                $image_details = get_file_details($testimonial['image'], '#');
                            ?>
                            <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
                        </div>
                        <div class="tet-2">
                            <h4>{{ $testimonial['user_name'] }}</h4>
                            <p>{{ $testimonial['user_designation'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        @endif
    </div>
</div>

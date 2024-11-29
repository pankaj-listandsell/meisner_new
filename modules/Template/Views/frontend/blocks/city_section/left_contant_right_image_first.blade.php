<div class="location-section2 {{$class??''}}">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <h2>{!! $title !!}</h2>
            {!! $content !!}

        </div>
        @if(isset($bg_image))
        <div class="col-lg-6 col-md-6 col-sm-12 sec6-img2">
            <?php
                $image_url = get_file_url($bg_image, 'full');
                $image_details = get_file_details($bg_image, '#');
            ?>
            <img title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" src="{{ $image_url }}">
        </div>
        @endif
      </div>

<div class="leistungen-section5 section">
    <h2>{!! $title !!}</h2>
    <p>{!! $content !!} </p>
    @if(!empty($list_carousel))
    <div class="container">
      <div class="row">
        @foreach($list_carousel as $item)
        <div class="col-lg-4 col-sm-12"><a href="#">
            <div class="service-info s-info-1">
                <?php
                    $image_url = get_file_url($item['image'], 'full');
                    $image_details = get_file_details($item['image'], '#');
                ?>
              <img title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" src="{{$image_url}}">

              <h4>{{ $item['title'] }}</h4>
              <p>{{ $item['desc'] }} </p>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>

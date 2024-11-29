<div class="leistungen-section2" id="unsere-leistungen">
    <div class="container">
      <span class="top-text">{{ $main_title }}</span>
      <h2>{{ $title }}</h2>
      @if(!empty($list_services))
      <div class="row s2-r">
        @foreach($list_services as $service)

        <div class="col-lg-3 col-md-4 col-sm-6">
          <a href="{{ $service['link'] }}">
            <div class="leistungen-box">
                 <?php
                    $image_url = get_file_url($service['image'], 'full');
                    $image_details = get_file_details($service['image'], '#');
                ?>
              <img title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" src="{{$image_url}}">
              <h4>{{ $service['title'] }}</h4>
              <p>{{ $service['content'] }} </p>
            </div>
          </a>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </div>

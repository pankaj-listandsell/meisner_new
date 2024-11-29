@if($list_carousel)
<div class="section service-info-box sr-bx-1">
    <div class="container">
      <h2>{{ $title }}</h2>
      @if($top_content != null)
        <p>{{$top_content ?? ''}}</p>
      @endif
      <div class="slideshow service-slider">
        @foreach($list_carousel as $k=>$carousel)
        <a href="#">
          <div class="slide">
            <div class="service-info s-info-1">
                <?php $image_url = get_file_url($carousel['bg_image'], 'full');
                   $image_details = get_file_details($carousel['bg_image'], '#');
                ?>
              <img title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" src="{{ $image_url }}">
              <h4>{{$carousel['title'] ?? ''}}</h4>

              <p>{{$carousel['desc'] ?? ''}}
              </p>
            </div>
          </div>
        </a>
        @endforeach
      </div>
      @if($bottom_content != null)
        <p>{{$bottom_content ?? ''}}</p>
      @endif
    </div>
  </div>
  @endif

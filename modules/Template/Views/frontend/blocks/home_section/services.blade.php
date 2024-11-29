<div class="section3 section">
    <div class="container">
        <span class="top-text">{{ $main_title }}</span>
        <h2>{{ $title }}</h2>
        <div class="row">
            @if(!empty($list_services))
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="service-box-section">
                    <div class="row">
                        @foreach($list_services as $service)
                        <div class="col-lg-6 col-md-6 col-sm-12 service-section">
                            <div class="service-img">
                                <?php
                                    $image_url = get_file_url($service['image'], 'full');
                                ?>
                                <a href="{{ $service['link'] }}" class="lazyload service-box1" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 28.93%, rgba(0, 0, 0, 0.655002) 70.93%, rgba(0, 0, 0, 0.82) 100%), url({{$image_url}});">
                                    <p> {{ $service['title'] }}</p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-5 col-md-5  col-sm-12 service-content">
                <p>{{ $content_title }}</p>
                {!! $content !!}
                <a href="{{ $button_link }}"><button class="home-service-btn">{{ $button_text }}</button></a>
            </div>
        </div>
    </div>
</div>

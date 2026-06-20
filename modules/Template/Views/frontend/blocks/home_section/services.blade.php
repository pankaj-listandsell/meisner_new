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
                                <a href="{{ rtrim($service['link'], '/') . '/' }}" class="service-box1" style="position: relative; background: none;" title="{{ $service['title'] }}">
                                    <img alt="{{ $service['title'] }}" title="{{ $service['title'] }}" class="service-box1-img lazyload" data-src="{{ $image_url }}" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                    <span aria-hidden="true" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0, 0, 0, 0) 28.93%, rgba(0, 0, 0, 0.655002) 70.93%, rgba(0, 0, 0, 0.82) 100%); border-radius: 10px; pointer-events: none; z-index: 1;"></span>
                                    <p style="position: relative; z-index: 2;"> {{ $service['title'] }}</p>
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
                <a href="{{ rtrim($button_link, '/') . '/' }}"><button class="home-service-btn">{{ $button_text }}</button></a>
            </div>
        </div>
    </div>
</div>

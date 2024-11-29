
<div class="section11 section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 p-right">
                <h2>{{ $title }} </h2>
                {!! $content !!}
                @if(!empty($list_services))
                <div class="row">
                    @foreach($list_services as $service)
                    <div class="col-lg-4 col-md-4 col-sm-4 sec-11-box">
                        <div class="sec-11-icon-box">
                            <?php
                                $image_url = get_file_url($service['image'], 'full');
                                $image_details = get_file_details($service['image'], '#');
                            ?>
                            <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
                            <h4>{!! $service['title'] !!}</h4>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 sec-11-img">
                <?php
                $image_url = get_file_url($image, 'full');
                $image_details = get_file_details($image, '#');
            ?>
            <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
            </div>
        </div>
    </div>
</div>

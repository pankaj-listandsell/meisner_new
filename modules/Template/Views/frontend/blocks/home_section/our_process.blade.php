<div class="section section7">
    <div class="container">
        <span class="top-text">{!! $main_title !!}</span>
        <h2>{!! $title !!}</h2>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 ">
                <!--<img alt="#" title="#" src="/assests/img/our-process.webp">-->
                <div class="sec-7-img">
                    <video class="lazyload" autoplay muted loop playsinline width="675" height="587">
                    <source src="{{$video_url}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            @if(!empty($list_item))
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row sec7-info">
                    @foreach($list_item as $item)
                    <div class="col-lg-3 col-md-2 col-sm-12 lines_col_img">
                        <div class="sec7-img sec7-line1">
                            <?php
                                $image_url = get_file_url($item['icon'], 'full');
                                $image_details = get_file_details($item['icon'], '#');
                            ?>
                            <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-10 col-sm-12">
                        <h4>{{ $item['title'] }}</h4>
                        <p>{{ $item['content'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

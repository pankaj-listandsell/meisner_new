<div class="section service-info-box about-why-choose">
    <div class="container">
        <h2>{!! $title ?? '' !!}</h2>
        @if(!empty($content))
            <p>{{ $content }}</p>
        @endif

        @if(!empty($list_item))
            <div class="row">
                @foreach($list_item as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="service-info">
                            @if(!empty($item['icon']))
                                <?php
                                    $image_url = get_file_url($item['icon'], 'full');
                                    $image_details = get_file_details($item['icon']);
                                ?>
                                <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
                            @endif
                            <h3>{{ $item['title'] ?? '' }}</h3>
                            <p>{{ $item['content'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

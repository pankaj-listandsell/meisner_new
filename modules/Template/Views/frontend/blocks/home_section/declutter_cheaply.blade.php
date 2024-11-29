<div class="section8 section">
    <div class="container">
        <h2>{{ $title }}</h2>
        <p>{!! $content !!}</p>
        @if(!empty($list_item))
        <div class="row">
            @foreach($list_item as $item)
            <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="sec-8-box1">
                        <?php $image_url = get_file_url($item['icon'], 'full');
                            $image_details = get_file_details($item['icon'], '#');
                        ?>
                        <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
                        <p>{!! $item['title'] !!}</p>
                    </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

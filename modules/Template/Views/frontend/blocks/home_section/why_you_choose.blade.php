<?php
    $image_url = get_file_url($bg_image, 'full');
?>
<div class="section4 section lazyload" data-bd="{{ $image_url }}">
    <div class="container">
        <span class="w-text">{!! $main_title !!}</span>
        <h2>{!! $title !!}</span></h2>
        {!! $content !!}

        @if(!empty($list_item))
        <div class="row three_section_box">
            @foreach($list_item as $item)
            <div class="col-md-4 col-sm-12">
                    <div class="service-section">
                        <div class="service-icon-box">
                            <?php
                                $image_url = get_file_url($item['icon'], 'full');
                                $image_details = get_file_details($item['icon'], '#');
                            ?>
                    <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
                            <h3>{!! $item['title'] !!}</h3>
                        </div>
                        <p>{!! $item['content'] !!}</p>
                    </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
</div>

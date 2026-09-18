{{-- Mirrors the Home page "Our Process" layout (image left, numbered steps right),
     using an image instead of the video. The section7 styles live in home-page.css, which
     this page does not load, so about-process-scoped copies sit in other-page.css. --}}
<div class="section about-process">
    <div class="container">
        @if(!empty($main_title))
            <span class="top-text">{!! $main_title !!}</span>
        @endif

        <h2>{!! $title ?? '' !!}</h2>

        @if(!empty($content))
            <p class="about-process-intro">{{ $content }}</p>
        @endif

        <div class="row">
            @if(!empty($bg_image))
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="sec-7-img">
                        <?php
                            $image_url = get_file_url($bg_image, 'full');
                            $image_details = get_file_details($bg_image);
                        ?>
                        <img class="lazyload" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" data-src="{{ $image_url }}">
                    </div>
                </div>
            @endif

            @if(!empty($list_item))
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row sec7-info">
                        @foreach($list_item as $k => $item)
                            <div class="col-lg-3 col-md-2 col-sm-12 lines_col_img @if($loop->last) lines_col_last @endif">
                                <div class="sec7-img sec7-line1">
                                    @if(!empty($item['icon']))
                                        <?php
                                            $icon_url = get_file_url($item['icon'], 'full');
                                            $icon_details = get_file_details($item['icon']);
                                        ?>
                                        <img class="lazyload" title="{{ isset($icon_details['title']) ? $icon_details['title'] : "#" }}" alt="{{ isset($icon_details['alt']) ? $icon_details['alt'] : "#" }}" data-src="{{ $icon_url }}">
                                    @else
                                        <span class="about-step-num">{{ $k + 1 }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-10 col-sm-12">
                                <h3>{{ $item['title'] ?? '' }}</h3>
                                <p>{{ $item['content'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

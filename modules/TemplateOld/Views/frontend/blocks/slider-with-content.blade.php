<div class="bravo-form-search-all banner-slider @if(!empty($class)){{ $class }}@endif @if($style == '')normal @endif {{$style}} @if(!empty($style) and $style == "carousel") bravo-form-search-slider @endif" @if(empty($style)) style="background-image: linear-gradient(0deg,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('{{$bg_image_url}}') !important" @endif>
    @if(isset($title))
        <h1 class="text-heading">{{$title}}</h1>
    @endif
    @if(isset($sub_title))
        <div class="sub-heading">{{$sub_title}}</div>
    @endif
    @if(in_array($style,['carousel','']))
        @if(!empty($style) and $style == "carousel" and !empty($list_slider))
            <div class="effect">
                <div class="owl-carousel">
                    @foreach($list_slider as $item)
                        @php $img = get_file_url($item['bg_image'],'full') @endphp
                        <div class="item">
                            <div class="item-bg" style="background-image: linear-gradient(0deg,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('{{$img}}') !important"></div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sub-text">{{ $item['sub'] ?? '' }}</div>
                        <h1 class="text-heading text-center">{{ $item['title'] ?? "" }}</h1>
                        <h2 class="sub-heading text-center">{{ $item['desc'] ?? "" }}</h2>
                    </div>
                </div>
            </div>
        @endif
    @endif
    @if($style == "carousel_v2")
            <div class="owl-carousel @if(isHomePage()) home-p-carousel @endif">
                @foreach($list_slider as $item)
                        <?php

                            $imageSizes = $item['list_images'] ?? [];
                            $imageIds = array_unique(array_merge(array_map(function ($imageSize) {
                                return $imageSize['bg_image'];
                            }, $imageSizes), [$item['bg_image']]));
                            $imageUrls = getImagesUrlByIds($imageIds);

                        //$img = get_file_url($item['bg_image'],'full');
                        //style="background-image: linear-gradient(0deg,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('{{$img}}') !important; height: 400px;"
                        ?>
                    <div class="item {{ $item['class_name'] ?? '' }}">
                        <div class="c-slider-img">
                            <picture>
                                @foreach($imageSizes as $imageSize)
                                    @if(in_array($imageSize['bg_image'], array_keys($imageUrls)))
                                        <source width="{{ $imageSize['viewport'] }}" height="100%" media="(min-width:{{ $imageSize['viewport'] }}px)" srcset="{{ $imageUrls[$imageSize['bg_image']] }}"/>
                                    @endif
                                @endforeach
                                <img class="owl-lazy" data-src="{{ $imageUrls[$item['bg_image']] }}" alt="{{ $item['title'] }}" width="{{ $imageSize['viewport'] }}" height="100%"/>
                            </picture>
                        </div>
                        <div class="c-slider-desc">
                            <div class="sub-text"><span>{{ $item['sub'] ?? '' }}</span></div>
                            <h1 class="text-heading text-center">{!! $item['title'] ?? "" !!}</h1>
                            <h2 class="sub-heading text-center">{{ $item['desc'] ?? "" }}</h2>
                        </div>
                    </div>
                @endforeach
            </div>
    @endif
</div>

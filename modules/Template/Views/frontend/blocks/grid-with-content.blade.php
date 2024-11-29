<div class='container grid-content'>
    <div class="row {{$class ?? ''}}">
        @foreach($grid_content as $index=>$item)
            <div class="{{ $item['class'] ?? '' }}">
                {{-- {!! clean($item['content'] ?? '') !!} --}}

                @if(isset($item['show_vimeo_video']) && $item['show_vimeo_video'] && isset($item['vimeo_video']) && $item['vimeo_video'] != '')
                    <div class="embed-container" id="vimeo-video-{{ $index }}" data-id="{{ $item['vimeo_video'] }}"></div>
                @endif

                {!! $item['content'] ?? '' !!}

                @if(!empty($item['elephantSlider']))
                    <div class="elephant-carousel">
                        <div class="owl-carousel">
                            {!! setting_item_with_lang("elephant_slider", get_default_lang()) !!}
                        </div>
                    </div>
                @endif

                @if(!empty($item['mapElement']))
                    {!! setting_item_with_lang("map") !!}
                @endif

                @if(!empty($item['addressElement']))
                    <h5 class="heading">{{ __('Address') }}</h5>
                    <div class="address-wrapper">
                        {!! setting_item_with_lang("address") !!}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>



@once
    @push('carousel-scripts')
        <script type="text/javascript">

            @foreach($grid_content as $index=>$item)
                @if(isset($item['show_vimeo_video']) && $item['show_vimeo_video'] && isset($item['vimeo_video']) && $item['vimeo_video'] != '')
                    document.addEventListener("DOMContentLoaded", function(){
                        var vimeo_wrapper_{{ $index }} = document.getElementById('vimeo-video-{{ $index }}');
                        var vimeo_video_id_{{ $index }} = vimeo_wrapper_{{ $index }}.getAttribute('data-id');
                        var iframe_{{ $index }} = document.createElement('iframe');
                        iframe_{{ $index }}.setAttribute('src', 'https://player.vimeo.com/video/'+vimeo_video_id_{{ $index }}+'?badge=0&amp;autopause=0');
                        iframe_{{ $index }}.setAttribute('width', '100%');
                        //iframe_{{ $index }}.setAttribute('height', '450');
                        iframe_{{ $index }}.setAttribute('allowfullscreen', 'allowfullscreen');
                        iframe_{{ $index }}.setAttribute('frameborder', '0');
                        vimeo_wrapper_{{ $index }}.appendChild(iframe_{{ $index }});
                    });
                @endif
            @endforeach

            $(document).ready(function () {
                $(".elephant-carousel").each(function () {
                    $(this).find(".owl-carousel").owlCarousel({
                        items: 1,
                        loop: true,
                        margin: 0,
                        nav: true,
                        dots: true,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: false,
                    })
                });
            });
        </script>
    @endpush
@endonce

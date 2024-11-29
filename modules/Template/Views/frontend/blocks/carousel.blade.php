@if($list_carousel)
    <div class="bravo-carousel">
        <div class="container">
            <div class="row">
                {{-- {!! dd($list_carousel) !!} --}}
                @foreach($list_carousel as $k=>$carousel)
                    {{-- @if ($k == 2) --}}
                    {{-- {!! dd($carousel) !!} --}}
                    {{-- @endif --}}
                    <div class="carousel-wrapper {{$carousel['class'] ?? ''}}">
                        <h3 class="title">{{$carousel['title'] ?? ''}}</h3>
                        <div class="owl-carousel">
                            {{-- @if($carousel['carousel_item']) --}}
                            {{-- @foreach($carousel['carousel_item'] as $item) --}}
                                <?php $image_url = get_file_url($carousel['bg_image'], 'full') ?>
                            <div><img src="{{ $image_url }}"/></div>
                            {{-- @endforeach --}}
                            {{-- @endif --}}
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- <div class="row">
                {!! dd($list_carousel) !!}
                @foreach($list_carousel as $k=>$carousel)
                    @if ($k == 2)
                        {!! dd($carousel) !!}
                    @endif
                    <div class="carousel-wrapper {{$carousel['class'] ?? ''}}">
                        <h3 class="title">{{$carousel['title'] ?? ''}}</h3>
                        <div class="owl-carousel">
                            @if($carousel['carousel_item'])
                                @foreach($carousel['carousel_item'] as $item)
                                    <?php #$image_url = get_file_url($item['bg_image'], 'full') ?>
                                    <div><img src="{{ $image_url }}" /></div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div> --}}
        </div>
    </div>
@endif

@once
    @push('carousel-scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                $(".bravo-carousel").each(function () {
                    $(this).find(".owl-carousel").owlCarousel({
                        items: 1,
                        loop: true,
                        margin: 0,
                        nav: true,
                        dots: false,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: false,
                    })
                });
            });
        </script>
    @endpush
@endonce

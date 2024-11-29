<div class="bravo-carousel-grid">
<div class="container">
    {{-- {{dd($grid_content)}} --}}
    @if($grid_content)
        @foreach($grid_content as $item)
        {{-- {{dd($item)}} --}}
            <?php $carousel_class = $item['class']; ?>
            <div class="row {{ $class ?? '' }} @if(isset( $item['hide_title'])){{ $item['hide_title'] ? 'hide-title' : '' }}@endif">
                @foreach($item['carousel_ids'] as $carousel_id)
                    {{-- {{dd($rows)}} --}}
                    @foreach($rows as $row)
                    {{-- {{dd($row)}} --}}
                        @if($carousel_id == $row->id)
                            <div class="carousel-wrapper {{$carousel_class ?? ''}}">
                                <h3 class="title">{{$row->title ?? ''}}</h3>
                                <div class="owl-carousel">
                                    @if($row->getGallery())
                                        @foreach($row->getGallery() as $key=>$item)
                                            <div><img src="{{ $item['large'] }}" /></div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        @endforeach
    @endif
</div>
</div>

@once
    @push('carousel-scripts')

    <script type="text/javascript">
        $(document).ready(function(){
            $(".bravo-carousel-grid").each(function () {
                $(this).find(".owl-carousel").owlCarousel({
                    items: 1,
                    loop: true,
                    margin: 0,
                    nav: true,
                    dots: false,
                    autoplay:true,
                    autoplaySpeed:1500,
                    autoplayTimeout:5000,
                    autoplayHoverPause:false,
                });
            });
        });
    </script>
    @endpush
@endonce

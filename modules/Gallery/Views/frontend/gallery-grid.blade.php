<div class="bravo-gallery-grid">
    <div class="container">
        {{-- {{dd($grid_content)}} --}}
        @if($grid_content)
            @foreach($grid_content as $item)
            {{-- {{dd($item)}} --}}
                <?php $gallery_class = $item['class']; ?>
                <div class="row {{ $class ?? '' }} @if(isset( $item['hide_title'])){{ $item['hide_title'] ? 'hide-title' : '' }}@endif">
                    {{-- {{dd($item['gallery_ids'])}} --}}
                    @if($item['gallery_ids'])
                        @foreach($item['gallery_ids'] as $gallery_id)
                            {{-- {{dd($rows)}} --}}
                            @foreach($rows as $row)
                            {{-- {{dd($row)}} --}}
                                @if($gallery_id == $row->id)
                                    <div class="gallery-wrapper">
                                        <h3 class="title">{{$row->title ?? ''}}</h3>
                                        {{-- <div class="owl-carousel"> --}}
                                            @if($row->getGallery())
                                                @foreach($row->getGallery() as $key=>$item)
                                                    <div class="{{$gallery_class ?? ''}}">
                                                        <img width="100%" src="{{ $item['large'] }}" />
                                                    </div>
                                                @endforeach
                                            @endif
                                        {{-- </div> --}}
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                </div>
            @endforeach
        @endif
    </div>
    </div>
    
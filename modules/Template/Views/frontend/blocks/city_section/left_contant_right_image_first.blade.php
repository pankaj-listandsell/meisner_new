@php
    $isStandorteMap = isset($class) && str_contains($class, 'standorte-map-sec');
@endphp

<div class="location-section2 test {{ $class ?? '' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">

                @if($isStandorteMap)
                    <h1>{!! $title !!}</h1>
                @else
                    <h2>{!! $title !!}</h2>
                @endif

                {!! $content !!}

            </div>

            @if(isset($bg_image))
                <div class="col-lg-6 col-md-6 col-sm-12 sec6-img2">
                    <?php
                        $image_url = get_file_url($bg_image, 'full');
                        $image_details = get_file_details($bg_image, '#');
                    ?>
                    <img
                        title="{{ $image_details['title'] ?? '#' }}"
                        alt="{{ $image_details['alt'] ?? '#' }}"
                        src="{{ $image_url }}"
                    >
                </div>
            @endif
        </div>
    </div>
</div>
<div class="section service-section1 {{$class??''}}">
    <div class="container">
         <div class="row">
            @if(isset($bg_image))
               <div class="col-lg-6 col-md-6 col-sm-12">
                <?php $image_url = get_file_url($bg_image, 'full');
                 $image_details = get_file_details($bg_image, '#'); ?>
                  <img title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" class="border-r" src="{{ $image_url }}">
               </div>
            @endif
               <div class="col-lg-6 col-md-6 col-sm-12 mt-b">
                  <h2>{{ $title }}</h2>
                  {!! $content !!}
                </div>
         </div>
    </div>
</div>

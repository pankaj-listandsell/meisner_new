<div class="section service-section1">
    <div class="container">
         <div class="row">
            
               <div class="col-lg-6 col-md-6 col-sm-12">
               @if(isset($bg_image) && $bg_image != '')
                <?php $image_url = get_file_url($bg_image, 'full');
                 $image_details = get_file_details($bg_image, '#'); ?>
                  <img title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" class="border-r" src="{{ $image_url }}">
               @else
                  <video src="{{ $videolink }}" autoplay="" muted="" loop=""></video>
               @endif
                  
               </div>
            
               <div class="col-lg-6 col-md-6 col-sm-12 mt-b">
                  <h2>{{ $title }}</h2>
                  {!! $content !!}
                </div>
         </div>
    </div>
</div>

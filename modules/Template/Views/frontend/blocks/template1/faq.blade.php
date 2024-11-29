<div class="section service-section8">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8  col-sm-12 sc-8-1">
          <h2>{{$title ?? ''}}</h2>
          @if(!empty($list_item))
          <main>
            <div class="accordion">

            @foreach($list_item as $item)
              <div class="accordion-item ">
                <div class="accordion-item-header">
                  <span class="accordion-item-header-title">{{$item['title']}}</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down accordion-item-header-icon">
                    <path d="m6 9 6 6 6-6" />
                  </svg>
                </div>
                <div class="accordion-item-description-wrapper">
                  <div class="accordion-item-description">
                    <hr>
                    {!! clean($item['sub_title'],'html5-definitions') !!} 
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </main>
          @endif
          <div class="form-cta-btn">
            <a href="{{$button_link ?? '#'}}" class="cta-btn-n">{{ $button_text }}</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 faq-img">
            <?php
                $image_url = get_file_url($image, 'full');
                $image_details = get_file_details($image, '#');
            ?>
          <img title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" class="lazyload border-r" data-src="{{ $image_url }}">
        </div>
      </div>
    </div>
  </div>

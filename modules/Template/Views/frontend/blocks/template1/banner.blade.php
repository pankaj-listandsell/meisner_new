<?php $image_url = get_file_url($bg_image, 'full') ?>
<div class="service-img-div" style="background-image: url('{{ $image_url }}'); ">
    <div class="service-banner" >
        <div class="container">
               <div class="row">
                <div class="col-lg-7 col-md-8 col-sm-12">
               <h1>{{ $title }}</h1>
               {!! $content !!}
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-12"><a href="{{ $button_link }}" class="banner-btn" >{{ $button_text }}</a></div>
                <div class="col-lg-6 col-md-7 col-sm-12">
                  <div class="banner-cta">
                      <a href="tel:{{ setting_item("phone_no_link") }}"><img title="{{ setting_item("phone_no") }}" alt="{{ setting_item("phone_no") }}" src="/assests/img/icons/green-telephone.svg"> {{ setting_item("phone_no") }}</a>
                  </div>
                </div>
            </div>
            </div>
              </div>
            </div>
        </div>
    </div>
</div>


<div class="service-section6">
    <div class="container">
      <h2>{{ setting_item("request_service_title") }}</h2>
      {!! setting_item("request_service_desc")  !!}
      <div class="cta-btn">
         @if(setting_item("request_service_button_text") != "")
        <a class="cta-btn-n" href="{{setting_item("request_service_button_link") ?? '#'}}">{{ setting_item("request_service_button_text") }}</a>
        @else
        <a class="cta-btn-n" href="{{setting_item("request_service_second_button_link") ?? '#'}}">{{ setting_item("request_service_second_button_text") }}</a>
        @endif
      </div>
    </div>
  </div>

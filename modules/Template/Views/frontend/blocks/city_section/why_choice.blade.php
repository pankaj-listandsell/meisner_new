<div class="section service-sec-8">
    <div class="container">
      <h2>{{ $title }}</h2>
      {!! $content !!}
      <div class="call-cta-btn">
        <a href="tel:{{ setting_item("phone_no_link") }}" alt="{{ setting_item("phone_no") }}"><img src="{{asset('assests/img/icons/green-telephone.svg') }}"> {{ setting_item("phone_no") }}</a>
      </div>
    </div>
  </div>

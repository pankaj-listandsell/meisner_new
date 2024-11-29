<div class="section service-sec-8">
    <div class="container">
      <div class="last_rm">
        <h2>{{ $title }}</h2>
        {!! $content !!}
      </div>
      <div class="ls_rm_btn">
        <a href="#">Mehr lesen 🠚</a>
      </div>
      <div class="call-cta-btn">
        <a href="tel:{{ setting_item("phone_no_link") }}" alt="{{ setting_item("phone_no") }}"><img src="{{asset('assests/img/icons/green-telephone.svg') }}"> {{ setting_item("phone_no") }}</a>
      </div>
    </div>
  </div>

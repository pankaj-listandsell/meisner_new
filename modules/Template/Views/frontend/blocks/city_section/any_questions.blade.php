<div class="service-section3">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-sm-12 s3-1">
          <h2>{{ setting_item("any_questions_title") }}</h2>
          <p>{!! setting_item("any_questions_desc") !!}</p>
        </div>
        <div class="col-lg-5 col-sm-12 s3-2">
          <a href="tel:{{ setting_item("phone_no_link") }}">
            <div class="row">
              <div class="call-icon">
                <img src="{{asset('assests/img/icons/cta-phone-icon.svg') }}">
              </div>
              <div>
                <span>{{ setting_item("any_questions_contact_title") }}</span>
                <h4>{{ setting_item("phone_no") }}</h4>
              </div>
            </div>
        </div></a>
      </div>
    </div>
  </div>

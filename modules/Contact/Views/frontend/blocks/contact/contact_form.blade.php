<div class="kontakt-service1 section ">
        <div class="container">
             <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="k-form">
                  <h2>{{ $title }}</h2>
                  <p>{{ $content }} </p>
                  @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                  <form  method="post" action="{{ route("contact.store") }}">
                    {{csrf_field()}}
                    <div style="display: none;">
                        <input type="hidden" name="g-recaptcha-response" value="">
                    </div>
                    {{-- @include('admin.message') --}}
                    <input class="input-one" placeholder="{{ __('Name *') }}" name="full_name" value="{{ old('full_name') }}">
                    @if ($errors->has('full_name'))
                        <span class="s1 text-danger">{{ $errors->first('full_name') }}</span>
                    @endif
                    <input class="input-one" placeholder="{{ __('Telefonnummer *') }}" name="phone" value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                        <span class="s2 text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                    <input class="input-two" placeholder="{{ __('E-Mail *') }}" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="s3 text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <textarea name="message" cols="40" rows="10" class="form-control textarea" placeholder="{{ __('Nachricht *') }}">{{ old('message') }}</textarea>
                    @if ($errors->has('message'))
                        <span class="s4 text-danger">{{ $errors->first('message') }}</span>
                    @endif

                       <!-- CAPTCHA -->
                       <div class="form-group">
                        <div class="captcha-img">
                            {{-- {!! captcha_img() !!} --}}
                            <img src="{{ captcha_src() }}" id="captcha-image" alt="captcha">
                            <button type="button" class="btn btn-secondary" id="refresh-captcha"><img class="refs-img" src="/uploads/0000/1/2024/09/07/ref-black-icon.svg" slt="ref-img"></button>
                        </div>
                        <div class="captcha-input">
                            <input type="text" name="captcha" class="form-control" placeholder="{{ __('Captcha') }}">
                        </div>
                        @if ($errors->has('captcha'))
                            <span class="s5 text-danger">{{ $errors->first('captcha') }}</span>
                        @endif

                    </div>

                    {{-- <input type="submit"> --}}
                    <button class="submit btn btn-primary" type="submit">
                        {{ __('Absenden') }}
                    </button>
                  </form>
                  <div class="form-mess"></div>
                </div>
                </div>
                   <div class="col-lg-5 col-md-5 col-sm-12">
                      <div class="k-info">
                         <h2>{{ $contact_label??'' }}</h2>
                         <ul>
                            <a href="tel:{{ setting_item_with_lang("phone_no_link") }}"><li><img src="/assests/img/icons/k-call-icon.svg">{{ setting_item_with_lang("phone_no") }}</li></a>
                            <a target="_blank" href="https://wa.me/4915771443156"><li><img src="/uploads/0000/1/2024/09/18/whatapp-phone.svg">0157 7144 3156</li></a>
                            <a href="mailto:{{ setting_item_with_lang("email") }}"><li><img src="/assests/img/icons/mail-nc.svg">{{ setting_item_with_lang("email") }}</li></a>
                            <a href="#"><li><img src="/assests/img/icons/k-watch-icon.svg">Mo -Sa: 8 Uhr - 20 Uhr</li></a>
                            <a target="_blank" href="{{ setting_item_with_lang("address_link") }}"><li><img src="/assests/img/icons/k-map-icon.svg">{{ setting_item_with_lang("address") }}</li></a>
                         </ul>
                         <h4>{{ $button_title }}</h4>
                         <a href="{{ $button_link }}" class="k-info-btn">{{ $button_text }}</a>
                         <img alt="{{ $button_text }}" title="{{ $button_text }}" class="img-k-Intersect" src="/assests/img/k-Intersect-icon.svg">
                      </div>
                   </div>
             </div>
        </div>
    </div>


    @once
    @push('js')
    <script>
        document.getElementById('refresh-captcha').addEventListener('click', function() {
            fetch('{{ route('captcha.refresh') }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('captcha-image').src = data.captcha;
                });
        });
    </script>
@endpush
@endonce

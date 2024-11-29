<div id="contactform">
    <div class="form_wrapper">
        <form method="post" action="{{ route("contact.store") }}"  class="bravo-contact-block-form">
            {{csrf_field()}}
            <div style="display: none;">
                <input type="hidden" name="g-recaptcha-response" value="">
            </div>
            <div class="contact-form-wrapper">
                @include('admin.message')
                <div class="contact-form">
                    <div class="form-group">
                        <input type="text" value="" placeholder=" {{ __('First Name') }} " name="firstname" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" value="" placeholder=" {{ __('Last Name') }} " name="surname" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" value="" placeholder=" {{ __('Nationality') }} " name="nationality" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" value="" placeholder="{{ __('Email') }}" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" value="" placeholder="{{ __('Mobile Number') }} (+41794445577)" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" value="" placeholder="{{ __('Subject') }}" name="subject" class="form-control">
                    </div>

                    <div class="form-group">
                        <textarea name="message" cols="40" rows="10" class="form-control textarea" placeholder="{{ __('Message') }}"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="captcha-img">
                            {!! captcha_img() !!}
                        </div>
                        <div class="captcha-input">
                            <input type="text" name="captcha" class="form-control"/>
                        </div>
                    </div>
                    <p>
                        <button class="submit btn btn-primary " type="submit">
                            {{ __('Send Message') }}
                            <i class="fa fa-spinner fa-pulse fa-fw"></i>
                        </button>
                    </p>
                </div>
            </div>
            <div class="form-mess"></div>
        </form>

    </div>
</div>

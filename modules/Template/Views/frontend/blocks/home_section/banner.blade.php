<?php
$image_url = get_file_url($bg_image, 'full');
$mobile_image_url = !empty($mobile_bg_image) ? get_file_url($mobile_bg_image, 'full') : '';
?>
<link rel="preload" as="image" href="{{ $image_url }}" fetchpriority="high" media="(min-width: 768px)">
@if($mobile_image_url)
<link rel="preload" as="image" href="{{ $mobile_image_url }}" fetchpriority="high" media="(max-width: 767px)">
@endif
<div class="home-banner lazyload" data-bg="{{$image_url}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h1>{{ $title }}</h1>
                {!! $content !!}
                <div class="row">
                    <div class="col-lg-5 col-md-4 col-sm-12"><a href="{{ $button_link }}"><button id="banner_btnid" class="banner-btn">{{ $button_text }}</button></a></div>
                    <div class="col-lg-5 col-md-6 col-sm-12 banner-sel">
                        <div class="banner-cta">
                            <a href="tel:{{ setting_item("phone_no_link") }}"><img class="lazyload" width="20" height="20" title="{{ setting_item("phone_no") }}" alt="{{ setting_item("phone_no") }}" data-src="/assests/img/icons/green-telephone.svg"> {{ setting_item("phone_no") }}</a>
                        </div>
                        <?php
                        $mobile_bg_image = $mobile_bg_image ?? "";
                        $image_url = get_file_url($mobile_bg_image, 'full');
                        $image_details = get_file_details($mobile_bg_image, '#');
                        ?>
                        <img title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" class="banner-mob-img lazyload" data-src="{{$image_url}}">
                    </div>
                </div>
                <div class="google-review-seal">
                    <a href="https://www.google.com/search?sca_esv=46e9a135ed8bd27b&sxsrf=ANbL-n68BX9l2RSMuyvm1sB0rVW4ONE8lQ:1776075675579&si=AL3DRZEsmMGCryMMFSHJ3StBhOdZ2-6yYkXd_doETEE1OR-qOWJl6N3M7ntI6eUQTSsbH7Jd2yAHK224ifJ8K3z6hd1vaRJ5H-YxhlgB4z7caXbeZ-v-MzDrvSMVL8slB-d61Fdobxi099aq4Bjxvpnf4uU02BURl4PieOJJgJ2c6Z3W6UV1ULgg1Fun-KDhdqrYngoWhNWm&q=Meissner+Entr%C3%BCmpelung+-+Wohnungsaufl%C3%B6sung+%26+Entsorgung+Reviews&sa=X&ved=2ahUKEwj0t_K9zeqTAxXsTWwGHYltCrgQ0bkNegQIMhAH&biw=1707&bih=772&dpr=1.25" target="_blank">
                        <img src="/uploads/0000/14/2026/04/13/aflex-google-review.webp" loading="lazy" width="120" height="40" alt="Google Reviews" srcset="">
                    </a>
                    <a href="https://www.provenexpert.com/de-de/meissner-entruempelung/" target="_blank">
                        <img src="/uploads/0000/1/2024/09/14/proven-expert.webp" loading="lazy" width="120" height="40" alt="ProvenExpert" srcset="">
                    </a>
                    <a href="https://de.trustpilot.com/review/meissner-entruempelung.de" target="_blank">
                        <img src="/uploads/0000/14/2026/04/14/trustpilot-lgo-150.png" loading="lazy" width="120" height="40" alt="Trustpilot" srcset="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home-form" id="home-formid">
    <div class="container">
        <h2>Jetzt ein kostenloses Angebot anfordern!</h2>
        @if (session('success'))
        <div class="alert alert-success" id="banner_home_form">
            {{ session('success') }}
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const banner = document.getElementById("banner_btnid");
                if (banner) {
                    banner.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        </script>
        @endif
        <form method="post" action="{{ route("requestquote.store") }}">
            {{csrf_field()}}
            <div class="home_form_row">
                <div>
                    <input placeholder="Name *" type="text" name="name" autocomplete="off" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <span class="s1 text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div>
                    <input placeholder="Telefonnummer *" type="number" autocomplete="off" name="phone" value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                    <span class="s1 text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div>
                    <input placeholder="E-Mail *" type="email" autocomplete="off" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                    <span class="s1 text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div>
                    <select id="select-option" name="service">
                        <option value="">Was können wir für Sie tun? *</option>
                        <option value="entruempelung">Entrümpelung</option>
                        <option value="entsorgung">Entsorgung</option>
                        <option value="umzug">Umzug</option>
                    </select>
                    @if ($errors->has('service'))
                    <span class="s1 text-danger">{{ $errors->first('service') }}</span>
                    @endif
                </div>

            </div>
            <span class="sub-box">
                <span class="check-info">
                    <input type="checkbox" id="check-box-n" name="terms"> <label for="check-box-n"> Ich habe die <a href="/datenschutz/" target="_blank">Datenschutzerklärung</a> zur Kenntnis genommen</label>
                    @if ($errors->has('terms'))
                    <!-- <span class="s1 text-danger">{{ $errors->first('terms') }}</span> -->
                    <span class="s1 text-danger">Dieses Feld ist erforderlich</span>
                    @endif
                </span><br>

                <!-- <div class="form-group">
                <div class="captcha-img">
                    <img src="{{ captcha_src() }}" id="captcha-image-pop" alt="captcha">
                </div>
                <button type="button" class="btn btn-secondary refresh-captcha-pop" id="refresh-captcha-pop"><img class="refs-img" src="/uploads/0000/1/2024/09/07/ref-black-icon.svg" slt="ref-img"></button>

                <div class="captcha-input">
                    <input type="text" name="captcha" class="form-control"/>
                </div>
                @if ($errors->has('captcha'))
                    <span class="s1 text-danger">{{ $errors->first('captcha') }}</span>
                @endif
            </div> -->
                <div class="form-group" style="min-height: 78px;">
                    <div class="g-recaptcha" data-sitekey="{{setting_item('recaptcha_api_key')}}"></div>
                    @if ($errors->has('g-recaptcha-response'))
                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                    @endif
                </div>

                <input type="submit" value="Absenden">
            </span>

        </form>
    </div>
</div>

@push('css')
<link rel="stylesheet" href="{{ asset('assests/css/home-page.css') }}">
@endpush
<?php
$image_url = get_file_url($bg_image, 'full');
?>
<div class="home-banner lazyload" data-bg="{{$image_url}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h1>{{ $title }}</h1>
                {!! $content !!}
                <div class="row">
                    <div class="col-lg-5 col-md-4 col-sm-12"><a href="{{ $button_link }}"><button class="banner-btn">{{ $button_text }}</button></a></div>
                    <div class="col-lg-5 col-md-6 col-sm-12 banner-sel">
                        <div class="banner-cta">
                            <a href="tel:{{ setting_item("phone_no_link") }}"><img class="lazyload" title="{{ setting_item("phone_no") }}" alt="{{ setting_item("phone_no") }}" data-src="/assests/img/icons/green-telephone.svg"> {{ setting_item("phone_no") }}</a>
                        </div>
                        <?php
                            $mobile_bg_image = $mobile_bg_image ?? "";
                            $image_url = get_file_url($mobile_bg_image, 'full');
                            $image_details = get_file_details($mobile_bg_image, '#');
                        ?>
                        <img title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}" class="banner-mob-img lazyload" data-src="{{$image_url}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home-form">
    <div class="container">
        <h2>Jetzt ein kostenloses Angebot anfordern!</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form  method="post" action="{{ route("requestquote.store") }}">
            {{csrf_field()}}
            <div class="home_form_row">
            <div>
            <input placeholder="Name *" type="text" name="name" value="{{ old('name') }}">
            @if ($errors->has('name'))
                <span class="s1 text-danger">{{ $errors->first('name') }}</span>
            @endif
            </div>
            <div>
            <input placeholder="Telefonnummer *" type="number" name="phone" value="{{ old('phone') }}">
            @if ($errors->has('phone'))
                <span class="s1 text-danger">{{ $errors->first('phone') }}</span>
            @endif
            </div>
            <div>
            <input placeholder="E-Mail *" type="email" name="email" value="{{ old('email') }}">
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

                <div class="form-group">
                    <div class="captcha-img">
                        <img src="{{ captcha_src() }}" id="captcha-image-pop" alt="captcha">
                    </div>
                    <button type="button" class="btn btn-secondary" id="refresh-captcha-pop"><img class="refs-img" src="/uploads/0000/1/2024/09/07/ref-black-icon.svg" slt="ref-img"></button>

                    <div class="captcha-input">
                        <input type="text" name="captcha" class="form-control"/>
                    </div>
                    @if ($errors->has('captcha'))
                        <span class="s1 text-danger">{{ $errors->first('captcha') }}</span>
                    @endif
                </div>

            <input type="submit" value="Absenden"></span>

        </form>
    </div>
</div>

@push('css')
  <link rel="stylesheet" href="{{ asset('assests/css/home-page.css') }}">
@endpush

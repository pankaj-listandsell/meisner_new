<?php $lang = request()->has('lang') ? request()->get('lang') : get_default_lang(); ?>
@if(true)
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Captcha")}}</h3>
        <p class="form-group-desc">{{__('Change map provider of your website')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("ReCaptcha Config")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="form-controls">
                        <label ><input type="checkbox" @if(setting_item('recaptcha_enable') == 1) checked @endif name="recaptcha_enable" value="1"> {{__("Enable ReCaptcha")}}</label>
                    </div>
                </div>
                <div class="form-group" data-condition="recaptcha_enable:is(1)">
                    <label>{{__("Version")}}</label>
                    <div class="form-controls">
                        <select name="recaptcha_version" id="recaptcha_version" class="form-control">
                            <option value="">{{ __("Version 2") }}</option>
                            <option @if(setting_item('recaptcha_version') =='v3' ) selected @endif value="v3">{{ __("Version 3") }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" data-condition="recaptcha_enable:is(1)">
                    <label>{{__("Api Key")}}</label>
                    <div class="form-controls">
                        <input type="text" name="recaptcha_api_key" value="{{setting_item('recaptcha_api_key')}}" class="form-control">
                        <p><i><a href="http://www.google.com/recaptcha/admin" target="blank">{{__("Learn how to get an api key")}}</a></i></p>
                    </div>
                </div>
                <div class="form-group" data-condition="recaptcha_enable:is(1)">
                    <label>{{__("Api Secret")}}</label>
                    <div class="form-controls">
                        <input type="text" name="recaptcha_api_secret" value="{{setting_item('recaptcha_api_secret')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<hr>
@if(is_default_lang($lang) && false)
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Stripe")}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Stripe Configuration")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__("Secret Key")}}</label>
                    <div class="form-controls">
                        <textarea name="stripe_secret_key" rows="2" class="form-control auto">{{ setting_item_with_lang('stripe_secret_key', $lang) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Public Key")}}</label>
                    <div class="form-controls">
                        <textarea name="stripe_publishable_key" rows="2" class="form-control auto">{{ setting_item_with_lang('stripe_publishable_key', $lang) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-controls">
                        <label><input type="checkbox" @if(setting_item('stripe_enable_sandbox') ?? '' == 1) checked @endif name="stripe_enable_sandbox" value="1"> {{__("Enable Sandbox")}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Test Secret Key")}}</label>
                    <div class="form-controls">
                        <textarea name="stripe_test_secret_key" rows="2" class="form-control auto">{{ setting_item_with_lang('stripe_test_secret_key', $lang) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Test Public Key")}}</label>
                    <div class="form-controls">
                        <textarea name="stripe_test_publishable_key" rows="2" class="form-control auto">{{ setting_item_with_lang('stripe_test_publishable_key', $lang) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Endpoint")}}</label>
                    <div class="form-controls">
                        <input type="text" name="stripe_endpoint" value="{{ setting_item_with_lang('stripe_endpoint', $lang) }}" class="form-control"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(is_default_lang($lang) && false)
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Paypal")}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Paypal Configuration")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__("Client ID")}}</label>
                    <div class="form-controls">
                        <textarea name="paypal_client_id" rows="2" class="form-control auto">{{ setting_item_with_lang('paypal_client_id', $lang) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Client Secret")}}</label>
                    <div class="form-controls">
                        <textarea name="paypal_client_secret" rows="2" class="form-control auto">{{ setting_item_with_lang('paypal_client_secret', $lang) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-controls">
                        <label>{{ __('Sandbox') }}</label>
                        <label class="mr-2 ml-3">
                            <input type="radio" @if(setting_item('paypal_enable_sandbox') == 1) checked @endif name="paypal_enable_sandbox" value="1">
                            {{__("Enable")}}
                        </label>
                        <label>
                            <input type="radio" @if(setting_item('paypal_enable_sandbox') == 0) checked @endif name="paypal_enable_sandbox" value="0">
                            {{__("Disable")}}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Test Client ID")}}</label>
                    <div class="form-controls">
                        <textarea name="paypal_test_client_id" rows="2" class="form-control auto">{{ setting_item_with_lang('paypal_test_client_id', $lang) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Test Client Secret")}}</label>
                    <div class="form-controls">
                        <textarea name="paypal_test_client_secret" rows="2" class="form-control auto">{{ setting_item_with_lang('paypal_test_client_secret', $lang) }}</textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endif


<?php

namespace Custom\Helpers\Traits;


class StripeClientService
{

	public static function getApiKey()
	{
        $apiKey = setting_item('stripe_publishable_key');
        if (setting_item('stripe_enable_sandbox')) {
            $apiKey = setting_item('stripe_test_publishable_key') ?? config('services.stripe.key');
        }
        return $apiKey;
	}

    public static function getApiSecret()
    {
        $secretKey = setting_item('stripe_secret_key');
        if (setting_item('stripe_enable_sandbox')) {
            $secretKey = setting_item('stripe_test_secret_key') ?? config('services.stripe.secret');
        }
        return $secretKey;
    }

}

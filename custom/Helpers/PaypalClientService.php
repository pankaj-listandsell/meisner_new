<?php


namespace Custom\Helpers;


use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PaypalClientService
{

	public static function getClient()
	{
		if (setting_item('paypal_enable_sandbox')) {
			$environment = new SandboxEnvironment(
                setting_item('paypal_test_client_id') ?? config('services.paypal.client_id'),
                    setting_item('paypal_test_client_secret') ?? config('services.paypal.client_secret')
			);
		} else {
			$environment = new ProductionEnvironment(
                setting_item('paypal_client_id'),
                setting_item('paypal_client_secret')
			);
		}

		return new PayPalHttpClient($environment);
	}


    public static function getPaypalClientId()
    {
        if (setting_item('paypal_enable_sandbox')) {
            return setting_item('paypal_test_client_id') ?? config('services.paypal.client_id');
        }
        return setting_item('paypal_client_id');
    }

    public static function getPaypalClientSecret()
    {
        if (setting_item('paypal_enable_sandbox')) {
            return setting_item('paypal_test_client_secret') ?? config('services.paypal.client_secret');
        }
        return setting_item('paypal_client_secret');
    }

}

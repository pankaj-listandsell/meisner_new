<?php

	namespace Modules\Core;

	use Modules\Core\Abstracts\BaseSettingsClass;

	class SettingClass extends BaseSettingsClass
	{
		const UPLOAD_DRIVER=['uploads','s3'];
		const BROADCAST_DRIVER=["null","log","pusher"];
		public static function getSettingPages()
		{
            $configs = [
                'general'=>[
                    'id'   => 'general',
                    'title' => __("General Settings"),
                    'position'=>0,
					'view'      => "Core::admin.settings.groups.general",
                    'enabled' => false,
					"keys"      => [
                        'site_title',
                        'email',
                        'phone_no',
                        'phone_no_link',
                        'site_desc',
                        'site_favicon',

                        'home_page_id',
                        'primary_menu_id',
                        'topbar_left_text',
                        'logo_id',
                        'footer_logo_id',
                        'footer_text_left',
                        'footer_text_right',
                        'list_widget_footer',
                        'site_locale',
                        'page_contact_title',
                        'page_contact_sub_title',
                        'page_contact_desc',
                        'page_contact_image',
                        'map',
                        'address',
                        'address_link',
                        'vat',
                        'max_order_amount',

                        'booking_term_conditions'
					],
                    'filter_demo_mode'=>[

                    ],
                    'html_keys' => [

                    ],
                ],
                'advance'=>[
                    'id'   => 'advance',
                    'title' => __("Advanced Settings"),
                    'position'=>80,
                    'view'      => "Core::admin.settings.groups.advance",
                    'enabled' => true,
                    "keys"      => [
                        'map_provider',
                        'map_gmap_key',
                        'google_client_secret',
                        'google_client_id',
                        'google_enable',
                        'facebook_client_secret',
                        'facebook_client_id',
                        'facebook_enable',
                        'twitter_enable',
                        'twitter_client_id',
                        'twitter_client_secret',
                        'recaptcha_enable',
                        'recaptcha_version',
                        'recaptcha_api_key',
                        'recaptcha_api_secret',
                        'head_scripts',
                        'body_scripts',
                        'footer_scripts',
                        'size_unit',

                        'cookie_agreement_enable',
                        'cookie_agreement_button_text',
                        'cookie_agreement_content',

                        'broadcast_driver',
                        'pusher_api_key',
                        'pusher_api_secret',
                        'pusher_app_id',
                        'pusher_cluster',

                        'stripe_publishable_key',
                        'stripe_secret_key',
                        'stripe_enable_sandbox',
                        'stripe_test_publishable_key',
                        'stripe_test_secret_key',
                        'stripe_endpoint',

                        'paypal_client_id',
                        'paypal_client_secret',
                        'paypal_enable_sandbox',
                        'paypal_test_client_id',
                        'paypal_test_client_secret',

                        //'search_open_tab',

                        'map_lat_default',
                        'map_lng_default',
                        'map_clustering',
                        'map_fit_bounds',
                    ],
                    'filter_demo_mode'=>[
                        'head_scripts',
                        'body_scripts',
                        'footer_scripts',
                        'cookie_agreement_content',
                        'cookie_agreement_button_text',
                    ]
                ],
                'global_widgets'=>[
                    'id'   => 'global_widgets',
                    'title' => __("Global Widgets Settings"),
                    'position'=>80,
                    'view'      => "Core::admin.settings.groups.global_widgets",
                    'enabled' => true,
                    "keys"      => [
                        //counter section
                        'first_counter_title',
                        'first_counter_subtitle',
                        'first_counter_icon',
                        'second_counter_title',
                        'second_counter_subtitle',
                        'second_counter_icon',
                        'third_counter_title',
                        'third_counter_subtitle',
                        'third_counter_icon',
                        'fourth_counter_title',
                        'fourth_counter_subtitle',
                        'fourth_counter_icon',

                        // Any Questions section
                        'any_questions_title',
                        'any_questions_desc',
                        'any_questions_contact_title',

                        // Five Step section
                        // 'five_steps_main_title',
                        // 'first_five_steps_title',
                        // 'first_five_steps_subtitle',
                        // 'first_five_steps_icon',
                        // 'second_five_steps_title',
                        // 'second_five_steps_subtitle',
                        // 'second_five_steps_icon',
                        // 'third_five_steps_title',
                        // 'third_five_steps_subtitle',
                        // 'third_five_steps_icon',
                        // 'fourth_five_steps_title',
                        // 'fourth_five_steps_subtitle',
                        // 'fourth_five_steps_icon',
                        // 'fifth_five_steps_title',
                        // 'fifth_five_steps_subtitle',
                        // 'fifth_five_steps_icon',

                        // Request for Service section
                        'request_service_title',
                        'request_service_desc',
                        'request_service_button_text',
                        'request_service_button_link',
                        'request_service_second_button_text',
                        'request_service_second_button_link',
                    ],
                    'filter_demo_mode'=>[

                    ]
                ],
			];
            return apply_filters(Hook::CORE_SETTING_CONFIG,$configs);
		}
	}

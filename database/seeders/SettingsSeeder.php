<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Core\Models\Settings;
use Modules\User\Emails\CreditPaymentEmail;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $updates = [
            [
                'name'  => 'topbar_left_text',
                'val'   => '<div class="socials">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                        <span class="line"></span>
                        <a href="mailto:contact@bookingcore.com">contact@bookingcore.com</a>',
                'group' => "general",
            ],
            [
                'name'  => 'search_open_tab',
                'val'   => 'current_tab',
            ],
            [
                'name'  => 'map_clustering',
                'val'   => 'on',
            ],
            [
                'name'  => 'map_fit_bounds',
                'val'   => 'on',
            ],
            [
                'name'  => 'tour_map_search_fields',
                'val'   => '[{"field":"location","attr":null,"position":"1"},{"field":"category","attr":null,"position":"2"},{"field":"date","attr":null,"position":"3"},{"field":"price","attr":null,"position":"4"},{"field":"advance","attr":null,"position":"5"}]',
                'group' => 'tour'
            ],
            [
                'name'  => 'tour_search_fields',
                'val'   => '[{"title":"Location","field":"location","size":"6","position":"1"},{"title":"From - To","field":"date","size":"6","position":"2"}]',
                'group' => 'tour'
            ],
            [
                'name'  => 'space_search_fields',
                'val'   => '[{"title":"Location","field":"location","size":"4","position":"1"},{"title":"From - To","field":"date","size":"4","position":"2"},{"title":"Guests","field":"guests","size":"4","position":"3"}]',
                'group' => 'tour'
            ],
            [
                'name'  => 'hotel_search_fields',
                'val'   => '[{"title":"Location","field":"location","size":"4","position":"1"},{"title":"Check In - Out","field":"date","size":"4","position":"2"},{"title":"Guests","field":"guests","size":"4","position":"3"}]',
                'group' => 'hotel'
            ],
            [
                'name'  => 'car_search_fields',
                'val'   => '[{"title":"Location","field":"location","size":"6","position":"1"},{"title":"From - To","field":"date","size":"6","position":"2"}]',
                'group' => 'car'
            ],
            [
                'name'  => 'enable_mail_vendor_registered',
                'val'   => '1',
                'group' => 'vendor'
            ],
            [
                'name'  => 'vendor_content_email_registered',
                'val'   => '<h1 style="text-align: center;">Welcome!</h1>
                        <h3>Hello [first_name] [last_name]</h3>
                        <p>Thank you for signing up with GES! We hope you enjoy your time with us.</p>
                        <p>Regards,</p>
                        <p>GES</p>',
                'group' => 'vendor'
            ],
            [
                'name'  => 'admin_enable_mail_vendor_registered',
                'val'   => '1',
                'group' => 'vendor'
            ],
            [
                'name'  => 'admin_content_email_vendor_registered',
                'val'   => '<h3>Hello Administrator</h3>
                        <p>An user has been registered as Vendor. Please check the information bellow:</p>
                        <p>Full name: [first_name] [last_name]</p>
                        <p>Email: [email]</p>
                        <p>Registration date: [created_at]</p>
                        <p>You can approved the request here: [link_approved]</p>
                        <p>Regards,</p>
                        <p>GES</p>',
                'group' => 'vendor'
            ],
            [
                'name'  => "booking_enquiry_enable_mail_to_vendor_content",
                'val'   => "<h3>Hello [vendor_name]</h3>
                        <p>You get new inquiry request from [email]</p>
                        <p>Name :[name]</p>
                        <p>Emai:[email]</p>
                        <p>Phone:[phone]</p>
                        <p>Content:[note]</p>
                        <p>Service:[service_link]</p>
                        <p>Regards,</p>
                        <p>GES</p>
                        </div>",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_enable_mail_to_admin_content",
                'val'   => "<h3>Hello Administrator</h3>
                        <p>You get new inquiry request from [email]</p>
                        <p>Name :[name]</p>
                        <p>Emai:[email]</p>
                        <p>Phone:[phone]</p>
                        <p>Content:[note]</p>
                        <p>Service:[service_link]</p>
                        <p>Vendor:[vendor_link]</p>
                        <p>Regards,</p>
                        <p>GES</p>",
                'group' => "enquiry",
            ],
            [
                'name' => 'wallet_credit_exchange_rate',
                'val' => 1,
            ],
            [
                'name' => 'wallet_deposit_rate',
                'val' => 1,
            ],
            [
                'name' => 'wallet_deposit_type',
                'val' => 'list',
            ],
            [
                'name' => 'wallet_deposit_lists',
                'val' => [
                    ['name' => __("100$"), 'amount' => 100, 'credit' => 100],
                    ['name' => __("Bonus 10%"), 'amount' => 500, 'credit' => 550],
                    ['name' => __("Bonus 15%"), 'amount' => 1000, 'credit' => 1150],
                ],
            ],
            [
                'name' => 'wallet_new_deposit_admin_subject',
                'val' => 'New credit purchase',
            ],
            [
                'name' => 'wallet_new_deposit_admin_content',
                'val' => CreditPaymentEmail::defaultNewBody(),
            ],
            [
                'name' => 'wallet_new_deposit_customer_subject',
                'val' => 'Thank you for your purchasing',
            ],
            [
                'name' => 'wallet_new_deposit_customer_content',
                'val' => CreditPaymentEmail::defaultNewBody(),
            ],
            [
                'name' => 'wallet_update_deposit_admin_subject',
                'val' => 'Credit purchase updated',
            ],
            [
                'name' => 'wallet_update_deposit_admin_content',
                'val' => CreditPaymentEmail::defaultUpdateBody(),
            ],
            [
                'name' => 'wallet_update_deposit_customer_subject',
                'val' => 'Your credit purchase updated',
            ],
            [
                'name' => 'wallet_update_deposit_customer_content',
                'val' => CreditPaymentEmail::defaultUpdateBody()
            ],
            [
                'name' => 'user_role',
                'val' => 2
            ],
            [
                'name' => 'user_plans_page_title',
                'val' => 'Pricing Packages'
            ],
            [
                'name' => 'user_plans_page_sub_title',
                'val' => 'Choose your pricing plan'
            ],
            [
                'name' => 'user_plans_sale_text',
                'val' => 'Save up to 10%',
            ],
            [
                'name' => 'booking_enquiry_for_hotel',
                'val' => '1'
            ],
            [
                'name' => 'booking_enquiry_type_hotel',
                'val' => 'booking_and_enquiry'
            ],
            [
                'name' => 'booking_enquiry_for_tour',
                'val' => '1'
            ],
            [
                'name' => 'booking_enquiry_type_tour',
                'val' => 'booking_and_enquiry'
            ],
            [
                'name' => 'booking_enquiry_for_space',
                'val' => '1'
            ],
            [
                'name' => 'booking_enquiry_type_space',
                'val' => 'booking_and_enquiry'
            ],
            [
                'name' => 'booking_enquiry_for_car',
                'val' => '1'
            ],
            [
                'name' => 'booking_enquiry_type_car',
                'val' => 'booking_and_enquiry'
            ],
            [
                'name' => 'booking_enquiry_for_event',
                'val' => '1'
            ],
            [
                'name' => 'booking_enquiry_type_event',
                'val' => 'booking_and_enquiry'
            ],
            [
                'name' => 'booking_enquiry_for_boat',
                'val' => '1'
            ],
            [
                'name' => 'booking_enquiry_type_boat',
                'val' => 'booking_and_enquiry'
            ],
        ];


        foreach ($updates as $update) {
            Settings::updateOrCreate(
                ['name' => $update['name']],
                ['val' => $update['val'], 'group' => $update['group'] ?? null]
            );
        }
    }
}

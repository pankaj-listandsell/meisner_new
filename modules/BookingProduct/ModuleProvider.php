<?php
namespace Modules\BookingProduct;

use Modules\BookingProduct\Models\BookingProduct;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        $count = BookingProduct::count('id');
        return [
            'booking_products'=>[
                "position"=>20,
                'url'        => route('booking_products.admin.index'),
                'title'      => __("Produkte Buchen"),//.($count ? ' <span class="badge badge-warning">'.$count.'</span>':''),
                'icon'       => 'ion-md-calendar',
                'permission' => 'booking_products_view',
                'children'   => [
                    'booking_products_view'=>[
                        'url'        => route('booking_products.admin.index'),
                        'title'      => __("Alle Buchungsprodukte"),
                        'permission' => 'booking_products_view',
                    ],

                ]
            ],
        ];
    }

    public static function getTemplateBlocks(){
        return [
            'booking_product_form'=>"\\Modules\\BookingProduct\\Blocks\\BookingProduct",
        ];
    }
}

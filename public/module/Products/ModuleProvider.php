<?php
namespace Modules\Products;

use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Products\Models\Products;

class ModuleProvider extends ModuleServiceProvider
{


    public function boot(SitemapHelper $sitemapHelper){
        $sitemapHelper->add("products",[app()->make(Products::class),'getForSitemap']);

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/products.php', 'products'
        );

        $this->app->register(RouteServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        $count = Products::whereStatus('pending')->count('id');
        return [
            'products'=>[
                "position"=>20,
                'url'        => route('products.admin.index'),
                'title'      => __("Products").($count ? ' <span class="badge badge-warning">'.$count.'</span>':''),
                'icon'       => 'ion-md-bookmarks',
                'permission' => 'products_view',
                'children'   => [
                    'products_view'=>[
                        'url'        => route('products.admin.index'),
                        'title'      => __("All Products"),
                        'permission' => 'products_view',
                    ],
                    'products_create'=>[
                        'url'        => route('products.admin.create'),
                        'title'      => __("Add Products"),
                        'permission' => 'products_create',
                    ],
                    'products_categoty'=>[
                        'url'        => route('products.admin.category.index'),
                        'title'      => __("Categories"),
                        'permission' => 'products_create',
                    ],

                ]
            ],
        ];
    }

    public static function getTemplateBlocks(){
        return [
            // 'list_news'=>"\\Modules\\News\\Blocks\\ListNews",
        ];
    }

    public static function getUserMenu()
    {
        $res = [];

        $res['products'] = [
            "position"=>80.1,
            'url'        => route('products.vendor.index'),
            'title'      => __("Manage Products"),
            'icon'       => 'ion-md-bookmarks',
            'permission' => 'products_view',
        ];

        return $res;
    }
}

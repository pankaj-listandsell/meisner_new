<?php
namespace  Modules\Products;

use Modules\Core\Abstracts\BaseSettingsClass;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'products',
                'title' => __("Products Settings"),
                'position'=>30,
                'view'=>"Products::admin.settings.products",
                'enabled' => false,
                "keys"=>[
                    'products_page_list_title',
                    'products_page_list_banner',
                    'products_sidebar',
                    'products_page_list_seo_title',
                    'products_page_list_seo_desc',
                    'products_page_list_seo_image',
                    'products_page_list_seo_share',
                    'products_vendor_need_approve',
                ],
                'html_keys'=>[
                ]
            ]
        ];
    }
}

<?php
namespace Modules\Gallery;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Gallery\Models\Gallery;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot(SitemapHelper $sitemapHelper)
    {
        /*if(is_installed() and Gallery::isEnable()){
            $sitemapHelper->add("gallery",[app()->make(Gallery::class),'getForSitemap']);
        }*/
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
        $res = [];
        if(Gallery::isEnable() && false){
            $res['gallery'] = [
                "position"      => 45,
                'url'           => route('gallery.admin.index'),
                'title'         => __("Gallery"),
                'icon'          => 'icon ion-md-grid',
                'permission'    => 'gallery_view',
            ];
        }
        return $res;
    }



    public static function getMenuBuilderTypes()
    {
        if(!Gallery::isEnable()) return [];

        return [
            [
                'class'     => \Modules\Gallery\Models\Gallery::class,
                'name'      => __("Gallery"),
                'items'     => \Modules\Gallery\Models\Gallery::searchForMenu(),
                'position'  => 120
            ],
        ];
    }

    public static function getTemplateBlocks(){
        if(!Gallery::isEnable()) return [];

        return [
            /*'carousel_grid'=>"\\Modules\\Gallery\\Blocks\\CarouselGrid",
            'gallery_grid'=>"\\Modules\\Gallery\\Blocks\\GalleryGrid",*/
        ];
    }
}

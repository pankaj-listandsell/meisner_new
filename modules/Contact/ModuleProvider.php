<?php
namespace Modules\Contact;

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

    public static function getTemplateBlocks(){
        return [
            'breadcrumb_banner'=>"\\Modules\\Contact\\Blocks\\BreadcrumbBanner",
            'contact_form'=>"\\Modules\\Contact\\Blocks\\Contact",
            'map'=>"\\Modules\\Contact\\Blocks\\Map",
        ];
    }
}

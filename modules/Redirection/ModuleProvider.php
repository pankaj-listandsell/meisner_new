<?php
namespace Modules\Redirection;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

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
        return [
            'redirection'=>[
                "position"      => 12,
                'url'           => route('redirection.admin.index'),
                'title'         => __('Redirection'),
                'icon'          => 'ion ion-ios-cube',
                'permission'    => 'redirection_view',
            ]
        ];
    }

}

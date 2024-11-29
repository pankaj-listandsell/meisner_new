<?php

namespace Modules\User;

use App\User;
use Illuminate\Support\Facades\Auth;
use Modules\ModuleServiceProvider;
use Modules\User\Models\Plan;

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
        $this->app->register(EventServiceProvider::class);
        $this->app->register(CustomFortifyAuthenticationProvider::class);
    }

    public static function getPayableServices()
    {
        return ['plan'=>Plan::class];
    }

    public static function getAdminMenu()
    {
        $noti_verify = User::countVerifyRequest();
        $noti = $noti_verify;

        $options = [
            "position"=>100,
            'url'        => route('user.admin.index'),
            'title'      => __('Users :count',['count'=>$noti ? sprintf('<span class="badge badge-warning">%d</span>',$noti) : '']),
            'icon'       => 'icon ion-ios-contacts',
            'permission' => 'user_view',
            'children'   => [
                'user'=>[
                    'url'   => route('user.admin.index'),
                    'title' => __('All Users'),
                    'icon'  => 'fa fa-user',
                ],
                'role'=>[
                    'url'        => route('user.admin.role.index'),
                    'title'      => __('Role Manager'),
                    'permission' => 'role_view',
                    'icon'       => 'fa fa-lock',
                ],
                /*'subscriber'=>[
                    'url'        => route('user.admin.subscriber.index'),
                    'title'      => __('Subscribers'),
                    'permission' => 'newsletter_manage',
                ],*/
            ]
        ];

        $is_disable_verification_feature = setting_item('user_disable_verification_feature');

        return [
            'users'=> $options,
        ];
    }
    public static function getUserMenu()
    {

        return [];
    }


}

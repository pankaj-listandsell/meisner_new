<?php
namespace Modules\Form;

use Illuminate\Support\Facades\Validator;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Form\Models\Form;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){
        //$sitemapHelper->add("forms", [app()->make(Form::class),'getForSitemap']);

        Validator::extend(
            'alpha_num_symbol',
            function($attribute, $value, $parameters, $validator)
            {
                return preg_match('/[A-Za-z]/', $value) && preg_match('/[0-9]/', $value);
            }
        );
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/forms.php', 'forms'
        );

        $this->app->register(RouteServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'forms' => [
                "position"=>15,
                'url'        => route('admin.form.index'),
                'title'      => __("Forms"),
                'icon'       => 'ion-md-bookmarks',
                'permission' => 'news_view',
                'children'   => [
                    // 'form_view'=>[
                    //     'url'        => route('admin.form.index'),
                    //     'title'      => __("Clearing Forms"),
                    //     'permission' => 'form_view',
                    // ],
                    // 'cc_form_view'=>[
                    //     'url'        => route('admin.form.crime_cleaning'),
                    //     'title'      => __("Crime Cleaning Forms"),
                    //     'permission' => 'form_view',
                    // ],
                    // 'painting_form_view'=>[
                    //     'url'        => route('admin.form.painting'),
                    //     'title'      => __("Painting Forms"),
                    //     'permission' => 'form_view',
                    // ],
                    // 'mover_form_view'=>[
                    //     'url'        => route('admin.form.mover'),
                    //     'title'      => __("Mover Forms"),
                    //     'permission' => 'form_view',
                    // ],
                    'popup_contact'=>[
                        'url'        => route('admin.form.popup'),
                        'title'      => __('Popup Contacts'),
                        'permission' => 'form_view',
                    ],
                    'contact'=>[
                        'url'        => route('admin.form.contact'),
                        'title'      => __('Contacts'),
                        'permission' => 'form_view',
                    ],
                    'booking'=>[
                        'url'        => route('admin.form.booking'),
                        'title'      => __('Bookings'),
                        'permission' => 'form_view',
                    ],
                    /*'contact_next'=>[
                        'url'        => route('contact.admin.index'),
                        'title'      => __('Contacts'),
                        'permission' => 'contact_manage',
                    ],*/
                ]
            ],
        ];
    }

    public static function getUserMenu()
    {
        $res = [];

        $res['forms'] = [
            "position"=> 80.1,
            'url'        => route('news.vendor.index'),
            'title'      => __("Manage Forms"),
            'icon'       => 'ion-md-bookmarks',
            'permission' => 'news_view',
        ];

        return $res;
    }
}

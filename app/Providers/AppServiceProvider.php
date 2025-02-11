<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Models\Settings;
use function Clue\StreamFilter\fun;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        /*DB::listen(function($query) {
            Log::info(
                $query->sql,
                [
                    'bindings' => $query->bindings,
                    'time' => $query->time
                ]
            );
        });*/

        Settings::init();

        if(env('APP_HTTPS')) {
            \URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS','on');
        }
        Schema::defaultStringLength(191);



        if (strpos($request->path(), 'install') === false && is_installed()) {
            $this->setLang();
        }

        if(is_installed()){
            $this->initConfigFromDB();
        }

        // check deleted user
        if(auth()->id() and !auth()->check()){
            auth()->logout();
        }
    }

    public function initLocale()
    {
        $locale = get_default_lang();

        if (has_locale_session()) {
            $locale = get_locale_session();
        }

        app()->setLocale($locale);
    }

    protected function initConfigFromDB(){

        // Load Config from Database
        if($data = setting_item('site_title')){
            Config::set('app.name', $data);
        }

        if (!empty(setting_item('site_timezone'))) {
            Config::set('app.timezone', setting_item("site_timezone"));
            date_default_timezone_set(config('app.timezone'));
        }


        // Pusher
        if (!empty(setting_item('broadcast_driver'))) {
            Config::set('broadcasting.default',setting_item('broadcast_driver','log'));
        }
        if (!empty(setting_item('pusher_api_key'))) {
            Config::set('chatify.pusher.key', setting_item("pusher_api_key"));
            Config::set('broadcasting.connections.pusher.key',setting_item('pusher_api_key'));
        }
        if (!empty(setting_item('pusher_api_secret'))) {
            Config::set('chatify.pusher.secret', setting_item("pusher_api_secret"));
            Config::set('broadcasting.connections.pusher.secret',setting_item('pusher_api_secret'));

        }
        if (!empty(setting_item('pusher_app_id'))) {
            Config::set('chatify.pusher.app_id', setting_item("pusher_app_id"));
            Config::set('broadcasting.connections.pusher.app_id',setting_item('pusher_app_id'));

        }
        if (!empty(setting_item('pusher_cluster'))) {
            Config::set('chatify.pusher.options.cluster',setting_item('pusher_cluster'));
            Config::set('broadcasting.connections.pusher.options.cluster',setting_item('pusher_cluster'));
        }

        if(!setting_item('user_enable_2fa')){
            $features = config('fortify.features');
            $key = array_search('two-factor-authentication', $features);
            if (false !== $key) {
                unset($features[$key]);
                Config::set('fortify.features',array_values($features));
            }
        }
    }

    protected function setLang(){

        $request = \request();
        $locale = $request->segment(1);
        $languages = \Modules\Language\Models\Language::getActive();
        $localeCodes = Arr::pluck($languages,'locale');

        if(in_array($locale,$localeCodes)){
            app()->setLocale($locale);
        }else{
            app()->setLocale(setting_item('site_locale'));
        }

        if(!empty($locale) and $locale == setting_item('site_locale'))
        {
            $segments = $request->segments();
            if(!empty($segments) and count($segments) > 1) {
                array_shift($segments);
                return redirect()->to(implode('/', $segments))->send();
            }
        }
    }
}

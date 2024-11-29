<?php


namespace Themes\Base;


use Illuminate\Contracts\Http\Kernel;
use Modules\Core\ModuleProvider;
use Modules\Theme\Abstracts\AbstractThemeProvider;
use Themes\Base\Core\Middleware\RunUpdater;

class ThemeProvider extends AbstractThemeProvider
{

    public static $version = '2.5.1';
    public static $name = 'GES Theme';

    public static function info()
    {
        // TODO: Implement info() method.
    }

    public static $modules = [
        'core'=>ModuleProvider::class,
        'api'=>\Modules\Api\ModuleProvider::class,
        'contact'=>\Modules\Contact\ModuleProvider::class,
        'booking'=>\Modules\Booking\ModuleProvider::class,
        'bookingproduct'=>\Modules\BookingProduct\ModuleProvider::class,
        'products'=>\Modules\Products\ModuleProvider::class,
        'dashboard'=>\Modules\Dashboard\ModuleProvider::class,
//        'email'=>\Modules\Email\ModuleProvider::class,
        'language'=>\Modules\Language\ModuleProvider::class,
        'media'=>\Modules\Media\ModuleProvider::class,
        'news'=>\Modules\News\ModuleProvider::class,
        'user'=>\Modules\User\ModuleProvider::class,
        'template'=>\Modules\Template\ModuleProvider::class,
        'redirection'=>\Modules\Redirection\ModuleProvider::class,
        'gallery'=>\Modules\Gallery\ModuleProvider::class,
        'form'=>\Modules\Form\ModuleProvider::class,
        'page'=>\Modules\Page\ModuleProvider::class,
    ];

    public function boot(Kernel $kernel){

        $kernel->pushMiddleware(RunUpdater::class);

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }

    public function register()
    {
        foreach (static::$modules as $module=>$class){
            $this->app->register($class);
        }
    }
}

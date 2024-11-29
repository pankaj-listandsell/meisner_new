<?php
namespace App\Http\Middleware;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use Closure;
class SetLanguageForAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (strpos($request->path(), 'install') === false && file_exists(storage_path() . '/installed')) {

            $request = \request();
            $locale = $request->segment(1);

            if (in_array($locale, $this->getUriForDefaultLang())) {
                app()->setLocale(get_default_lang());
                return $next($request);
            }

            $languages = get_active_languages();
            $localeCodes = Arr::pluck($languages,'locale');
            // For Admin
            if($locale == 'admin' and $request->cookie('bc_admin_locale')){
                $locale = $request->cookie('bc_admin_locale');
            } else {
                $locale = has_locale_session() ? get_locale_session() : get_default_lang();
            }

            if (in_array($locale,$localeCodes)) {
                app()->setLocale($locale);
            } else {
                app()->setLocale(get_default_lang());
            }

        }
        return $next($request);
    }

    public function getUriForDefaultLang(): array
    {
        return ['blog'];
    }
}

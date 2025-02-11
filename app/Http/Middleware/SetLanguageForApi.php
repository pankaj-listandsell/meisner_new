<?php
namespace App\Http\Middleware;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use Closure;
class SetLanguageForApi
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
        if($locale = $request->get('lang'))
        {
            $languages = \Modules\Language\Models\Language::getActive();
            $localeCodes = Arr::pluck($languages,'locale');
            if(in_array($locale,$localeCodes)){
                app()->setLocale($locale);
            }
        } else {
            $locale = has_locale_session() ? get_locale_session() : setting_item('site_locale');

            app()->setLocale($locale);
        }
        return $next($request);
    }
}

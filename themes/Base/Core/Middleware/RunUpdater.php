<?php

namespace Themes\Base\Core\Middleware;

use Closure;

class RunUpdater
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*if (strpos($request->path(), 'install') === false && is_installed() and !app()->runningInConsole()) {
        }*/

        return $next($request);
    }


}

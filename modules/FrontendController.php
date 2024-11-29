<?php
namespace Modules;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @throws AuthorizationException
     */
    public function checkPermission($permission = false)
    {
        if ($permission) {
            if (!Auth::check() or !Auth::user()->hasPermissionTo($permission)) {
                if(request()->ajax()){
                    throw new AuthorizationException('Permission denied', 403);
                } else {
                    abort(403);
                }
            }
        }
    }

    public function hasPermission($permission)
    {
        if(!Auth::check()) return false;
        return Auth::user()->hasPermissionTo($permission);
    }
}

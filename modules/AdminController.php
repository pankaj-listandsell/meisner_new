<?php
namespace Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware(['auth','permission:dashboard_access']);
    }

    public function checkPermission($permission = false)
    {
        if ($permission) {
            if (!Auth::check() or !Auth::user()->hasPermissionTo($permission)) {
                abort(403);
            }
        }
    }

    public function hasPermission($permission): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return Auth::user()->hasPermissionTo($permission);
    }
}

<?php

namespace Custom\Helpers\Traits;

use Illuminate\Support\Facades\Auth;

trait AuthPermission
{

    public static function checkOrAbort($permission = false): bool
    {
        if ($permission) {
            if (!Auth::check() or !Auth::user()->hasPermissionTo($permission)) {
                abort(403);
            }
        }

        return false;
    }


    public static function has($permission): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return (bool) Auth::user()->hasPermissionTo($permission);
    }

}

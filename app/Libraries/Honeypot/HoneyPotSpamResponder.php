<?php

namespace App\Libraries\Honeypot;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Honeypot\SpamResponder\SpamResponder;

class HoneyPotSpamResponder implements SpamResponder
{

    /**
     * @throws ValidationException
     */
    public function respond(Request $request, Closure $next)
    {
        throw ValidationException::withMessages(['honeypot' => trans('Request is invalid')]);
    }
}


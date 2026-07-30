<?php
use \Illuminate\Support\Facades\Route;
use Modules\Redirection\Models\Redirection;

foreach (Redirection::getAll() as $redirection) {
    Route::get('/'.$redirection->from_url, function () use ($redirection) {
        $to = $redirection->to_url;

        if (!preg_match('#^https?://#i', $to)) {
            $path = '/'.ltrim($to, '/');

            // Internal paths always end with a slash, otherwise .htaccess adds one more hop
            if (!str_contains($path, '?') && !str_ends_with($path, '/')) {
                $path .= '/';
            }

            // url()->to() strips trailing slashes, so build the absolute URL manually
            $to = rtrim(url('/'), '/').$path;
        }

        return redirect()->to($to, 301);
    });
}
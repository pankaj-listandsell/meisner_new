<?php
use \Illuminate\Support\Facades\Route;
use Modules\Redirection\Models\Redirection;

foreach (Redirection::getAll() as $redirection) {
    Route::get('/'.$redirection->from_url, function () use ($redirection) {
        return redirect()->to($redirection->to_url);
    });
}
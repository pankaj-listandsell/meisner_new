<?php

use \Illuminate\Support\Facades\Route;
use Modules\Redirection\Admin\RedirectionController;

Route::get('/',             [RedirectionController::class, 'index'])->name('redirection.admin.index');
Route::get('/create',       [RedirectionController::class, 'create'])->name('redirection.admin.create');
Route::get('/edit/{id}',    [RedirectionController::class, 'edit'])->name('redirection.admin.edit');
Route::post('/store/{id}',  [RedirectionController::class, 'store'])->name('redirection.admin.store');
Route::post('/bulkEdit',    [RedirectionController::class, 'bulkEdit'])->name('redirection.admin.bulkEdit');
Route::get('/recovery',     [RedirectionController::class, 'recovery'])->name('redirection.admin.recovery');

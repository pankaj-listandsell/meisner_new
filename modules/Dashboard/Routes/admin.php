<?php

use \Illuminate\Support\Facades\Route;

Route::get('/','DashboardController@index')->name('admin.index');
Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');

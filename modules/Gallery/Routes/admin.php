<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','GalleryController@index')->name('gallery.admin.index');
Route::get('/create','GalleryController@create')->name('gallery.admin.create');
Route::get('/edit/{id}','GalleryController@edit')->name('gallery.admin.edit');
Route::post('/store/{id}','GalleryController@store')->name('gallery.admin.store');
Route::post('/bulkEdit','GalleryController@bulkEdit')->name('gallery.admin.bulkEdit');
Route::get('/recovery','GalleryController@recovery')->name('gallery.admin.recovery');
Route::get('/getForSelect2','GalleryController@getForSelect2')->name('gallery.admin.getForSelect2');
Route::post('/sort-gallery-img','GalleryController@sortImages')->name('gallery.admin.sort_images');

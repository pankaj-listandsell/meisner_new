<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/1/2019
 * Time: 10:02 AM
 */
use Illuminate\Support\Facades\Route;

Route::get('/','ProductsController@index')->name('products.admin.index');
Route::get('/create','ProductsController@create')->name('products.admin.create');
Route::get('/edit/{id}', 'ProductsController@edit')->name('products.admin.edit');
Route::post('/bulkEdit','ProductsController@bulkEdit')->name('products.admin.bulkEdit');
Route::post('/store/{id}','ProductsController@store')->name('products.admin.store');

Route::get('/category','CategoryController@index')->name('products.admin.category.index');
Route::get('/category/getForSelect2','CategoryController@getForSelect2')->name('products.admin.category.getForSelect2');
Route::get('/category/edit/{id}','CategoryController@edit')->name('products.admin.category.edit');
Route::post('/category/store/{id}','CategoryController@store')->name('products.admin.category.store');
Route::post('/category/bulkEdit','CategoryController@bulkEdit')->name('products.admin.category.bulkEdit');

Route::get('/tag','TagController@index')->name('products.admin.tag.index');
Route::get('/tag/edit/{id}','TagController@edit')->name('products.admin.tag.edit');
Route::post('/tag/store/{id}','TagController@store')->name('products.admin.tag.store');
Route::post('/tag/bulkEdit','TagController@bulkEdit')->name('products.admin.tag.bulkEdit');

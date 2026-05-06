<?php
use Illuminate\Support\Facades\Route;

Route::get('/','BookingController@index')->name('booking_products.admin.index');
Route::get('/view/{id}', 'BookingController@view')->name('booking_products.admin.view');


Route::post('/modal-detail-ajax','BookingController@modalDetailAjax')->name('booking.admin.modal_detail');
Route::post('/bulkEdit','BookingController@bulkEdit')->name('booking.admin.bulkEdit');

Route::get('getForSelect2','BookingController@getForSelect2')->name('booking.admin.getForSelect2');

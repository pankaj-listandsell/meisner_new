<?php
use Illuminate\Support\Facades\Route;

Route::get('/','ContactController@index')->name('contact.admin.index');
Route::post('/modal-detail-ajax','ContactController@modalDetailAjax')->name('contact.admin.modal_detail');
Route::post('/bulkEdit','ContactController@bulkEdit')->name('contact.admin.bulkEdit');

Route::get('getForSelect2','ContactController@getForSelect2')->name('contact.admin.getForSelect2');


Route::get('/quote','ContactController@indexq')->name('requestquote.admin.index');
Route::post('/modal-detail-ajax-quote','ContactController@modalDetailAjaxq')->name('requestquote.admin.modal_detail');
Route::post('/bulkEditQuote','ContactController@bulkEditq')->name('requestquote.admin.bulkEdit');



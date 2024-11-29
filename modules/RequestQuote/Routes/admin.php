<?php
use Illuminate\Support\Facades\Route;

Route::get('/','RequestQuoteController@index')->name('requestquote.admin.index');
Route::post('/modal-detail-ajax','RequestQuoteController@modalDetailAjax')->name('requestquote.admin.modal_detail');
Route::post('/bulkEdit','RequestQuoteController@bulkEdit')->name('requestquote.admin.bulkEdit');

Route::get('getForSelect2','RequestQuoteController@getForSelect2')->name('requestquote.admin.getForSelect2');

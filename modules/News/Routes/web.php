<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=> config('news.news_frontend_route_prefix')],function(){
    Route::get('/','NewsController@index')->name('news.index');
    Route::get('/{slug}','NewsController@detail')->name('news.detail');
    Route::get('/category/{slug}', 'CategoryNewsController@index')->name('news.category.index');
});

//Route::get('/'.config('news.news_tag_route_prefix').'/{slug}', 'TagNewsController@index')->name('news.tag.index');

/*Route::prefix('vendor/'.config('news.news_route_prefix'))->name('news.vendor.')->middleware(['auth','verified'])->group(function(){
    Route::get('/','VendorNewsController@index')->name('index');
    Route::get('/create','VendorNewsController@create')->name('create');
    Route::get('/edit/{id}', 'VendorNewsController@edit')->name('edit');
    Route::post('/bulkEdit','VendorNewsController@bulkEdit')->name('bulkEdit');
    Route::post('/store/{id}','VendorNewsController@store')->name('store');
});*/

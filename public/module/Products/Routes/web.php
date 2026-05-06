<?php
use Illuminate\Support\Facades\Route;

// Route::group(['prefix'=> config('products.products_frontend_route_prefix')],function(){
//     Route::get('/','ProductsController@index')->name('products.index');
//     Route::get('/{slug}','ProductsController@detail')->name('products.detail');
//     Route::get('/category/{slug}', 'CategoryProductsController@index')->name('products.category.index');
// });

//Route::get('/'.config('news.news_tag_route_prefix').'/{slug}', 'TagNewsController@index')->name('news.tag.index');

/*Route::prefix('vendor/'.config('news.news_route_prefix'))->name('news.vendor.')->middleware(['auth','verified'])->group(function(){
    Route::get('/','VendorNewsController@index')->name('index');
    Route::get('/create','VendorNewsController@create')->name('create');
    Route::get('/edit/{id}', 'VendorNewsController@edit')->name('edit');
    Route::post('/bulkEdit','VendorNewsController@bulkEdit')->name('bulkEdit');
    Route::post('/store/{id}','VendorNewsController@store')->name('store');
});*/

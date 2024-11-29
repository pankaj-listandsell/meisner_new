<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

// Page
// Route::get('/', 'PageController@homePage')->name('home');
// Route::group(['prefix'=>config('page.page_route_prefix')],function(){
//     Route::get('/{slug?}','PageController@detail')->name('page.detail');// Detail
//     Route::get('/{lang}/{slug?}','PageController@detail')->name('page.lang.detail');
// });

foreach (get_language_codes() as $languageCode) {
    Route::get($languageCode,'PageController@homePage');
}
Route::get('/', 'PageController@homePage')->name('home');

foreach (get_language_codes() as $languageCode) {
    Route::group(['prefix'=> $languageCode], function() {
        Route::get('{slug?}/{branch?}','PageController@detail')->name('page.lang.detail');
    });
}
Route::get('{slug?}/{branch?}','PageController@detail')->name('page.detail');// Detail

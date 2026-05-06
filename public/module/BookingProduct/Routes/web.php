<?php
use Illuminate\Support\Facades\Route;
use eRecht24\RechtstexteSDK\Helper\Helper;
use \eRecht24\RechtstexteSDK\Model\LegalText;
use \eRecht24\RechtstexteSDK\LegalTextHandler;


// Route::post('/booking/store','BookingController@store')->name("booking.store");
Route::get('/booking-product/category-products','BookingController@category_products')->name("bookingproduct.category_products");
Route::post('/booking-product/cartdata','BookingController@cartdata')->name("bookingproduct.cartdata");
Route::post('/booking-product/booking','BookingController@booking')->name("bookingproduct.booking");
Route::get('/booking-product/search-category','BookingController@search_category')->name("bookingproduct.search_category");







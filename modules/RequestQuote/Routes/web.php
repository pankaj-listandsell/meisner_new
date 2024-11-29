<?php
use Illuminate\Support\Facades\Route;
use eRecht24\RechtstexteSDK\Helper\Helper;
use \eRecht24\RechtstexteSDK\Model\LegalText;
use \eRecht24\RechtstexteSDK\LegalTextHandler;


Route::post('/requestquote/store','RequestQuoteController@store')->name("requestquote.store");



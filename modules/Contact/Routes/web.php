<?php
use Illuminate\Support\Facades\Route;
use eRecht24\RechtstexteSDK\Helper\Helper;
use \eRecht24\RechtstexteSDK\Model\LegalText;
use \eRecht24\RechtstexteSDK\LegalTextHandler;

//Contact
/*Route::get('/contact','ContactController@index')->name("contact.index");
Route::get('/{lang}/contact','ContactController@index')->name("contact.index.lang");*/
Route::post('/contact/store','ContactController@store')->name("contact.store");

/*Route::get('/testing-api',function () {
    $legalTextHandler = new LegalTextHandler('7ec44323c3846e781c8a60503c9893c992face567aa1aa8c25109dca3c4d3b39', Helper::PUSH_TYPE_PRIVACY_POLICY, 'YOUR-PLUGIN-KEY');
    $legalTextDoc = $legalTextHandler->importDocument();
    $legalText = $legalTextDoc->getHtmlDE();
})->name("testing_api.index");*/

Route::get('/refresh-captcha', function () {
    return response()->json(['captcha'=> captcha_src()]);
})->name('captcha.refresh');

Route::post('/requestquote/store','ContactController@storequote')->name("requestquote.store");

<?php
use Illuminate\Support\Facades\Route;
use Modules\Form\Controllers\FormController;
use Spatie\Honeypot\ProtectAgainstSpam;

/*Route::get('clearing-form',             [FormController::class, 'clearingForm'])->name('frontend.form.clearing');
Route::get('{lang}/clearing-form',      [FormController::class, 'clearingForm'])->name('frontend.lang.form.clearing');*/

Route::post('register/clearing-form',   [FormController::class, 'registerClearingForm'])
    ->name('frontend.register.clearing_form')
    ->middleware(ProtectAgainstSpam::class);

/*Route::get('crime-cleaning-form',           [FormController::class, 'crimeCleaningForm'])->name('frontend.form.crime_cleaning');
Route::get('{lang}/crime-cleaning-form',    [FormController::class, 'crimeCleaningForm'])->name('frontend.lang.form.crime_cleaning');*/

Route::post('register/crime-cleaning-form', [FormController::class, 'registerCrimeCleaningForm'])
    ->name('frontend.register.crime_cleaning_form')
    ->middleware(ProtectAgainstSpam::class);

/*Route::get('painting-form',             [FormController::class, 'paintingForm'])->name('frontend.form.painting');
Route::get('{lang}/painting-form',      [FormController::class, 'paintingForm'])->name('frontend.lang.form.painting');*/

Route::post('register/painting-form',   [FormController::class, 'registerPaintingForm'])
    ->name('frontend.register.painting_form')
    ->middleware(ProtectAgainstSpam::class);

/*Route::get('mover-form',                [FormController::class, 'moverForm'])->name('frontend.form.painting');
Route::get('{lang}/mover-form',         [FormController::class, 'moverForm'])->name('frontend.lang.form.mover');*/

Route::post('register/mover-form',      [FormController::class, 'registerMoverForm'])
    ->name('frontend.register.mover_form')
    ->middleware(ProtectAgainstSpam::class);

Route::post('register/popup-contact',   [FormController::class, 'storePopupContactForm'])->name("frontend.register.popup_contact");

Route::get('mail/checker',              [FormController::class, 'mailChecker']);
//Route::get('pdf/checker',               [FormController::class, 'pdfChecker']);
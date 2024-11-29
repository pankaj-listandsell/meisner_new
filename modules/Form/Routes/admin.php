<?php

use Illuminate\Support\Facades\Route;
use Modules\Form\Admin\FormController;

Route::get('/',                     [FormController::class, 'index'])->name('admin.form.index');
Route::get('/view/{id}',            [FormController::class, 'view'])->name('form.admin.view');
Route::get('edit/{id}',             [FormController::class, 'edit'])->name('admin.form.edit');
Route::post('update/{id}',          [FormController::class, 'update'])->name('admin.form.update');
Route::get('crime-cleaning',        [FormController::class, 'crimeCleaningForm'])->name('admin.form.crime_cleaning');
Route::get('painting',              [FormController::class, 'paintingForm'])->name('admin.form.painting');
Route::get('mover',                 [FormController::class, 'moverForm'])->name('admin.form.mover');
Route::get('popup-contact',         [FormController::class, 'popupContactForm'])->name('admin.form.popup');
Route::get('contact',               [FormController::class, 'contactForm'])->name('admin.form.contact');
Route::get('booking',               [FormController::class, 'bookingForm'])->name('admin.form.booking');
Route::get('requestquote',               [FormController::class, 'requestquoteForm'])->name('admin.form.requestquote');
Route::get('download-mover/{id}',   [FormController::class, 'downloadMoverFile'])->name('admin.form.download_mover_file');
Route::get('/update-read-status/{id}', [FormController::class, 'updateReadStatus'])->name('form.admin.update_read_status');
Route::post('/bulkEdit',            [FormController::class, 'bulkEdit'])->name('form.admin.bulkEdit');
Route::get('/booking-products',            [FormController::class, 'bookingproductForm'])->name('admin.form.bookingproducts');


<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Form\Components\ClearingFormComponent;
use Illuminate\Support\Facades\Blade;
use Modules\Form\Components\ContactFormComponent;
use Modules\Form\Components\CrimeCleaningFormComponent;
use Modules\Form\Components\MoverFormComponent;
use Modules\Form\Components\PaintingFormComponent;
use Modules\Form\Components\PopupContactFormComponent;
use Modules\Form\Components\BookingFormComponent;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('clearing-form',       ClearingFormComponent::class);
        Blade::component('crime-cleaning-form', CrimeCleaningFormComponent::class);
        Blade::component('painting-form',       PaintingFormComponent::class);
        Blade::component('mover-form',          MoverFormComponent::class);
        Blade::component('popup-contact-form',  PopupContactFormComponent::class);
        Blade::component('contact-form',        ContactFormComponent::class);
        Blade::component('booking-form',        BookingFormComponent::class);
    }
}

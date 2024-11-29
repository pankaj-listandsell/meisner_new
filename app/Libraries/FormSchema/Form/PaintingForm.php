<?php

namespace App\Libraries\FormSchema\Form;

use Modules\Form\Enums\FormEntryTypes;

class PaintingForm
{
    public static function schema(): array
    {
        return [
            [
                'name' => 'has_preferred_date',
                'label' => trans('Has Preferred Date'),
                'options' => [trans('Flexible'), trans('Fixed'), trans('No')],
                'default' => trans('Flexible'),
                'required' => true,
                'type' => FormEntryTypes::select->name,
                'placeholder' => '',
                'validation' => ['required'],
            ],
            [
                'name' => 'preferred_date',
                'label' => trans('Desired Date'),
                'options' => [],
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::date->name,
                'placeholder' => '',
                'validation' => ['required'],
            ],
            [
                'name' => 'preferred_time',
                'label' => trans('Time'),
                'options' => [
                    trans('In the morning between 7 a.m. and 10 a.m.'),
                    trans('Mornings between 10 a.m. and 1 p.m.'),
                    trans('In the afternoon between 1 p.m. and 4 p.m.'),
                    trans('Late afternoon between 4 p.m. and 6 p.m.')
                ],
                'default' => null,
                'required' => true,
                'type' => FormEntryTypes::select->name,
                'placeholder' => trans('Please select'),
                'validation' => ['required'],
            ],
            [
                'name' => 'service',
                'label' => trans('Service'),
                'options' => [
                    [
                        'name' => trans('Paint'),
                        'image' => 'https://aflex.berlin/wp-content/uploads/2023/05/house-painting.png'
                    ],
                    [
                        'name' => trans('Interior Painting'),
                        'image' => 'https://aflex.berlin/wp-content/uploads/2023/05/paint-roller_aflex.png'
                    ],
                    [
                        'name' => trans('Wallpapering'),
                        'image' => 'https://aflex.berlin/wp-content/uploads/2023/05/wallpaper_aflex.png'
                    ],
                    [
                        'name' => trans('Basic Cleaning'),
                        'image' => 'https://aflex.berlin/wp-content/uploads/2023/05/cleaning_aflex.png'
                    ],
                ],
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::multi_select_image->name,
                'placeholder' => '',
                'validation' => ['required', 'array'],
            ],
            [
                'name' => 'order_street',
                'label' => trans('Street and House Number'),
                'options' => null,
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('Street and House Number'),
                'validation' => ['required'],
            ],
            [
                'name' => 'order_postal_code',
                'label' => trans('Postcode'),
                'options' => null,
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('Postcode'),
                'validation' => ['required'],
            ],
            [
                'name' => 'order_city',
                'label' => trans('City'),
                'options' => null,
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('City'),
                'validation' => ['required'],
            ],
            [
                'name' => 'order_country',
                'label' => trans('Country'),
                'options' => null,
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('Germany'),
                'validation' => ['required'],
            ],
            [
                'name' => 'order_floor',
                'label' => trans('Floor'),
                'options' => ['EG','1.OG', '2.OG', '3.OG', '4.OG', '5.OG', '6.OG', '7.OG', '8.OG', '9.OG', '10.OG', '11.OG', '12.OG', '13.OG', '14.OG', '15.OG', '16.OG', '17.OG', '18.OG', '19.OG'],
                'default' => 'EG',
                'required' => true,
                'type' => FormEntryTypes::select->name,
                'placeholder' => null,
                'validation' => ['required'],
            ],
            [
                'name' => 'order_has_elevator',
                'label' => trans('Has elevator'),
                'options' => [trans('Yes'), trans('No')],
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::radio->name,
                'placeholder' => '',
                'validation' => ['required'],
            ],
            [
                'name' => 'order_stopping_ban',
                'label' => trans('Stopping ban'),
                'options' => [trans('Yes'), trans('No')],
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::radio->name,
                'placeholder' => '',
                'validation' => ['required'],
            ],
            [
                'name' => 'contact_first_name',
                'label' => trans('First name'),
                'options' => '',
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('First Name'),
                'validation' => ['required'],
            ],
            [
                'name' => 'contact_last_name',
                'label' => trans('Last name'),
                'options' => '',
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('Last Name'),
                'validation' => ['required'],
            ],
            [
                'name' => 'contact_company',
                'label' => trans('Company'),
                'options' => '',
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('Company'),
                'validation' => ['required'],
            ],
            [
                'name' => 'contact_telephone_no',
                'label' => trans('Telephone no'),
                'options' => '',
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('Telephone'),
                'validation' => ['required'],
            ],
            [
                'name' => 'contact_email',
                'label' => trans('Email'),
                'options' => '',
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('E-mail'),
                'validation' => ['required'],
            ],
            [
                'name' => 'work_note',
                'label' => trans('Note'),
                'options' => '',
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::textarea->name,
                'placeholder' => trans('Note'),
                'validation' => ['required'],
            ],
            [
                'name' => 'extra_service',
                'label' => trans('More Services'),
                'options' => [
                    [
                        'name' => trans('Paint'),
                        'image' => 'https://aflex.berlin/wp-content/uploads/2023/05/house-painting.png'
                    ],
                    [
                        'name' => trans('Interior Painting'),
                        'image' => 'https://aflex.berlin/wp-content/uploads/2023/05/paint-roller_aflex.png'
                    ],
                    [
                        'name' => trans('Wallpapering'),
                        'image' => 'https://aflex.berlin/wp-content/uploads/2023/05/wallpaper_aflex.png'
                    ],
                    [
                        'name' => trans('Basic Cleaning'),
                        'image' => 'https://aflex.berlin/wp-content/uploads/2023/05/cleaning_aflex.png'
                    ],
                ],
                'default' => '',
                'required' => false,
                'type' => FormEntryTypes::multi_select_image->name,
                'placeholder' => '',
                'validation' => ['nullable', 'array'],
            ],
            [
                'name' => 'terms',
                'label' => trans('Terms'),
                'options' => [],
                'multiple' => 0,
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::checkbox->name,
                'placeholder' => '',
                'validation' => ['required'],
            ],
        ];
    }

    public static function getNames(): array
    {
        $names = [];
        foreach (self::schema() as $field) {
            if (isset($field['name'])) {
                $names[] = $field['name'];
            }
        }
        return $names;
    }

    public static function validationMessages(): array
    {
        return [
            "has_preferred_date.required" => trans('Has preferred date is required'),
            "preferred_date.required" => trans('Desired date is required'),
            "preferred_time.required" => trans('Time is required'),
            "service.required" => trans('Service is required'),
            "order_street.required" => trans('Street is required'),
            "order_postal_code.required" => trans('Postal code is required'),
            "order_city.required" => trans('City is required'),
            "order_country.required" => trans('Country is required'),
            "order_living_space.required" => trans('Living space is required'),
            "order_total_rooms.required" => trans('No of rooms is required'),
            "order_evacuation_site.required" => trans('Evacuation location is required'),
            "order_has_basement.required" => trans('Has basement field is required'),
            "order_has_more_storage.required" => trans('Has more storage field is required'),
            "order_floor.required" => trans('Floor is required'),
            "order_has_elevator.required" => trans('Has elevator field is required'),
            "order_stopping_ban.required" => trans('Stopping ban field is required'),
            "contact_first_name.required" => trans('First name is required'),
            "contact_last_name.required" => trans('Last name is required'),
            "contact_company.required" => trans('Company is required'),
            "contact_telephone_no.required" => trans('Telephone no is required'),
            "contact_email.required" => trans('Email is required'),
            "work_note.required" => trans('Note is required'),
            "attachment.required" => trans('Attachment PDF/Image is required'),
            "extra_service.required" => trans('Extra service is required'),
            "terms.required" => trans('Terms must be checked'),
        ];
    }
}
<?php

namespace App\Libraries\FormSchema\Form;

use Modules\Form\Enums\FormEntryTypes;

class PopupContractForm
{
    public static function schema(): array
    {
        return [
            [
                'name' => 'name',
                'label' => trans('Name'),
                'options' => [],
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('Enter name'),
                'validation' => ['required'],
            ],
            [
                'name' => 'phone_no',
                'label' => trans('Telefonnummer'),
                'options' => [],
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('Enter phone no'),
                'validation' => ['required'],
            ],
            [
                'name' => 'email',
                'label' => trans('E-Mail'),
                'options' => [],
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('Enter email'),
                'validation' => ['required'],
            ],
            /*[
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
            [
                'name' => 'captcha',
                'label' => trans('Captcha'),
                'options' => [],
                'default' => '',
                'required' => true,
                'type' => FormEntryTypes::text->name,
                'placeholder' => trans('Enter captcha'),
                'validation' => ['required', 'captcha'],
            ],*/
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
            'email.required'    => trans('Email is Required'),
            'email.email'       => trans('Email is invalid'),
            'name.required'     => trans('Name is required field'),
            'name.max'          => trans('Name is too long'),
            'phone_no.required' => trans('Phone is required field'),
            'phone_no.max'      => trans('Phone no is too long'),
            'captcha.required'  => trans('Terms is required'),
            'captcha.captcha'   => trans('Captcha does not match'),
        ];
    }
}
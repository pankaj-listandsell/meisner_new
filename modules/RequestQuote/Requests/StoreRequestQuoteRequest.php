<?php

namespace Modules\RequestQuote\Requests;


use App\Helpers\ReCaptchaEngine;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreRequestQuoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        //$hasGoogleCaptcha = ReCaptchaEngine::isEnable();

        return [
            'email' => [
                'required',
                'max:255',
                'email'
            ],
            'name' => ['required', 'max:200', 'min:2'],
            'phone' => ['required', 'max:200'],
            'service' => ['required'],
            'captcha'       => ['required', 'captcha'],
            // 'terms'  => ['required'],
        ];
    }


    public function messages()
    {
        return [
            'email.required' => trans('Dieses Feld ist erforderlich'),
            'email.max' => trans('Email is invalid') . " " . trans("Contact Administrator"),
            'email.email' => trans('Email is invalid'),
            'name.required' => trans('Dieses Feld ist erforderlich'),
            'name.min' => trans(' name requires at least two characters'),
            'name.max' => trans(' name is too long'),

            'phone.required' => trans('Dieses Feld ist erforderlich'),
            'phone.numeric' => trans('Phone no is too long'),
            'service.required' => trans('Dieses Feld ist erforderlich'),
            'captcha.required'  => trans('Captcha ist erforderlich'),
            'captcha.captcha'   => trans('Captcha stimmt nicht überein'),

        ];
    }



}

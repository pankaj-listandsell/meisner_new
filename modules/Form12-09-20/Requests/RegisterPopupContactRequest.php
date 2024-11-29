<?php

namespace Modules\Form\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class RegisterPopupContactRequest extends FormRequest
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
        return [
            'name'          => ['required', 'max:255'],
            'email'         => ['required', 'email'],
            'phone_no'      => ['required', 'max:200'],
            'terms'         => ['required'],
            'captcha'       => ['required', 'captcha'],
        ];
    }


    public function messages()
    {
        return [
            'email.required'    => trans('Email is Required'),
            'email.email'       => trans('Email is invalid'),
            'name.required'     => trans('Name is required field'),
            'name.max'          => trans('Name is too long'),
            'phone_no.required' => trans('Phone is required field'),
            'phone_no.max'      => trans('Phone no is too long'),
            'captcha.required'  => trans('Captcha is required'),
            'captcha.captcha'   => trans('Captcha does not match'),
        ];
    }

    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'captcha_img' => captcha_img(),
            'message' => 'The given data was invalid'
        ], 422));
    }


}

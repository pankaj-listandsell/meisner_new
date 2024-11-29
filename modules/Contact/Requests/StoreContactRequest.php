<?php

namespace Modules\Contact\Requests;


use App\Helpers\ReCaptchaEngine;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
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
            'firstname' => ['required', 'max:200', 'min:2'],
            'surname' => ['required', 'max:200', 'min:2'],
            'phone' => ['required', 'max:200'],
            'message' => ['required'],
            'captcha'       => ['required', 'captcha'],
            /*'g-recaptcha-response' => [($hasGoogleCaptcha ? 'required' : 'nullable'),
                function (string $attribute, mixed $value, \Closure $fail) use ($hasGoogleCaptcha) {
                    if ($hasGoogleCaptcha) {
                        if (!ReCaptchaEngine::verify($value)) {
                            $fail(__('Please verify the captcha'));
                        }
                    }
                }]*/
        ];
    }


    public function messages()
    {
        return [
            'email.required' => trans('Dieses Feld ist erforderlich'),
            'email.max' => trans('Email is invalid') . " " . trans("Contact Administrator"),
            'email.email' => trans('Email is invalid'),
            'firstname.required' => trans('Dieses Feld ist erforderlich'),
            'firstname.min' => trans('First name requires at least two characters'),
            'firstname.max' => trans('First name is too long'),
            'surname.required' => trans('Dieses Feld ist erforderlich'),
            'surname.min' => trans('Last name requires at least two characters'),
            'surname.max' => trans('Last name is too long'),
            'phone.required' => trans('Dieses Feld ist erforderlich'),
            'phone.numeric' => trans('Phone no is too long'),
            'message.required' => trans('Dieses Feld ist erforderlich'),
            'g-recaptcha-response.required' => trans('Dieses Feld ist erforderlich'),
            'captcha.required'  => trans('Dieses Feld ist erforderlich'),
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

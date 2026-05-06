<?php

namespace Modules\Form\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use App\Helpers\ReCaptchaEngine;

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
        $hasGoogleCaptcha = ReCaptchaEngine::isEnable();

        return [
            'name'          => ['required', 'max:255'],
            'email'         => ['required', 'email'],
            'phone_no'      => ['required', 'max:200'],
            // 'terms'         => ['required'],
            // 'captcha'       => ['required', 'captcha'],
            'g-recaptcha-response' => [($hasGoogleCaptcha ? 'required' : 'nullable'),
                function (string $attribute, mixed $value, \Closure $fail) use ($hasGoogleCaptcha) {
                    if ($hasGoogleCaptcha) {
                        if (!ReCaptchaEngine::verify($value)) {
                            $fail(__('Please verify the captcha'));
                        }
                    }
                }],
        ];
    }


    public function messages()
    {
        return [
            'email.required'    => trans('E-Mail ist erforderlich'),
            'email.email'       => trans('Email is invalid'),
            'name.required'     => trans('Name ist ein Pflichtfeld'),
            'name.max'          => trans('Name is too long'),
            'phone_no.required' => trans('Telefon ist ein Pflichtfeld'),
            'phone_no.max'      => trans('Phone no is too long'),
            // 'captcha.required'  => trans('Captcha ist erforderlich'),
            // 'captcha.captcha'   => trans('Captcha does not match'),
            // 'terms.required'   => trans('Das Feld Datenschutz ist erforderlich'),
            'g-recaptcha-response.required' => trans('Captcha Feld ist erforderlich'),
            'g-recaptcha-response.captcha' => trans('Captcha does not match'),
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

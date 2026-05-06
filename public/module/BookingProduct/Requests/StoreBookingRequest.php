<?php

namespace Modules\Booking\Requests;


use App\Helpers\ReCaptchaEngine;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreBookingRequest extends FormRequest
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
            'has_preferred_date' => 'required|string',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required|string',
            'service' => 'nullable|array', // Ensure it’s an array
            'service.*' => 'string',
            'order_street' => 'required|string',
            'order_postal_code' => 'required|string',
            'order_city' => 'required|string',
            // 'order_country' => 'required|string',
            'order_living_space' => 'required|numeric',
            'order_total_rooms' => 'required|numeric',
            'order_evacuation_site' => 'required|string',
            'order_has_basement' => 'nullable|string',
            'order_has_more_storage' => 'nullable|string',
            'order_floor' => 'required|string',
            'order_has_elevator' => 'required|string',
            'order_stopping_ban' => 'required|string',
            'contact_first_name' => 'required|string',
            'contact_last_name' => 'required|string',
            'contact_company' => 'nullable|string',
            'contact_telephone_no' => 'required|string',
            'contact_email' => 'required|email',
            'work_detail' => 'nullable|string',
            //pankaj change
            // 'attachment' => 'nullable|file|mimes:pdf,jpeg,png',
            'extra_service' => 'nullable|array', // Ensure it’s an array
            'extra_service.*' => 'string',
        ];


    }


    public function messages()
    {
        // return [
        //     'has_preferred_date.required' => trans('The preferred date option is required'),
        //     'preferred_date.required' => trans('The preferred date is required'),
        //     'preferred_date.date' => trans('The preferred date must be a valid date'),
        //     'preferred_time.required' => trans('The preferred time is required'),
        //     'service.array' => trans('The service must be an array'),
        //     'service.*.string' => trans('Each service must be a string'),
        //     'order_street.required' => trans('The street address is required'),
        //     'order_postal_code.required' => trans('The postal code is required'),
        //     'order_city.required' => trans('The city is required'),
        //     'order_living_space.required' => trans('The living space is required'),
        //     'order_living_space.numeric' => trans('The living space must be a number'),
        //     'order_total_rooms.required' => trans('The total number of rooms is required'),
        //     'order_total_rooms.numeric' => trans('The total number of rooms must be a number'),
        //     'order_evacuation_site.required' => trans('The evacuation site is required'),
        //     'order_has_basement.string' => trans('The basement information must be a string'),
        //     'order_has_more_storage.string' => trans('The storage information must be a string'),
        //     'order_floor.required' => trans('The floor is required'),
        //     'order_has_elevator.required' => trans('The elevator information is required'),
        //     'order_stopping_ban.required' => trans('The stopping ban information is required'),
        //     'contact_first_name.required' => trans('The first name is required'),
        //     'contact_last_name.required' => trans('The last name is required'),
        //     'contact_company.string' => trans('The company name must be a string'),
        //     'contact_telephone_no.required' => trans('The telephone number is required'),
        //     'contact_email.required' => trans('The email address is required'),
        //     'contact_email.email' => trans('The email address must be valid'),
        //     'work_detail.string' => trans('The work detail must be a string'),
        //     'attachment.file' => trans('The attachment must be a file'),
        //     'attachment.mimes' => trans('The attachment must be a file of type: pdf, jpeg, png'),
        //     'extra_service.string' => trans('The extra service information must be a string'),
        // ];

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
            "work_detail.required" => trans('Work summary is required'),
            "attachment.required" => trans('Attachment PDF/Image is required'),
            "extra_service.required" => trans('Extra service is required'),
            "terms.required" => trans('Terms must be checked'),
        ];
    }


    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */
    // protected function failedValidation(Validator $validator): array
    // {
    //     throw new HttpResponseException(response()->json([
    //         'errors' => $validator->errors(),
    //         'captcha_img' => captcha_img(),
    //         'message' => 'The given data was invalid'
    //     ], 422));
    // }

}

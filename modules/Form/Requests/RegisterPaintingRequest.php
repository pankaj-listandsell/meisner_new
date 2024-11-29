<?php

namespace Modules\Form\Requests;


use App\Libraries\FormSchema\Form\ClearingForm;
use App\Libraries\FormSchema\Form\CrimeCleaningForm;
use App\Libraries\FormSchema\Form\PaintingForm;
use App\Libraries\FormSchema\FormHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class RegisterPaintingRequest extends FormRequest
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
        $rules = FormHelper::getValidationRulesFromSchema(PaintingForm::schema());

        $extraRules = [
            'lang' => ['required', Rule::in(get_language_codes())]
        ];

        return array_merge($rules, $extraRules);
    }


    public function messages()
    {
        $messages = PaintingForm::validationMessages();

        return array_merge($messages, [
            'lang.required' => trans('Language is required'),
            'lang.in' => trans('Language is not valid'),
        ]);
    }
}

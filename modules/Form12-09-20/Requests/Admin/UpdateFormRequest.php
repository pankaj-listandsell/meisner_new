<?php

namespace Modules\Form\Requests\Admin;


use App\Libraries\FormSchema\Form\PaintingForm;
use App\Libraries\FormSchema\FormHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Form\Enums\FormTypes;


class UpdateFormRequest extends FormRequest
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
        $rules = FormHelper::getValidationRulesFromSchema(getFormSchemaByType($this->get('form_type')));

        $extraRules = [
            'form_id'   => ['required', 'exists:core_forms,id'],
            'form_type' => ['required', Rule::in(FormTypes::onlyNames())]
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

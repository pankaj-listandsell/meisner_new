<?php

namespace Modules\Page\Requests;


use App\Libraries\FormSchema\Form\ClearingForm;
use App\Libraries\FormSchema\FormHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdatePageRequest extends FormRequest
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
            /*'page_id' => 'required|exists:core_pages,id',
            'lang' => ['required', Rule::in(get_language_codes())],
            'content' => 'required',*/
        ];
    }


    public function messages()
    {
        return [
            'page_id.required' => 'Page ID is required',
            'page_id.exists' => 'Page does not exists',
            'lang.required' => 'Language field is required',
            'lang.in' => 'Language does not match',
            'content.required' => 'Page content is required',
        ];
    }
}

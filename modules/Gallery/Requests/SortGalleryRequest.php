<?php

namespace Modules\Gallery\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SortGalleryRequest extends FormRequest
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
            'gallery_id' => ['required', 'exists:bravo_gallery,id'],
            'image_ids' => ['required', 'array']
        ];
    }

}

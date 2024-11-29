<?php

namespace App\Libraries\FormSchema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Modules\Form\Enums\FormEntryTypes;
use Modules\Form\Models\FormEntry;

class FormHelper
{

    public static function getDataFromRequest($schema, $formId, $update = false): array
    {
        $forms = [];

        foreach ($schema as $field) {

            if (!isset($field['name']) && $field['name'] == '') {
                continue;
            }

            $value = request()->input($field['name'] ?? '');

            if ($field['type'] == 'image') {
                $image = request()->file($field['name']);

                if ($update && !$image) {
                    continue;
                }

                if ($image) {
                    if ($update) {
                        $formEntry = FormEntry::where('form_id', $formId)->where('key', $field['name'])->first();
                        if ($formEntry) {
                            $path = 'forms'.DIRECTORY_SEPARATOR.$formId.DIRECTORY_SEPARATOR.$formEntry->value;
                            if (Storage::disk('public')->exists($path)) {
                                Storage::disk('public')->delete($path);
                            }
                        }
                    }
                    $value = $image->getClientOriginalName();
                    Storage::disk('public')->putFileAs('forms'.DIRECTORY_SEPARATOR.$formId, $image, $value);
                }
            }

            if (isset($field['unit']) && $value == '') {
                continue;
            }

            if ($field['type'] == FormEntryTypes::radio->name && is_array($field['options']) && count($field['options']) == 0) {
                $value = (int) ((bool) $value);
            }

            if ($field['type'] == FormEntryTypes::date->name) {
                $value = $value ? date('Y-m-d', strtotime($value)) : null;
            }

            if ($field['type'] == FormEntryTypes::multi_select_image->name && is_array($value)) {
                $value = utf8_encode(json_encode($value));
            }

            $forms[] = array_merge($field, ['value' => $value]);
        }

        return $forms;
    }


    public static function getValidationRulesFromSchema($schema): array
    {
        $rules = [];

        foreach ($schema as $field) {
            if (!isset($field['name']) || !isset($field['validation']) || !is_array($field['validation'])) {
                continue;
            }

            if (isset($field['related']) && isset($field['linked'])) {
                if (in_array(request()->input($field['related']), $field['linked'])) {
                    $rules[$field['name']] = $field['validation'];
                }
                continue;
            }

            $rules[$field['name']] = $field['validation'];
        }

        return $rules;
    }


    public  static function getFormEntryInSingleArray($formEntries): array
    {
        $data = [];
        foreach ($formEntries as $formEntry) {
            $data[$formEntry['key']] = $formEntry['value'];
        }
        return $data;
    }

}
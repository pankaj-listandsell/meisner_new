<?php

namespace Modules\Form\Enums;

enum FormEntryTypes: string
{
    case text = 'Text';
    case textarea = 'Textarea';
    case number = 'Number';
    case select = 'Select';
    case radio = 'Radio';
    case radio_image = 'Radio Image';
    case multi_select_image = 'Multi Select Image';
    case checkbox = 'Checkbox';
    case boolean = 'Boolean';
    case date = 'Date';
    case datetime = 'Date Time';
    case image = 'Image';
    case file = 'File';

    public static function all(): array
    {
        $data = [];
        foreach (self::cases() as $case) {
            $data[$case->name] = $case->value;
        }
        return $data;
    }

    public static function onlyNames(): array
    {
        $names = [];
        foreach (self::cases() as $case) {
            $names[] = $case->name;
        }
        return $names;
    }
}

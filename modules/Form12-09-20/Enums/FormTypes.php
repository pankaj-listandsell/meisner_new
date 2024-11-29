<?php

namespace Modules\Form\Enums;

enum FormTypes: string
{
    case clearing = 'Clearing out';
    case painting = 'Painting';
    case mover = 'Mover';
    case crime_cleaning = 'Crime Cleaning';
    case popup_contact = 'Popup Contact';

    public static function fromName(string $name) : string
    {
        foreach(self::cases() as $enum) {
            if($enum->name === $name){
                return $enum->value;
            }
        }
        return '';
    }

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

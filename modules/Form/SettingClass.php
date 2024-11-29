<?php
namespace  Modules\Form;

use Modules\Core\Abstracts\BaseSettingsClass;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'forms',
                'title' => __("Forms"),
                'position' => 30,
                'view' => "Form::admin.forms.index",
                'enabled' => false,
            ]
        ];
    }
}

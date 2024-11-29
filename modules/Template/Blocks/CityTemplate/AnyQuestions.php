<?php
namespace Modules\Template\Blocks\CityTemplate;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class AnyQuestions extends BaseBlock
{
    public function getName()
    {
        return __('Any Questions') ." (". __('Global Widgets') .")";
    }

    public function getOptions()
    {
        $arg[] = [
            'id'        => 'title',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Title')
        ];

        $arg[] = [
            'id'        => 'desc',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Desc')
        ];

        $arg[] = [
            'id'        => 'subtitle',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Sub Title')
        ];

        $arg[] = [
            'id'        => 'mobile_number',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Mobile Number')
        ];

        return [
            'settings' => $arg,
            'category'=>__("City Page"),
            'is_global' => true
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.city_section.any_questions', $model);
    }

}

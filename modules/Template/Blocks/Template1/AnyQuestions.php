<?php
namespace Modules\Template\Blocks\Template1;

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
            'category'=>__("Service Page"),
            'is_global' => true
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.template1.any_questions', $model);
    }

}

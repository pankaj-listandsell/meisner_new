<?php
namespace Modules\Template\Blocks\AllServiceSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class AnyQuestions extends BaseBlock
{
    public function getName()
    {
        return __('Any Questions');
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
            'type'      => 'textArea',
            'inputType' => 'text',
            'label'     => __('Desc')
        ];


        return [
            'settings' => $arg,
            'category'=>__("All Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.all_services.any_questions', $model);
    }

}

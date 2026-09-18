<?php
namespace Modules\Template\Blocks\Template1;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class TwoColumnText extends BaseBlock
{

    public function getName()
    {
        return __('Two Column Text');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'        => 'class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Wrapper Class (opt)')
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title (H2)')
                ],
                [
                    'id'    => 'content',
                    'type'  => 'editor',
                    'label' => __('Content (full width, under the title)')
                ],
                [
                    'id'    => 'first_content',
                    'type'  => 'editor',
                    'label' => __('Left Column')
                ],
                [
                    'id'    => 'second_content',
                    'type'  => 'editor',
                    'label' => __('Right Column')
                ],
                [
                    'id'        => 'button_text',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Read More Text (opt - empty = always show the full text)')
                ],
                [
                    'id'        => 'button_text_less',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Read Less Text (default: Weniger lesen)')
                ],
            ],
            'category'=>__("Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.template1.two_column_text', $model);
    }

}

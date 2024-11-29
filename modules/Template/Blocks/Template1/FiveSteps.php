<?php
namespace Modules\Template\Blocks\Template1;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class FiveSteps extends BaseBlock
{
    public function getName()
    {
        return __('Five Steps');
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
            'id'        => 'top_content',
            'type'      => 'input',
            'inputType' => 'textArea',
            'label'     => __('Top Content')
        ];
        $arg[] = [
            'id'        => 'bottom_content',
            'type'      => 'input',
            'inputType' => 'textArea',
            'label'     => __('Bottom Content')
        ];
        $arg[] = [
            'id'          => 'list_carousel',
            'type'        => 'listItem',
            'label'       => __('Carousel(s)'),
            'title_field' => 'title',
            'settings'    => [
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('Background Image Uploader')
                ],
                [

                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Desc')
                ]
            ]
        ];

        return [
            'settings' => $arg,
            'category'=>__("Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.template1.five_steps', $model);
    }

}

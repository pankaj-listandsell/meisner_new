<?php
namespace Modules\Template\Blocks\AllServiceSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class ClearingSolution extends BaseBlock
{
    public function getName()
    {
        return __('Clearing Solution');
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
            'id'        => 'content',
            'type'      => 'input',
            'inputType' => 'textArea',
            'label'     => __('Content')
        ];
        $arg[] = [
            'id'          => 'list_carousel',
            'type'        => 'listItem',
            'label'       => __('Carousel(s)'),
            'title_field' => 'title',
            'settings'    => [
                [
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Image Uploader')
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'desc',
                    'type'      => 'textArea',
                    'inputType' => 'textArea',
                    'label'     => __('Desc')
                ]
            ]
        ];

        return [
            'settings' => $arg,
            'category'=>__("All Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.all_services.clearing_solution', $model);
    }

}

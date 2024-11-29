<?php
namespace Modules\Template\Blocks\AllServiceSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Services extends BaseBlock
{
    public function getName()
    {
        return __('Services');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'        => 'main_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Main Title')
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'          => 'list_services',
                    'type'        => 'listItem',
                    'label'       => __('List Service(s)'),
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
                            'id'        => 'content',
                            'type'      => 'textArea',
                            'inputType' => 'textArea',
                            'label'     => __('Content')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link')
                        ]
                    ]
                    ],
            ],
            'category'=>__("All Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.all_services.all_services', $model);
    }

}

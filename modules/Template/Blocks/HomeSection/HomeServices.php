<?php
namespace Modules\Template\Blocks\HomeSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class HomeServices extends BaseBlock
{
    public function getName()
    {
        return __('Home Page Services');
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
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ],
                        [
                            'id'        => 'order',
                            'type'      => 'input',
                            'inputType' => 'number',
                            'label'     => __('Order')
                        ],
                    ]
                    ],
                [
                    'id'        => 'content_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Content Title')
                ],
                [
                    'id'    => 'content',
                    'type'  => 'editor',
                    'label' => __('Editor')
                ],
                [
                    'id'        => 'button_text',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Button Text')
                ],
                [
                    'id'        => 'button_link',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Button link')
                ],
            ],
            'category'=>__("Home Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.home_section.services', $model);
    }

}

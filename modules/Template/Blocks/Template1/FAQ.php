<?php
namespace Modules\Template\Blocks\Template1;

use Modules\Template\Blocks\BaseBlock;

class FAQ extends BaseBlock
{

    public function getName()
    {
        return __('FAQ');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('List Item(s)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Question')
                        ],
                        [
                            'id'        => 'sub_title',
                            'type'      => 'editor',
                            'inputType' => 'textArea',
                            'label'     => __('Answer')
                        ],
                    ]
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
                [
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Image Uploader')
                ],
            ],
            'category'=>__("Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.template1.faq', $model);
    }
}

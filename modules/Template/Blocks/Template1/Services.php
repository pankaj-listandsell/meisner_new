<?php
namespace Modules\Template\Blocks\Template1;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Services extends BaseBlock
{
    public function getName()
    {
        return __('Counter Section') ." (". __('Global Widgets') .")";;
    }

    public function getOptions()
    {
        return [
            'settings' => [
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
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Sub Title')
                        ],
                        [
                            'id'    => 'icon_image',
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
                ]
            ],
            'category'=>__("Service Page"),
            'is_global' => true
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.template1.services', $model);
    }

}

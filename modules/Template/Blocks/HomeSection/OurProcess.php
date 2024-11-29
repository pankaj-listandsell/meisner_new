<?php
namespace Modules\Template\Blocks\HomeSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class OurProcess extends BaseBlock
{
    public function getName()
    {
        return __('Our Process');
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
                    'id'    => 'video_url',
                    'type'  => 'input',
                    'inputType' => 'text',
                    'label' => __('Video URl')
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
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'content',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Content')
                        ],
                        [
                            'id'    => 'icon',
                            'type'  => 'uploader',
                            'label' => __('Icon Uploader')
                        ]
                    ]
                    ]
            ],
            'category'=>__("Home Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.home_section.our_process', $model);
    }

}

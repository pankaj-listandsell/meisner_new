<?php
namespace Modules\Template\Blocks\HomeSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class ProvidingTrusted extends BaseBlock
{
    public function getName()
    {
        return __('Providing Trusted');
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
                    'id'    => 'content',
                    'type'  => 'editor',
                    'label' => __('Editor')
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
                        ]
                    ]
                ],
                [
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Side Image Uploader')
                ]
            ],
            'category'=>__("Home Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.home_section.providing_trusted', $model);
    }

}

<?php
namespace Modules\Template\Blocks\HomeSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class KnownFrom extends BaseBlock
{
    public function getName()
    {
        return __('Known From');
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
            'id'          => 'list_company_images',
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
                    'id'        => 'link',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Link')
                ]
            ]
        ];

        return [
            'settings' => $arg,
            'category'=>__("Home Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.home_section.known_from', $model);
    }

}

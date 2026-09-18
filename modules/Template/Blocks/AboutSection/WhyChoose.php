<?php
namespace Modules\Template\Blocks\AboutSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class WhyChoose extends BaseBlock
{
    public function getName()
    {
        return __('Why Choose Us');
    }

    public function getOptions()
    {
        $arg[] = [
            'id'        => 'title',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Title (H2)')
        ];

        $arg[] = [
            'id'        => 'content',
            'type'      => 'input',
            'inputType' => 'textArea',
            'label'     => __('Intro Content')
        ];

        $arg[] = [
            'id'          => 'list_item',
            'type'        => 'listItem',
            'label'       => __('Reason(s)'),
            'title_field' => 'title',
            'settings'    => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title (H3)')
                ],
                [
                    'id'        => 'content',
                    'type'      => 'input',
                    'inputType' => 'textArea',
                    'label'     => __('Content')
                ],
                [
                    'id'    => 'icon',
                    'type'  => 'uploader',
                    'label' => __('Icon Uploader')
                ]
            ]
        ];

        return [
            'settings' => $arg,
            'category'=>__("About Us Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.about_section.why_choose', $model);
    }

}

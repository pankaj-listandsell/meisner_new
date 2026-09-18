<?php
namespace Modules\Template\Blocks\AboutSection;

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
        $arg[] = [
            'id'        => 'main_title',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Main Title (opt - small text above the title)')
        ];

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
            'label'     => __('Content (short intro under the title)')
        ];

        $arg[] = [
            'id'    => 'bg_image',
            'type'  => 'uploader',
            'label' => __('Image Uploader (left side)')
        ];

        $arg[] = [
            'id'          => 'list_item',
            'type'        => 'listItem',
            'label'       => __('Step(s)'),
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
                    'label' => __('Icon Uploader (opt - step number is shown when empty)')
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
        return view('Template::frontend.blocks.about_section.our_process', $model);
    }

}

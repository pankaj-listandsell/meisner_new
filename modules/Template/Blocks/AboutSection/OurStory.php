<?php
namespace Modules\Template\Blocks\AboutSection;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class OurStory extends BaseBlock
{

    public function getName()
    {
        return __('Our Story');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'        => 'class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Wrapper Class (opt)')
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title (H2)')
                ],
                [
                    'id'    => 'content',
                    'type'  => 'editor',
                    'label' => __('Editor')
                ],
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('Image Uploader')
                ],
            ],
            'category'=>__("About Us Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.about_section.our_story', $model);
    }

}

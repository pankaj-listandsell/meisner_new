<?php
namespace Modules\Template\Blocks\AboutSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class CallToAction extends BaseBlock
{
    public function getName()
    {
        return __('Call To Action Banner');
    }

    public function getOptions()
    {
        return [
            'settings' => [
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
            'category'=>__("About Us Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.about_section.call_to_action', $model);
    }

}

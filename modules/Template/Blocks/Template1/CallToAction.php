<?php
namespace Modules\Template\Blocks\Template1;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class CallToAction extends BaseBlock
{

    public function getName()
    {
        return __('Call To Action');
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
                    'id'        => 'button_text',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('First Button Text')
                ],
                [
                    'id'        => 'button_link',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('First Button Link (page path, tel: or https://wa.me/...)')
                ],
                [
                    'id'        => 'second_button_text',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Second Button Text (opt)')
                ],
                [
                    'id'        => 'second_button_link',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Second Button Link (opt)')
                ],
            ],
            'category'=>__("Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.template1.call_to_action', $model);
    }

}

<?php
namespace Modules\Contact\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Contact extends BaseBlock
{
    function getOptions()
    {
        return ([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'content',
                    'type'      => 'textArea',
                    'inputType' => 'text',
                    'label'     => __('Content')
                ],
                [
                    'id'        => 'contact_label',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Contact Label')
                ],
                [
                    'id'        => 'button_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Button Title')
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
                    'label'     => __('Button Link')
                ]

            ],
            'category'=>__("Contact Page")
        ]);
    }

    public function getName()
    {
        return __('Contact Form');
    }

    public function content($model = [])
    {
        return view('Contact::frontend.blocks.contact.contact_form', $model);
    }
}

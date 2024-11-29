<?php
namespace Modules\Template\Blocks\HomeSection;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class UncomplicatedDisposal extends BaseBlock
{

    public function getName()
    {
        return __('Uncomplicated Disposal');
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
                    'id'    => 'first_image',
                    'type'  => 'uploader',
                    'label' => __('First Image Uploader')
                ],
                [
                    'id'    => 'second_image',
                    'type'  => 'uploader',
                    'label' => __('Second Image Uploader')
                ]
            ],
            'category'=>__("Home Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.home_section.uncomplicated_disposal', $model);
    }


}



<?php
namespace Modules\Template\Blocks\HomeSection;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class LeftImageRightContantSecond extends BaseBlock
{

    public function getName()
    {
        return __('Left Image Right Contant Second');
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
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Image Uploader')
                ]
            ],
            'category'=>__("Home Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.home_section.left_image_right_contant_second', $model);
    }


}



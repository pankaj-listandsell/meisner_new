<?php
namespace Modules\Template\Blocks\Template1;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class LeftImageRightContant extends BaseBlock
{

    public function getName()
    {
        return __('Left Image Right Contant');
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
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('Background Image Uploader')
                ],
                [
                    'id'        => 'videolink',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Video Link')
                ],
            ],
            'category'=>__("Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.template1.left_image_right_contant', $model);
    }


}



<?php
namespace Modules\Template\Blocks\Template1;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class LeftContantRightImage extends BaseBlock
{

    public function getName()
    {
        return __('Left Contant Right Image First');
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
                    'id'        => 'videolink',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Video Link')
                ],
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('Background Image Uploader')
                ],
            ],
            'category'=>__("Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.template1.left_contant_right_image_first', $model);
    }


}



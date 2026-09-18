<?php
namespace Modules\Template\Blocks\Template1;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class LeftImageRightContantReadMore extends BaseBlock
{

    public function getName()
    {
        return __('Left Image Right Contant (Read More)');
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
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Image Uploader (left side)')
                ],
                [
                    'id'        => 'button_text',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Read More Text (default: Mehr lesen)')
                ],
                [
                    'id'        => 'button_text_less',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Read Less Text (default: Weniger lesen)')
                ],
            ],
            'category'=>__("Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.template1.left_image_right_contant_read_more', $model);
    }

}

<?php
namespace Modules\Template\Blocks\CityTemplate;

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
                    'id'        => 'class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Wrapper Class (opt)')
                ],
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
            ],
            'category'=>__("City Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.city_section.left_contant_right_image_first', $model);
    }


}



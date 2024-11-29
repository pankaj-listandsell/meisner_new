<?php
namespace Modules\Template\Blocks\HomeSection;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class BeforeAfterSlider extends BaseBlock
{

    public function getName()
    {
        return __('Before After Slider');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'    => 'before_image',
                    'type'  => 'uploader',
                    'label' => __('Before Image Uploader')
                ],
                [
                    'id'    => 'after_image',
                    'type'  => 'uploader',
                    'label' => __('After Image Uploader')
                ]
            ],
            'category'=>__("Home Page")
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.home_section.before_after_slider', $model);
    }

}



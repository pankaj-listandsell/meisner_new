<?php 
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class SliderWithContent extends BaseBlock
{
    public function getName()
    {
        return __('Slider With Content');
    }

    public function getOptions()
    {
        $arg[] = [
            'id'        => 'title',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Title')
        ];
        
        $arg[] = [
            'id'        => 'sub_title',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Sub Title')
        ];

        $arg[] = [
            'id'        => 'class',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Wrapper Class (opt)')
        ];

        $arg[] =  [
            'id'            => 'style',
            'type'          => 'radios',
            'label'         => __('Style Background'),
            'values'        => [
                [
                    'value'   => '',
                    'name' => __("Normal")
                ],
                [
                    'value'   => 'carousel',
                    'name' => __("Slider Carousel")
                ],
                [
                    'value'   => 'carousel_v2',
                    'name' => __("Slider Carousel Ver 2")
                ]
            ]
        ];

        $arg[] = [
            'id'    => 'bg_image',
            'type'  => 'uploader',
            'label' => __('- Layout Normal: Background Image Uploader')
        ];

        $arg[] = [
            'id'          => 'list_slider',
            'type'        => 'listItem',
            'label'       => __('- Layout Slider: List Item(s)'),
            //'title_field' => 'title',
            'settings'    => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title (using for slider ver 2)')
                ],
                [
                    'id'        => 'sub',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Sub Title')
                ],
                [
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Description (using for slider ver 2)')
                ],
                [
                    'id'        => 'class_name',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Slider item selector class')
                ],
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('Background Image Uploader')
                ],
                [
                    'id'          => 'list_images',
                    'type'        => 'listItem',
                    'label'       => __('Responsive Images'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'viewport',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Responsive viewport (width)')
                        ],
                        [
                            'id'    => 'bg_image',
                            'type'  => 'uploader',
                            'label' => __('Background Image')
                        ]
                    ]
                ]
            ]
        ];

        return [
            'settings' => $arg,
            'category'=>__("Other Block")
        ];
    }

    public function content($model = [])
    {
        $model['bg_image_url'] = FileHelper::url($model['bg_image'] ?? "", 'full') ?? "";
        $model['style'] = $model['style'] ?? "";
        $model['list_slider'] = $model['list_slider'] ?? "";
        $model['modelBlock'] = $model;
        return view('Template::frontend.blocks.slider-with-content', $model);
    }

    public function contentAPI($model = []){
        if (!empty($model['bg_image'])) {
            $model['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        }
        return $model;
    }
}
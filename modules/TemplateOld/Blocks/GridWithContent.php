<?php
namespace Modules\Template\Blocks;
use Modules\Media\Helpers\FileHelper;

class GridWithContent extends BaseBlock
{
    public function getName()
    {
        return __('Grid With Content');
    }

    public function getOptions()
    {
        $arg[] = [
            'id'        => 'class',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Wrapper Class (opt)')
        ];


        $arg[] = [
            'id'          => 'grid_content',
            'type'        => 'listItem',
            'title_field' => 'class',
            'settings' => [
                [
                    'id'        => 'vimeo_video',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label' => __('Vimeo Video ID')
                ],
                [
                    'id'    => 'show_vimeo_video',
                    'type'  => 'checkbox',
                    'label' => __('Show Vimeo Video')
                ],
                [
                    'id'    => 'content',
                    'type'  => 'editor',
                    'label' => __('Editor')
                ],
                [
                    'id'    => 'elephantSlider',
                    'type'  => 'checkbox',
                    'label' => __('Show Elephant Slider')
                ],
                [
                    'id'    => 'mapElement',
                    'type'  => 'checkbox',
                    'label' => __('Show Map'),
                ],
                [
                    'id'    => 'addressElement',
                    'type'  => 'checkbox',
                    'label' => __('Show Address')
                ],
                [
                    'id'        => 'class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Wrapper Class (opt)')
                ]
            ],
        ];

        return [
            'settings' => $arg,
            'category'=>__("Other Block")
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.grid-with-content', $model);
    }
}

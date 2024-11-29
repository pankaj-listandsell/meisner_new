<?php 
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Carousel extends BaseBlock
{
    public function getName()
    {
        return __('Carousel');
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
            'id'        => 'desc',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Desc')
        ];

        $arg[] = [
            'id'        => 'class',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Wrapper Class (opt)')
        ];

        $arg[] = [
            'id'          => 'list_carousel',
            'type'        => 'listItem',
            'label'       => __('Carousel(s)'),
            'title_field' => 'title',
            'settings'    => [
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('Background Image Uploader')
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Carousel Title')
                ],
                [
                    'id'        => 'class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Wrapper Class (opt)')
                ]
            ]
        ];

        // $arg[] = [
        //     'id'          => 'list_carousel',
        //     'type'        => 'listItem',
        //     'label'       => __('Carousel(s)'),
        //     'title_field' => 'title',
        //     'settings'    => [
        //         [
        //             'id'          => 'carousel_item',
        //             'type'        => 'listItem',
        //             'label'       => __('Carousel Item(s)'),
        //             'multiple'     => 'true',
        //             'settings'    => [
        //                 [
        //                     'id'    => 'bg_image',
        //                     'type'  => 'uploader',
        //                     'label' => __('Background Image Uploader')
        //                 ]
        //             ]
        //         ],
        //         [
        //             'id'        => 'title',
        //             'type'      => 'input',
        //             'inputType' => 'text',
        //             'label'     => __('Carousel Title')
        //         ],
        //         [
        //             'id'        => 'class',
        //             'type'      => 'input',
        //             'inputType' => 'text',
        //             'label'     => __('Wrapper Class (opt)')
        //         ]
        //     ]
        // ];

        return [
            'settings' => $arg,
            'category'=>__("Gallery")
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.carousel', $model);
    }

    public function contentAPI($model = []){
      if(!empty($model['list_carousel'])){
        foreach($model['list_carousel'] as &$item){
            $model['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        }

        // foreach($model['list_carousel'] as $carousel){
        //     foreach($carousel['carousel_item'] as &$item){
        //         $model['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        //     }
        // }
      }
        return $model;
    }
}
<?php
namespace Modules\Template\Blocks\HomeSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Testimonials extends BaseBlock
{
    public function getName()
    {
        return __('Testimonials');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'        => 'main_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Main Title')
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'          => 'list_testimonials',
                    'type'        => 'listItem',
                    'label'       => __('List Testimonial(s)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'    => 'rating_image',
                            'type'  => 'uploader',
                            'label' => __('Raating Image Uploader')
                        ],
                        [
                            'id'    => 'content',
                            'type'  => 'editor',
                            'label' => __('Editor')
                        ],
                        [
                            'id'        => 'user_name',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('User Name')
                        ],
                        [
                            'id'        => 'user_designation',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('User Designation')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('User Image Uploader')
                        ]
                    ]
                    ]
            ],
            'category'=>__("Home Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.home_section.testimonials', $model);
    }

}

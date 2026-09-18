<?php
namespace Modules\Template\Blocks\AboutSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class TrustBadges extends BaseBlock
{
    public function getName()
    {
        return __('Trust Badges');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title (H3 - e.g. Einige Zahlen auf einen Blick)')
                ],
                [
                    'id'    => 'content',
                    'type'  => 'editor',
                    'label' => __('Content (opt)')
                ],
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('Badge(s)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Number (e.g. 50+, 24 Stunden, 100 %, 0 EUR)')
                        ],
                        [
                            'id'        => 'strong_text',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Strong Text (bold, e.g. Mitarbeitende)')
                        ],
                        [
                            'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Text (e.g. fuer kleine und grosse Raeumungsprojekte)')
                        ]
                    ]
                ]
            ],
            'category'=>__("About Us Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.about_section.trust_badges', $model);
    }

}

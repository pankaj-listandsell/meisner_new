<?php
namespace Modules\Contact\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Map extends BaseBlock
{
    function getOptions()
    {
        return ([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'content',
                    'type'      => 'textArea',
                    'inputType' => 'text',
                    'label'     => __('Content')
                ]
            ],
            'category'=>__("Contact Page")
        ]);
    }

    public function getName()
    {
        return __('Map');
    }

    public function content($model = [])
    {
        return view('Contact::frontend.blocks.contact.map', $model);
    }
}

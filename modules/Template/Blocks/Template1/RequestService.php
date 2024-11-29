<?php
namespace Modules\Template\Blocks\Template1;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class RequestService extends BaseBlock
{

    public function getName()
    {
        return __('Request Service') ." (". __('Global Widgets') .")";;
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
                    'id'        => 'button_text',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Button Text')
                ],
                [
                    'id'        => 'button_link',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Button link')
                ]
            ],
            'category'=>__("Service Page"),
            'is_global' => true
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.template1.request_service', $model);
    }


}



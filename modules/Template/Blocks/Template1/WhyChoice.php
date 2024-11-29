<?php
namespace Modules\Template\Blocks\Template1;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class WhyChoice extends BaseBlock
{
    public function getName()
    {
        return __('Why Choice');
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
            'id'    => 'content',
            'type'  => 'editor',
            'label' => __('Editor')
        ];

        // $arg[] = [
        //     'id'        => 'mobile_number',
        //     'type'      => 'input',
        //     'inputType' => 'text',
        //     'label'     => __('Mobile Number')
        // ];

        return [
            'settings' => $arg,
            'category'=>__("Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.template1.why_choice', $model);
    }

}

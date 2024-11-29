<?php
namespace Modules\Template\Blocks\HomeSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class ClearanceBerlin extends BaseBlock
{
    public function getName()
    {
        return __('Clearance Berlin');
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

        $arg[] = [
            'id'        => 'button_text',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Button Text')
        ];

        $arg[] = [
            'id'        => 'button_link',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Button Link')
        ];

        return [
            'settings' => $arg,
            'category'=>__("Home Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.home_section.clearance_berlin', $model);
    }

}

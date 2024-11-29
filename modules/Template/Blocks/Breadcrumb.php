<?php 
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;

class Breadcrumb extends BaseBlock
{
    public function getName()
    {
        return __('Breadcrumb');
    }

    public function getOptions()
    {
        $arg[] = [
            'id'        => 'class',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Wrapper Class (opt)')
        ];

        return [
            'settings'  =>  $arg,
            'category'  =>  __('Layout')
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.breadcrumb', $model);
    }
}
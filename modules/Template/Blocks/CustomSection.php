<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class CustomSection extends BaseBlock
{
    public function getName()
    {
        return __('Custom HTML');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'    => 'customhtml',
                    'type'  => 'editor',
                    'label' => __('Text Editor')
                ],
            ],
            'category'=>__("All Service Page")
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.customsection', $model);
    }

}

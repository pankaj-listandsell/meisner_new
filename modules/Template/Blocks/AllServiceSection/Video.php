<?php
namespace Modules\Template\Blocks\AllServiceSection;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Video extends BaseBlock
{
    public function getName()
    {
        return __('Video');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'        => 'video_link',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Video Link')
                ],
            ],
            'category'=>__("All Service Page"),
            'is_global' => false
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.all_services.video', $model);
    }

}

<?php
namespace Modules\Template\Blocks\LocationSection;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class SearchCity extends BaseBlock
{

    public function getName()
    {
        return __('Search City');
    }

    public function getOptions()
    {
        return [
            'settings' => [
            ],
            'category'=>__("Location Page"),
            'is_global' => true
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Template::frontend.blocks.location_section.search_city', $model);
    }

}



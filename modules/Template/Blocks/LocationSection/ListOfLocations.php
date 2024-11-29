<?php
namespace Modules\Template\Blocks\LocationSection;

use Modules\Media\Helpers\FileHelper;
use Modules\Page\Models\Page;
use Modules\Template\Blocks\BaseBlock;

class ListOfLocations extends BaseBlock
{

    public function getName()
    {
        return __('List Of Locations');
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
                ]
            ],
            'category'=>__("Location Page"),
            'is_global' => false
        ];
    }



    public function content($model = [])
    {
        $list =  Page::where('is_city_page',1)->where('status','publish')->get();
        $data = [
            'rows'       => $list,
            'title'      => $model['title'] ?? "",
            'content'      => $model['content'] ?? "",
        ];
        return view('Template::frontend.blocks.location_section.list_of_locations', $data);
    }



}



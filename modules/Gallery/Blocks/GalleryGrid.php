<?php
namespace Modules\Gallery\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Gallery\Models\Gallery;

class GalleryGrid extends BaseBlock
{
    public function getOptions()
    {
        $arg[] = [
            'id'        => 'class',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Wrapper Class (opt)')
        ];

        $arg[] = [
            'id'          => 'grid_content',
            'type'        => 'listItem',
            'title_field' => 'class',
            'settings' => [
                [
                    'id'        => 'gallery_ids',
                    'type'      => 'select2',
                    'label'     => __('Select gallery'),
                    'select2'   => [
                        'ajax'     => [
                            'url'      => route('gallery.admin.getForSelect2', ["type" => "gallery"]),
                            'dataType' => 'json'
                        ],
                        'width'    => '100%',
                        'multiple' => "true",
                        'placeholder' => __('-- Select --')
                    ],
                    'pre_selected' => route('gallery.admin.getForSelect2', [
                        'pre_selected'  => 1,
                        'type'          => 'gallery'
                    ])
                ],
                [
                    'id'        => 'class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Wrapper Class (opt)')
                ],
                [
                    'id'        => 'hide_title',
                    'type'      => 'checkbox',
                    'label'     => __('Hide Title')
                ]
            ],
        ];

        return [
            'settings' => $arg,
            'category'=>__("Gallery")
        ];
    }

    public function getName(){
        return __('Gallery Grid');
    }

    public function content($model = []){
        $list = $this->query($model);
        $data = [
            'rows'          => $list,
            'class'         => $model['class'] ?? '',
            'hide_title'    => $model['hide_title'] ?? '',
            'grid_content'  => $model['grid_content']
        ];

        return view('Gallery::frontend.gallery-grid', $data);
    }

    public function contentAPI($model = []){
        $rows = $this->query($model);
        $model['data']= $rows->map(function($row){
            return $row->dataForApi();
        });
        return $model;
    }

    public function query($model){
        $model_Gallery = Gallery::select("bravo_gallery.*");

        if (!is_current_lang_default_lang()) {
            $model_Gallery = Gallery::select("bravo_gallery.*", 'bravo_gallery_translations.title as title')
                ->join('bravo_gallery_translations', 'bravo_gallery.id', 'bravo_gallery_translations.origin_id')
                ->where('locale', get_current_lang());
        }

        if(empty($model['order'])) $model['order'] = "id";
        if(empty($model['order_by'])) $model['order_by'] = "desc";
        if(!empty( $model['gallery_ids'] )){
            $model_Gallery->whereIn("bravo_gallery.id",$model['gallery_ids']);
        }
        $model_Gallery->orderBy("bravo_gallery.".$model['order'], $model['order_by']);
        $model_Gallery->where("bravo_gallery.status", "publish");
        $model_Gallery->where("bravo_gallery.type", "gallery");
        $model_Gallery->groupBy("bravo_gallery.id");
        return $model_Gallery->get();
    }
}

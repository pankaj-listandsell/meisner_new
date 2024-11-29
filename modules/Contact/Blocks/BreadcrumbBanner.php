<?php
namespace Modules\Contact\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class BreadcrumbBanner extends BaseBlock
{

    public function getName()
    {
        return __('Breadcrumb Banner');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('Background Image Uploader')
                ]
            ],
            'category'=>__("Contact Page")
        ];
    }

    public function content($model = [])
    {
        $model['id'] = time();
        return view('Contact::frontend.blocks.contact.breadcrumb_banner', $model);
    }

}



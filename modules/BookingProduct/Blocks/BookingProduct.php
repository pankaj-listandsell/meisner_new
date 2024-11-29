<?php
namespace Modules\BookingProduct\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class BookingProduct extends BaseBlock
{
    function getOptions()
    {
        return ([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'content',
                    'type'      => 'editor',
                    'label'     => __('Content')
                ],
                [
                    'id'        => 'booking_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Booking Form Title')
                ],
                [
                    'id'        => 'booking_content',
                    'type'      => 'editor',
                    'label'     => __('Booking Form Title')
                ]

            ],
            'category'=>__("Booking Product Page")
        ]);
    }

    public function getName()
    {
        return __('Product Booking Form');
    }

    public function content($model = [])
    {
       return view('BookingProduct::frontend.blocks.booking.booking_product_form', $model);
    }
}

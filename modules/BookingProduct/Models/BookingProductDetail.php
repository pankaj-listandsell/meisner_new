<?php
namespace Modules\BookingProduct\Models;

use App;
use App\BaseModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class BookingProductDetail extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_booking_product_details';

    protected $fillable = [
        'core_booking_product_id',
        'booking_id',
        'core_products_category_id',
        'product_id',
        'product_title',
        'qty',
        'total_price',
        'image_id',
        'create_user',
        'created_at',
        'updated_at',

    ];

}

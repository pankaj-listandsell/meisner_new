<?php
namespace Modules\BookingProduct\Models;

use App;
use App\BaseModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class BookingProduct extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_booking_products';

    protected $fillable = [
        'booking_id',
        'address',
        'building',
        'flour',
        'city',
        'zipcode',
        'full_name',
        'email',
        'date',
        'time',
        'note',
        'total_pieces',
        'net_amount',
        'vat',
        'additional_cost',
        'grand_amount',
        'status',
        'create_user',
        'created_at',
        'updated_at',
    ];

}

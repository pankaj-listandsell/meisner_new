<?php
namespace Modules\Booking\Models;

use App;
use App\BaseModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Booking extends BaseModel
{
    use SoftDeletes;
    protected $table = 'booking_form_entries';

    protected $fillable = [
        'has_preferred_date',
        'preferred_date',
        'preferred_time',
        'service',
        'order_street',
        'order_postal_code',
        'order_city',
        'order_country',
        'order_living_space',
        'order_total_rooms',
        'order_evacuation_site',
        'order_has_basement',
        'order_has_more_storage',
        'order_floor',
        'order_has_elevator',
        'order_stopping_ban',
        'contact_first_name',
        'contact_last_name',
        'contact_company',
        'contact_telephone_no',
        'contact_email',
        'work_detail',
        'attachment',
        'extra_service',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->contact_first_name} {$this->contact_last_name}";
    }

}
